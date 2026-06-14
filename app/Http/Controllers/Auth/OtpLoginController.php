<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OtpLoginController extends Controller
{
    public function __construct(protected OtpService $otpService) {}

    /**
     * Send OTP to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['Your account is inactive.'],
            ]);
        }

        if ($this->otpService->sendOtp($user)) {
            return response()->json(['message' => 'OTP has been sent to your email.']);
        }

        return response()->json(['message' => 'Failed to send OTP. Please try again later.'], 500);
    }

    /**
     * Login using OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['Your account is inactive.'],
            ]);
        }

        if ($this->otpService->verifyOtp($user, $request->otp)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard', absolute: false));
        }

        throw ValidationException::withMessages([
            'otp' => ['The provided OTP is invalid or has expired.'],
        ]);
    }
}
