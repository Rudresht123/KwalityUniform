@extends('layouts.common')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Parent User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('parent-user.store') }}" method="POST">
                        @csrf
                        <fieldset class="custom-fieldset">
                            <legend class="custom-legend">Account Information</legend>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">National ID</label>
                                    <input type="text" name="national_id" class="form-control @error('national_id') is-invalid @enderror" value="{{ old('national_id') }}">
                                    @error('national_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Alternate Phone</label>
                                    <input type="text" name="alternate_phone" class="form-control @error('alternate_phone') is-invalid @enderror" value="{{ old('alternate_phone') }}">
                                    @error('alternate_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="custom-fieldset">
                            <legend class="custom-legend">Address Information</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}">
                                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}">
                                    @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code') }}">
                                    @error('zip_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="custom-fieldset">
                            <legend class="custom-legend">Emergency Contact</legend>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Contact Name</label>
                                    <input type="text" name="emergency_contact_name" class="form-control @error('emergency_contact_name') is-invalid @enderror" value="{{ old('emergency_contact_name') }}">
                                    @error('emergency_contact_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Contact Phone</label>
                                    <input type="text" name="emergency_contact_phone" class="form-control @error('emergency_contact_phone') is-invalid @enderror" value="{{ old('emergency_contact_phone') }}">
                                    @error('emergency_contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Relationship</label>
                                    <input type="text" name="emergency_contact_relationship" class="form-control @error('emergency_contact_relationship') is-invalid @enderror" value="{{ old('emergency_contact_relationship') }}">
                                    @error('emergency_contact_relationship') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Notes</label>
                                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </fieldset>

                        <div class="text-end mt-3">
                            <a href="{{ route('parent-user.index') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Parent User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
