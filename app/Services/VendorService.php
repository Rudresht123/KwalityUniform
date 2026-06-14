<?php

namespace App\Services;

use App\Models\File;
use App\Models\SuperAdmin\Vendor;
use App\Services\EmailService;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class VendorService
{
    public function __construct(protected UserService $userService) {}
    /**
     * Create a new vendor.
     *
     * @param array $data
     * @param UploadedFile|null $logo
     * @return Vendor
     * @throws Exception
     */
    public function createVendor(array $data, ?UploadedFile $logo = null): Vendor
    {
        return DB::transaction(function () use ($data, $logo) {
            try {
                if ($logo) {
                    $data['logo_url'] = $this->handleLogoUpload($logo);
                }

                $user = $this->userService->create([
                    'name' => $data['business_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'role' => 'vendor',
                    'is_active' => true,
                ]);

                $data['user_id'] = $user->id;

                $vendor = Vendor::create($data);

                $this->sendRegistrationEmail($vendor);

                return $vendor;
            } catch (Throwable $e) {
                Log::error('Vendor creation failed: ' . $e->getMessage(), [
                    'data' => $data,
                    'exception' => $e,
                ]);
                throw new Exception('Failed to create vendor: ' . $e->getMessage());
            }
        });
    }

    public function getAllVendor()
    {
        return Vendor::latest()->get();
    }

    /**
     * Update an existing vendor.
     *
     * @param Vendor $vendor
     * @param array $data
     * @param UploadedFile|null $logo
     * @return Vendor
     * @throws Exception
     */
    public function updateVendor(Vendor $vendor, array $data, ?UploadedFile $logo = null): Vendor
    {
        return DB::transaction(function () use ($vendor, $data, $logo) {
            try {
                if ($logo) {
                    // Optional: delete old logo if needed
                    // if ($vendor->logo_url) { deleteFile($vendor->logo_url); }
                    $data['logo_url'] = $this->handleLogoUpload($logo);
                }
                $this->userService->update($vendor->user, [
                    'name' => $data['business_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'is_active' => $data['is_active'] ?? true,
                ]);

                $vendor->update($data);

                return $vendor;
            } catch (Throwable $e) {
                Log::error('Vendor update failed: ' . $e->getMessage(), [
                    'vendor_id' => $vendor->vendor_id,
                    'exception' => $e,
                ]);
                throw new Exception('Failed to update vendor: ' . $e->getMessage());
            }
        });
    }

    /**
     * Handle logo upload.
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function handleLogoUpload(UploadedFile $file): string
    {
        $fileId = uploadFile($file, 'vendors');
        return $fileId ? $fileId : '';
    }

    /**
     * Send registration email to vendor.
     *
     * @param Vendor $vendor
     * @return void
     */
    protected function sendRegistrationEmail(Vendor $vendor): void
    {
        try {
            $sent = EmailService::send('vendor_registration', $vendor->email, [
                'business_name' => $vendor->business_name,
                'owner_name' => $vendor->owner_name,
                'status' => ucfirst($vendor->status),
                'login_button' => emailButton(route('login'), 'Login to your dashboard'),
            ]);

            if (!$sent) {
                Log::warning('Vendor registration email not sent', ['vendor_id' => $vendor->vendor_id]);
            }
        } catch (Throwable $e) {
            Log::error('Failed to send vendor registration email', [
                'vendor_id' => $vendor->vendor_id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
