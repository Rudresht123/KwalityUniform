<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'address' => ['nullable', 'string', 'max:255'],
                'city' => ['nullable', 'string', 'max:100'],
                'state' => ['nullable', 'string', 'max:100'],
                'zip_code' => ['nullable', 'string', 'max:20'],
                'alternate_phone' => ['nullable', 'string', 'max:20'],
                'gender' => ['nullable', 'string', 'max:20'],
                'date_of_birth' => ['nullable', 'date'],
                'national_id' => ['nullable', 'string', 'max:50'],
                'emergency_contact_name' => ['nullable', 'string', 'max:255'],
                'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
                'emergency_contact_relationship' => ['nullable', 'string', 'max:100'],
                'notes' => ['nullable', 'string'],
                'terms' => ['required', 'accepted'],
            ], [
                'terms.required' => 'You must agree to the Terms & Privacy Policy to continue.',
                'terms.accepted' => 'You must agree to the Terms & Privacy Policy to continue.',
            ]);
        } catch (ValidationException $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        try {
            $user = DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $user->assignRole('parent');

                \App\Models\WebUser::create([
                    'user_id' => $user->id,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'alternate_phone' => $request->alternate_phone,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'national_id' => $request->national_id,
                    'emergency_contact_name' => $request->emergency_contact_name,
                    'emergency_contact_phone' => $request->emergency_contact_phone,
                    'emergency_contact_relationship' => $request->emergency_contact_relationship,
                    'notes' => $request->notes,
                ]);

                return $user;
            });

            event(new Registered($user));

            try {
                \App\Services\EmailService::send(
                    'welcome_parent',
                    $user->email,
                    [
                        'user_name' => $user->name,
                        'website_name' => config('app.name'),
                    ]
                );
            } catch (\Exception $e) {
                \Log::error('Failed to send welcome email to parent: ' . $e->getMessage());
            }

            Auth::login($user);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'message' => 'Account created successfully! Welcome aboard.',
                    'redirect' => '/',
                ]);
            }

            return redirect('/');
        } catch (\Throwable $e) {
            \Log::error('Registration failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['message' => 'Something went wrong while creating your account. Please try again.'], 500);
            }

            return back()->withErrors(['error' => 'Something went wrong. Please try again.'])->withInput();
        }
    }
}
