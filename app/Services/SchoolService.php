<?php

namespace App\Services;

use App\Models\SuperAdmin\School;
use App\Repositories\SchoolRepositoryInterface;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SchoolService
{
    /**
     * @var SchoolRepositoryInterface
     */

    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * SchoolService constructor.
     *
     * @param SchoolRepositoryInterface $schoolRepository
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get all schools.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllSchools()
    {
        return School::latest()->get();
    }

    /**
     * Create a new school.
     *
     * @param array $data
     * @param UploadedFile|null $logo
     * @return School
     * @throws Exception
     */
    public function createSchool(array $data, ?UploadedFile $logo = null): School
    {
        return DB::transaction(function () use ($data, $logo) {
            try {
                if ($logo) {
                    $data['logo_url'] = $this->handleLogoUpload($logo);
                }

                // Create associated user
                $user = $this->userService->create([
                    'name' => $data['school_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'role' => 'school',
                    'is_active' => true,
                ]);

                $data['user_id'] = $user->id;

                /** @var School $school */
                $school = School::create($data);

                $this->sendRegistrationEmail($school);

                return $school;
            } catch (Throwable $e) {
                Log::error('School creation failed: ' . $e->getMessage(), [
                    'data' => $data,
                    'exception' => $e,
                ]);
                throw new Exception('Failed to create school: ' . $e->getMessage());
            }
        });
    }

    /**
     * Update an existing school.
     *
     * @param string $schoolId
     * @param array $data
     * @param UploadedFile|null $logo
     * @return School
     * @throws Exception
     */
    public function updateSchool(string $schoolId, array $data, ?UploadedFile $logo = null): School
    {
        return DB::transaction(function () use ($schoolId, $data, $logo) {
            try {
                /** @var School $school */
                $school = School::findOrFail($schoolId);

                if ($logo) {
                    // Optional: delete old logo if needed
                    // if ($school->logo_url) { deleteFile($school->logo_url); }
                    $data['logo_url'] = $this->handleLogoUpload($logo);
                }

                // Update associated user
                if ($school->user) {
                    $this->userService->update($school->user, [
                        'name' => $data['school_name'],
                        'email' => $data['email'],
                        'phone' => $data['phone'],
                        'is_active' => $data['is_active'] ?? true,
                    ]);
                }

                $school->update($data);

                return $school->fresh();
            } catch (Throwable $e) {
                Log::error('School update failed: ' . $e->getMessage(), [
                    'school_id' => $schoolId,
                    'exception' => $e,
                ]);
                throw new Exception('Failed to update school: ' . $e->getMessage());
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
        $fileId = uploadFile($file, 'schools');
        return $fileId ?: '';
    }

    /**
     * Send registration email to school.
     *
     * @param School $school
     * @return void
     */
    protected function sendRegistrationEmail(School $school): void
    {
        try {
            $sent = EmailService::send('school_registration', $school->email, [
                'school_name' => $school->school_name,
                'principal_name' => $school->principal_name,
                'status' => $school->is_active ? 'Active' : 'Inactive',
                'login_button' => emailButton(route('login'), 'Login to your dashboard'),
            ]);

            if (!$sent) {
                Log::warning('School registration email not sent', ['school_id' => $school->school_id]);
            }
        } catch (Throwable $e) {
            Log::error('Failed to send school registration email', [
                'school_id' => $school->school_id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
