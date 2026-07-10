<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <hr class="my-6 border-gray-300" />

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Residential Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- City -->
        <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <!-- State -->
        <div class="mt-4">
            <x-input-label for="state" :value="__('State/Province')" />
            <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state')" />
            <x-input-error :messages="$errors->get('state')" class="mt-2" />
        </div>

        <!-- Zip Code -->
        <div class="mt-4">
            <x-input-label for="zip_code" :value="__('Zip Code')" />
            <x-text-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code" :value="old('zip_code')" />
            <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
        </div>

        <hr class="my-6 border-gray-300" />

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" selected disabled>{{ __('Select Gender') }}</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Date of Birth -->
        <div class="mt-4">
            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <!-- National ID -->
        <div class="mt-4">
            <x-input-label for="national_id" :value="__('National ID / Passport')" />
            <x-text-input id="national_id" class="block mt-1 w-full" type="text" name="national_id" :value="old('national_id')" />
            <x-input-error :messages="$errors->get('national_id')" class="mt-2" />
        </div>

        <!-- Alternate Phone -->
        <div class="mt-4">
            <x-input-label for="alternate_phone" :value="__('Alternate Phone')" />
            <x-text-input id="alternate_phone" class="block mt-1 w-full" type="text" name="alternate_phone" :value="old('alternate_phone')" />
            <x-input-error :messages="$errors->get('alternate_phone')" class="mt-2" />
        </div>

        <hr class="my-6 border-gray-300" />

        <!-- Emergency Contact Name -->
        <div class="mt-4">
            <x-input-label for="emergency_contact_name" :value="__('Emergency Contact Name')" />
            <x-text-input id="emergency_contact_name" class="block mt-1 w-full" type="text" name="emergency_contact_name" :value="old('emergency_contact_name')" />
            <x-input-error :messages="$errors->get('emergency_contact_name')" class="mt-2" />
        </div>

        <!-- Emergency Contact Phone -->
        <div class="mt-4">
            <x-input-label for="emergency_contact_phone" :value="__('Emergency Contact Phone')" />
            <x-text-input id="emergency_contact_phone" class="block mt-1 w-full" type="text" name="emergency_contact_phone" :value="old('emergency_contact_phone')" />
            <x-input-error :messages="$errors->get('emergency_contact_phone')" class="mt-2" />
        </div>

        <!-- Emergency Contact Relationship -->
        <div class="mt-4">
            <x-input-label for="emergency_contact_relationship" :value="__('Emergency Contact Relationship')" />
            <x-text-input id="emergency_contact_relationship" class="block mt-1 w-full" type="text" name="emergency_contact_relationship" :value="old('emergency_contact_relationship')" />
            <x-input-error :messages="$errors->get('emergency_contact_relationship')" class="mt-2" />
        </div>

        <!-- Notes -->
        <div class="mt-4">
            <x-input-label for="notes" :value="__('Additional Notes')" />
            <textarea id="notes" name="notes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('notes') }}</textarea>
            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
