@extends('layouts.without-header-footer')

@section('content')
    <div class="auth-wrapper">

        <div class="container-fluid">
            <div class="row min-vh-100">

                <!-- Left Side -->
                <div class="col-lg-7 d-none d-lg-flex align-items-center justify-content-center auth-left">

                    <div class="auth-content">

                        <div class="mb-4">
                            <span class="badge auth-badge">
                                School Uniform Management Platform
                            </span>
                        </div>

                        <h1 class="auth-title">
                            Manage Uniform Orders
                            <span>Smarter & Faster</span>
                        </h1>

                        <p class="auth-subtitle">
                            Centralized platform for Schools, Parents and Vendors
                            to manage uniforms, inventory, payments and orders.
                        </p>

                        <div class="row mt-5">

                            <div class="col-md-6 mb-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="ti ti-building"></i>
                                    </div>

                                    <div>
                                        <h6>School Management</h6>
                                        <p>Manage schools and students</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="ti ti-shopping-cart"></i>
                                    </div>

                                    <div>
                                        <h6>Order Management</h6>
                                        <p>Track all uniform orders</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="ti ti-package"></i>
                                    </div>

                                    <div>
                                        <h6>Inventory Tracking</h6>
                                        <p>Real-time stock visibility</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="ti ti-chart-bar"></i>
                                    </div>

                                    <div>
                                        <h6>Analytics & Reports</h6>
                                        <p>Business insights dashboard</p>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>

                </div>

                <!-- Right Side -->
                <div class="col-lg-5 d-flex align-items-center justify-content-center auth-right">

                    <div class="login-wrapper-inner">

                        <!-- Logo Outside Card -->
                        <a href="/" class="brand-logo mb-4">

                            <div class="brand-icon">
                                <i class="ti ti-school"></i>
                            </div>

                            <div class="brand-text">

                                <span class="brand-name">
                                    eSchoolKart
                                </span>

                                <span class="brand-tagline">
                                    School Uniform ERP
                                </span>

                            </div>

                        </a>

                        <!-- Login Card -->
                        <div class="login-card">

                            <div class="text-center mb-4">

                                <h4 class="fw-bold mb-2">
                                    Welcome Back 👋
                                </h4>

                                <p class="text-muted mb-0">
                                    Sign in to continue to your dashboard
                                </p>

                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="mb-4">

                                    <label for="email" class="form-label">
                                        Email Address
                                    </label>

                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        class="form-control auth-input @error('email') is-invalid @enderror"
                                        placeholder="Enter your email address" required autofocus>

                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="mb-4">

                                    <div class="d-flex justify-content-between align-items-center mb-2">

                                        <label for="password" class="form-label mb-0">
                                            Password
                                        </label>

                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="forgot-link">

                                                Forgot Password?

                                            </a>
                                        @endif

                                    </div>

                                    <div class="position-relative">

                                        <input id="password" type="password" name="password"
                                            class="form-control auth-input pe-5 @error('password') is-invalid @enderror"
                                            placeholder="Enter your password" required>

                                        <button type="button" id="togglePassword" class="password-toggle">

                                            <i class="ti ti-eye"></i>

                                        </button>

                                    </div>

                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">

                                            Remember Me

                                        </label>

                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-auth">

                                    <i class="ti ti-login me-2"></i>
                                    Sign In

                                </button>


                            </form>




                        </div>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                © {{ date('Y') }} School Uniform Management Platform
                            </small>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
