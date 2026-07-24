<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ImpersonationController extends Controller
{
    public function start(User $user)
    {
        // Store the original user ID in session to allow reverting
        Session::put('admin_user_id', Auth::id());

        // Login as the target user
        Auth::login($user);

        // Redirect based on the impersonated user's role
        if ($user->hasRole('vendor')) {
            return redirect()->route('dashboard')->with('success', 'You are now impersonating vendor: ' . $user->name);
        }

        return redirect()->route('dashboard')->with('success', 'You are now impersonating ' . $user->name);
    }

    public function stop()
    {
        $adminId = Session::pull('admin_user_id');

        if ($adminId) {
            // Login as admin first
            Auth::loginUsingId($adminId);
            
            // Now that the user is the admin again, they have permission to access admin.index
            return redirect()->route('admin.index')->with('success', 'Impersonation ended.');
        }

        return redirect()->route('admin.index')->with('error', 'Invalid impersonation session.');
    }
}
