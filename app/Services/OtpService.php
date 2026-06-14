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
    public function sendOtp(User $user): bool
    {
        try {
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $expiryMinutes = 10;

            UserOtp::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'otp' => $otp,
                    'expire_at' => Carbon::now()->addMinutes($expiryMinutes),
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
     * @return bool
     */
    public function verifyOtp(User $user, string $otp): bool
    {
        $userOtp = UserOtp::where('user_id', $user->id)
            ->where('otp', $otp)
            ->first();

        if (!$userOtp || $userOtp->isExpired()) {
            return false;
        }

        // Delete OTP after successful verification
        $userOtp->delete();

        return true;
    }
}
