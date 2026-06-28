<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            // Create file record
            $fileData = $request->file('avatar');
            $path = $fileData->store('avatars', 'public');
            
            $file = \App\Models\File::create([
                'file_name' => $fileData->getClientOriginalName(),
                'file_path' => $path,
                'disk' => 'public',
                'mime_type' => $fileData->getMimeType(),
                'file_size' => $fileData->getSize(),
                'extension' => $fileData->getClientOriginalExtension(),
            ]);

            // Update User
            $user->image_id = $file->id;
            
            // Sync to Vendor/School if exists
            if ($user->hasRole('Vendor')) {
                $user->vendor()->update(['image_id' => $file->id]);
            } elseif ($user->hasRole('School')) {
                $user->school()->update(['image_id' => $file->id]);
            }

            // Optional: Delete old file from disk and DB if needed. 
            // For now, we focus on the upload and link.
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
