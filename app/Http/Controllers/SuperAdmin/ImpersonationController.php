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

        return redirect()->route('superadmin.admin.index')->with('success', 'You are now impersonating ' . $user->name);
    }

    public function stop()
    {
        $adminId = Session::pull('admin_user_id');

        if ($adminId) {
            Auth::loginUsingId($adminId);
            return redirect()->route('superadmin.admin.index')->with('success', 'Impersonation ended.');
        }

        return redirect()->route('superadmin.admin.index')->with('error', 'Invalid impersonation session.');
    }
}
