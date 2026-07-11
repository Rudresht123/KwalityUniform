@extends('layouts.common')

@section('content')
<style>
    /* Premium Profile Design */
    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .profile-header-card {
        background: linear-gradient(135deg, #6B62DD 0%, #8b83e6 100%);
        border: none;
        border-radius: 20px;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .profile-header-card::after {
        content: '';
        position: absolute;
        bottom: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .profile-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        object-fit: cover;
        background: white;
    }

    .custom-card-profile {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        background: #fff;
        height: 100%;
        transition: all 0.3s ease;
    }

    .custom-card-profile:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .card-title-premium {
        font-weight: 800;
        color: #1e293b;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .card-title-premium i {
        color: #6B62DD;
        font-size: 1.25rem;
        background: rgba(107, 98, 221, 0.1);
        padding: 8px;
        border-radius: 10px;
    }

    .form-label-custom {
        font-weight: 700;
        color: #64748b;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .form-control-profile {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        padding: 12px 15px;
        font-weight: 600;
        color: #334155;
        transition: all 0.2s ease;
    }

    .form-control-profile:focus {
        border-color: #6B62DD;
        box-shadow: 0 0 0 4px rgba(107, 98, 221, 0.05);
        background: #fff;
    }

    .btn-profile-save {
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 700;
        background: #6B62DD;
        border: none;
        box-shadow: 0 4px 15px rgba(107, 98, 221, 0.2);
        transition: all 0.3s ease;
    }

    .btn-profile-save:hover {
        background: #5a52c7;
        transform: scale(1.02);
        box-shadow: 0 6px 20px rgba(107, 98, 221, 0.3);
    }

    .avatar-upload-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 35px;
        height: 35px;
        background: #6B62DD;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 3px solid #fff;
        transition: all 0.2s;
    }

    .avatar-upload-btn:hover {
        transform: scale(1.1);
        background: #5a52c7;
    }

    .delete-section {
        background: #fff5f5;
        border: 1px dashed #feb2b2;
        border-radius: 16px;
        padding: 2rem;
    }
</style>

<div class="profile-container animate__animated animate__fadeIn">
    
    <!-- Profile Header -->
    <div class="card profile-header-card">
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-md-auto text-center text-md-start mb-4 mb-md-0">
                    <div class="position-relative d-inline-block">
                        <img src="{{ auth()->user()->avatar_url }}" class="profile-avatar-large" id="avatarPreview" alt="Profile">
                        <label for="avatarInput" class="avatar-upload-btn">
                            <i class="ti ti-camera"></i>
                        </label>
                    </div>
                </div>
                <div class="col text-center text-md-start ps-md-4">
                    <h2 class="fw-bold mb-1">{{ auth()->user()?->name ?? 'User' }}</h2>
                    <p class="opacity-75 mb-3">{{ auth()->user()?->email ?? 'N/A' }}</p>
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
                        <span class="badge bg-white-transparent rounded-pill px-3 py-2">
                            <i class="ti ti-shield-check me-1"></i> {{ strtoupper(auth()->user()?->getRoleNames()->first() ?? 'User') }}
                        </span>
                        <span class="badge bg-white-transparent rounded-pill px-3 py-2">
                            <i class="ti ti-calendar-event me-1"></i> Joined {{ auth()->user()?->created_at ? auth()->user()->created_at->format('M Y') : 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 animate__animated animate__shakeX">
            <i class="ti ti-circle-check me-2"></i> Your profile information has been updated successfully!
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 animate__animated animate__shakeX">
            <i class="ti ti-lock-check me-2"></i> Your password has been changed successfully!
        </div>
    @endif

    <div class="row g-4">
        <!-- Personal Information -->
        <div class="col-lg-6">
            <div class="card custom-card-profile p-4">
                <h5 class="card-title-premium">
                    <i class="ti ti-user-edit"></i> Personal Information
                </h5>
                
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    
                    <input type="file" name="avatar" id="avatarInput" class="d-none" accept="image/*">

                    <div class="mb-4">
                        <label class="form-label-custom">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-profile {{ isset($errors) && $errors->has('name') ? 'is-invalid' : '' }}" 
                               value="{{ old('name', $user->name) }}" required>
                        @if(isset($errors) && $errors->has('name')) <div class="invalid-feedback">{{ $errors->first('name') }}</div> @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Username</label>
                        <input type="text" name="username" class="form-control form-control-profile {{ isset($errors) && $errors->has('username') ? 'is-invalid' : '' }}" 
                               value="{{ old('username', $user->username) }}" required>
                        @if(isset($errors) && $errors->has('username')) <div class="invalid-feedback">{{ $errors->first('username') }}</div> @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-profile {{ isset($errors) && $errors->has('email') ? 'is-invalid' : '' }}" 
                               value="{{ old('email', $user->email) }}" required>
                        @if(isset($errors) && $errors->has('email')) <div class="invalid-feedback">{{ $errors->first('email') }}</div> @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Phone Number</label>
                        <input type="text" name="phone" class="form-control form-control-profile {{ isset($errors) && $errors->has('phone') ? 'is-invalid' : '' }}" 
                               value="{{ old('phone', $user->phone) }}">
                        @if(isset($errors) && $errors->has('phone')) <div class="invalid-feedback">{{ $errors->first('phone') }}</div> @endif
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary btn-profile-save w-100">
                            Save Changes <i class="ti ti-check ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="col-lg-6">
            <div class="card custom-card-profile p-4">
                <h5 class="card-title-premium">
                    <i class="ti ti-shield-lock"></i> Security Settings
                </h5>
                
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-4">
                        <label class="form-label-custom">Current Password</label>
                        <input type="password" name="current_password" class="form-control form-control-profile @error('current_password', 'updatePassword') is-invalid @enderror" 
                               placeholder="••••••••">
                        @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">New Password</label>
                        <input type="password" name="password" class="form-control form-control-profile @error('password', 'updatePassword') is-invalid @enderror" 
                               placeholder="••••••••">
                        @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-profile" 
                               placeholder="••••••••">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary btn-profile-save w-100">
                            Update Password <i class="ti ti-key ms-2"></i>
                        </button>
                    </div>
                </form>

                <!-- Danger Zone -->
                <div class="mt-5 pt-4 border-top">
                    <h6 class="text-danger fw-bold mb-3 small uppercase letter-spacing-1">Danger Zone</h6>
                    <p class="text-muted small mb-3">Once you delete your account, all data will be permanently removed.</p>
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-4 fw-bold" 
                            data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal (Simplified) -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-body p-5 text-center">
                <div class="avatar avatar-xl bg-danger-transparent text-danger mb-4 mx-auto">
                    <i class="ti ti-alert-triangle fs-1"></i>
                </div>
                <h4 class="fw-bold text-dark mb-2">Are you sure?</h4>
                <p class="text-muted mb-4">This action is irreversible. Please enter your password to confirm account deletion.</p>
                
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <input type="password" name="password" class="form-control form-control-profile mb-4" placeholder="Your Password" required>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light rounded-pill flex-grow-1 fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger rounded-pill flex-grow-1 fw-bold">Permanently Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Real-time Avatar Preview
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatarPreview').src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endpush
@endsection
