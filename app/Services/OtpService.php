<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserOtp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OtpService
{
    /**
     * Generate and send OTP to user.
     *
     * @param User $user
     * @return bool
     */
    public function sendOtp(User $user, string $type = 'email'): bool
    {
        try {
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $expiryMinutes = 10;

            UserOtp::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'type' => $type
                ],
                [
                    'otp' => $otp,
                    'expires_at' => Carbon::now()->addMinutes($expiryMinutes),
                    'verified_at' => null,
                ]
            );

            return EmailService::send('otp_verification', $user->email, [
                'user_name' => $user->name,
                'otp' => $otp,
                'expiry_minutes' => $expiryMinutes,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to send OTP', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Verify OTP for user.
     *
     * @param User $user
     * @param string $otp
     * @param string $type
     * @return bool
     */
    public function verifyOtp(User $user, string $otp, string $type = 'email'): bool
    {
        $userOtp = UserOtp::where('user_id', $user->id)
            ->where('type', $type)
            ->where('otp', $otp)
            ->first();

        if (!$userOtp || $userOtp->isExpired()) {
            return false;
        }

        // Mark as verified instead of deleting immediately if needed, 
        // but here we just return true and the controller handles the rest.
        $userOtp->delete();

        return true;
    }
}
