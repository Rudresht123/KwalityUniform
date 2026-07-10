<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ScreenLockController extends Controller
{
    /**
     * Lock the user's screen.
     */
    public function lock(Request $request)
    {
        Session::put('screen_locked', true);
        
        return redirect()->route('lockscreen');
    }

    /**
     * Show the lock screen.
     */
    public function show()
    {
        if (!Session::get('screen_locked')) {
            return $this->redirectBasedOnRole();
        }

        return view('auth.lockscreen');
    }

    /**
     * Unlock the screen.
     */
    public function unlock(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        if (Hash::check($request->password, $request->user()->password)) {
            Session::forget('screen_locked');
            return redirect()->intended($this->redirectBasedOnRole());
        }

        return back()->withErrors([
            'password' => 'The provided password does not match our records.',
        ]);
    }

    /**
     * Helper method to determine the correct dashboard route based on user role.
     */
    protected function redirectBasedOnRole()
    {
        $user = auth()->user();
        if (!$user) return route('login');

        if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
            return route('dashboard');
        }
        if ($user->hasRole('School')) {
            return route('school.distribution');
        }
        if ($user->hasRole('Parent')) {
            return route('parent.orders');
        }

        return route('website.shop');
    }
}
