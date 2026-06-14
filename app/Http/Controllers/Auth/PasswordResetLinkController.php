<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Services\EmailService;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'We could not find a user with that email address.',
            ]);
        }

        $token = Password::broker()->createToken($user);

        $resetUrl = route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ]);

        EmailService::send(
            templateKey: 'forgot_password',
            to: $user->email,
            placeholders: [
                'user_name' => $user->name,
                'reset_button' => emailButton($resetUrl, 'Reset Password'),
                'expiry_date' => now()->addMinutes(config('auth.passwords.users.expire'))->format('d M Y h:i A'),
            ],
        );

        return back()->with('status', 'Password reset link sent successfully.');
    }
}
