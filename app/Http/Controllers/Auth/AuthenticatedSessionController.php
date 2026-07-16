<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request)
    // {

    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     $user = Auth::user();

    //     $dashboardRoles = ['super-admin', 'admin', 'vendor', 'school'];

    //     $redirectUrl = $user->hasAnyRole($dashboardRoles) ? route('dashboard', absolute: false) : '/';

    //     if ($request->ajax()) {
    //         return response()->json([
    //             'message' => 'Login successful!',
    //             'redirect' => redirect()->intended($redirectUrl)->getTargetUrl(),
    //         ]);
    //     }

    //     return redirect()->intended($redirectUrl);
    // }

    public function store(LoginRequest $request)
{
    try {

        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        $dashboardRoles = ['super-admin', 'admin', 'vendor', 'school'];

        $redirectUrl = $user->hasAnyRole($dashboardRoles)
            ? route('dashboard', absolute: false)
            : '/';

        if ($request->expectsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Login successful.',
                'redirect' => redirect()->intended($redirectUrl)->getTargetUrl(),
            ]);
        }

        return redirect()->intended($redirectUrl);

    } catch (ValidationException $e) {

        // AJAX Login
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => collect($e->errors())->flatten()->first(),
                'errors'  => $e->errors(),
            ], 422);
        }

        // Normal Login
        return back()
            ->withErrors($e->errors())
            ->withInput($request->except('password'));
    }
}
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
