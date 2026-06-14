@extends('layouts.without-header-footer')

@section('content')
    <style>
        .security-showcase {

            width: 100%;

            max-width: 520px;

            margin: auto;

        }

        .password-card {

            background:
                rgba(255, 255, 255, .12);

            border:
                1px solid rgba(255, 255, 255, .15);

            backdrop-filter: blur(10px);

            border-radius: 24px;

            padding: 30px;

            margin-bottom: 40px;

        }

        .password-header {

            display: flex;

            align-items: center;

            gap: 18px;

            margin-bottom: 25px;

        }

        .shield-icon {

            width: 70px;
            height: 70px;

            border-radius: 18px;

            background:
                rgba(255, 255, 255, .15);

            display: flex;

            align-items: center;

            justify-content: center;

        }

        .shield-icon i {

            font-size: 34px;

            color: #fff;

        }

        .small-label {

            color: #cbd5e1;

            font-size: 13px;

        }

        .password-header h3 {

            margin: 5px 0 0;

            color: #fff;

            font-weight: 700;

        }

        .strength-box {

            margin-bottom: 25px;

        }

        .strength-box span {

            color: #fff;

            display: block;

            margin-bottom: 10px;

        }

        .strength-bar {

            height: 10px;

            background:
                rgba(255, 255, 255, .15);

            border-radius: 30px;

            overflow: hidden;

        }

        .strength-fill {

            width: 85%;

            height: 100%;

            background:
                linear-gradient(90deg,
                    #22c55e,
                    #84cc16);

        }

        .strength-box small {

            display: block;

            margin-top: 8px;

            color: #e2e8f0;

        }

        .security-list {

            display: flex;

            flex-direction: column;

            gap: 15px;

        }

        .security-row {

            color: #fff;

            display: flex;

            align-items: center;

            gap: 10px;

        }

        .security-row i {

            color: #4ade80;

        }

        .hero-title {

            font-size: 52px;

            font-weight: 800;

            line-height: 1.1;

        }

        .hero-title span {

            display: block;

            color: #ffd54f;

        }

        .hero-description {

            margin-top: 20px;

            color: #e2e8f0;

            font-size: 17px;

            line-height: 1.8;

        }
    </style>




    <div class="login-wrapper">

        <div class="container-fluid">
            <div class="row min-vh-100">

                <!-- Left Side -->

                <div class="col-lg-6 d-none d-lg-flex auth-left">

                    <div class="security-showcase">

                        <div class="password-card">

                            <div class="password-header">

                                <div class="shield-icon">
                                    <i class="ti ti-shield-lock"></i>
                                </div>

                                <div>

                                    <span class="small-label">
                                        Security Center
                                    </span>

                                    <h3>
                                        Password Updated Securely
                                    </h3>

                                </div>

                            </div>

                            <div class="strength-box">

                                <span>Password Strength</span>

                                <div class="strength-bar">
                                    <div class="strength-fill"></div>
                                </div>

                                <small>Strong Password Recommended</small>

                            </div>

                            <div class="security-list">

                                <div class="security-row">
                                    <i class="ti ti-check"></i>
                                    Minimum 8 Characters
                                </div>

                                <div class="security-row">
                                    <i class="ti ti-check"></i>
                                    Upper & Lowercase Letters
                                </div>

                                <div class="security-row">
                                    <i class="ti ti-check"></i>
                                    Numbers & Symbols
                                </div>

                            </div>

                        </div>

                        <div class="security-message">

                            <span class="platform-badge">
                                Account Security
                            </span>

                            <h1 class="hero-title">
                                Create a Strong
                                <span>Password</span>
                            </h1>

                            <p class="hero-description">
                                Protect your eSchoolKart account with
                                a strong password and keep your school
                                management data secure.
                            </p>

                        </div>

                    </div>

                </div>

                <!-- Right Side -->

                <div class="col-lg-6 d-flex align-items-center justify-content-center auth-right">

                    <div class="login-wrapper-inner">

                        <a href="{{ route('login') }}" class="brand-logo mb-4">

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

                        <div class="login-card">

                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="text-center mb-4">

                                    <h4 class="fw-bold mb-2">
                                        Create New Password 🔐
                                    </h4>

                                    <p class="text-muted mb-0">
                                        Enter a strong password for your account
                                    </p>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">
                                        Email Address
                                    </label>

                                    <input type="email" name="email" value="{{ old('email', $request->email) }}"
                                        class="form-control auth-input @error('email') is-invalid @enderror" readonly>

                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">
                                        New Password
                                    </label>

                                    <div class="position-relative">

                                        <input type="password" id="password" name="password"
                                            class="form-control auth-input pe-5 @error('password') is-invalid @enderror"
                                            placeholder="Enter new password" required>

                                        <button type="button" class="password-toggle" data-target="password">

                                            <i class="ti ti-eye"></i>

                                        </button>

                                    </div>

                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">
                                        Confirm Password
                                    </label>

                                    <div class="position-relative">

                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control auth-input pe-5" placeholder="Confirm password" required>

                                        <button type="button" class="password-toggle" data-target="password_confirmation">

                                            <i class="ti ti-eye"></i>

                                        </button>

                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-auth">

                                    Reset Password

                                </button>

                                <a href="{{ route('login') }}" class="btn btn-light border w-100 mt-3">

                                    Back To Login

                                </a>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

    <script>
        document.querySelectorAll('.password-toggle')
            .forEach(function(button) {

                button.addEventListener('click', function() {

                    const target =
                        document.getElementById(
                            this.dataset.target
                        );

                    const icon =
                        this.querySelector('i');

                    if (target.type === 'password') {

                        target.type = 'text';

                        icon.className =
                            'ti ti-eye-off';

                    } else {

                        target.type = 'password';

                        icon.className =
                            'ti ti-eye';

                    }

                });

            });
    </script>
    <script>
        $(document).ready(function() {

            $('#password').on('keyup', function() {

                let password =
                    $(this).val();

                let strength = 0;

                if (password.length >= 8)
                    strength += 25;

                if (/[A-Z]/.test(password))
                    strength += 25;

                if (/[0-9]/.test(password))
                    strength += 25;

                if (/[^A-Za-z0-9]/.test(password))
                    strength += 25;

                $('#strengthFill').css(
                    'width',
                    strength + '%'
                );

                if (strength <= 25) {

                    $('#strengthFill').css(
                        'background',
                        '#ef4444'
                    );

                    $('#strengthText').html(
                        '🔴 Weak Password'
                    );

                } else if (strength <= 50) {

                    $('#strengthFill').css(
                        'background',
                        '#f59e0b'
                    );

                    $('#strengthText').html(
                        '🟡 Medium Password'
                    );

                } else if (strength <= 75) {

                    $('#strengthFill').css(
                        'background',
                        '#3b82f6'
                    );

                    $('#strengthText').html(
                        '🔵 Good Password'
                    );

                } else {

                    $('#strengthFill').css(
                        'background',
                        '#22c55e'
                    );

                    $('#strengthText').html(
                        '🟢 Strong Password'
                    );

                }

            });

        });
    </script>
@endsection
