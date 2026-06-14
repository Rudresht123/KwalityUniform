<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SetupPasswordController extends Controller
{
    /**
     * Show the password setup form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'The link has expired or is invalid.');
        }

        return view('auth.setup-password', ['user' => $user]);
    }

    /**
     * Store the user's credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'The link has expired or is invalid.');
        }

        $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $user->id],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        \Illuminate\Support\Facades\Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('status', 'Your account has been set up successfully and you are now logged in.');
    }
}
