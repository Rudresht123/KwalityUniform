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

        // Restrict administrative users from using website OTP login
        if ($user->hasAnyRole(['super-admin', 'admin', 'vendor', 'school'])) {
            throw ValidationException::withMessages([
                'email' => ['Administrative users are not authorized to login here. Please use the administrative login page.'],
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

        // Restrict administrative users from using website OTP login
        if ($user->hasAnyRole(['super-admin', 'admin', 'vendor', 'school'])) {
            throw ValidationException::withMessages([
                'email' => ['Administrative users are not authorized to login here. Please use the administrative login page.'],
            ]);
        }

        if ($this->otpService->verifyOtp($user, $request->otp)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            $dashboardRoles = ['super-admin', 'admin', 'vendor', 'school'];
            $redirectUrl = $user->hasAnyRole($dashboardRoles) ? route('dashboard', absolute: false) : '/';

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Login successful',
                    'redirect' => redirect()->intended($redirectUrl)->getTargetUrl()
                ]);
            }

            return redirect()->intended($redirectUrl);
        }

        throw ValidationException::withMessages([
            'otp' => ['The provided OTP is invalid or has expired.'],
        ]);
    }
}
