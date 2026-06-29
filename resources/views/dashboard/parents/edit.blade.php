@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Parent</h1>
        <a href="{{ route('parents.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            Back to List
        </a>
    </div>

    <form action="{{ route('parents.update', $webUser->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- User Information -->
            <div class="col-span-2">
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">User Account Information</h3>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $webUser->user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $webUser->user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" value="{{ old('username', $webUser->user->username) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $webUser->user->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Parent Specific Information -->
            <div class="col-span-2 mt-6">
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Parent Details</h3>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender', $parent->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $parent->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $parent->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $parent->date_of_birth ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">National ID</label>
                <input type="text" name="national_id" value="{{ old('national_id', $parent->national_id ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('national_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Alternate Phone</label>
                <input type="text" name="alternate_phone" value="{{ old('alternate_phone', $parent->alternate_phone ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('alternate_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" value="{{ old('address', $parent->address ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" name="city" value="{{ old('city', $parent->city ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">State</label>
                <input type="text" name="state" value="{{ old('state', $parent->state ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('state') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Zip Code</label>
                <input type="text" name="zip_code" value="{{ old('zip_code', $parent->zip_code ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('zip_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Emergency Contact -->
            <div class="col-span-2 mt-6">
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Emergency Contact</h3>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contact Name</label>
                <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $parent->emergency_contact_name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('emergency_contact_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contact Phone</label>
                <input type="text" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $parent->emergency_contact_phone ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('emergency_contact_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Relationship</label>
                <input type="text" name="emergency_contact_relationship" value="{{ old('emergency_contact_relationship', $parent->emergency_contact_relationship ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('emergency_contact_relationship') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $parent->notes ?? '') }}</textarea>
                @error('notes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Update Parent
            </button>
        </div>
    </form>
</div>
@endsection
