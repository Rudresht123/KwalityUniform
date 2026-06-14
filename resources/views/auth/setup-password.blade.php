@extends('layouts.without-header-footer')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --primary: #6B62DD;
            --primary-light: #8b83e6;
            --secondary: #32325d;
            --text-muted: #6b7c93;
            --bg-glass: rgba(255, 255, 255, 0.9);
        }

        .auth-wrapper {
            background: linear-gradient(135deg, #f6f9fc 0%, #eef2f7 100%);
            min-height: 100vh;
        }

        .auth-left {
            background: var(--secondary);
            background-image: radial-gradient(circle at 0% 0%, rgba(107, 98, 221, 0.15) 0%, transparent 50%),
                              radial-gradient(circle at 100% 100%, rgba(107, 98, 221, 0.1) 0%, transparent 50%);
            position: relative;
            overflow: hidden;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.05;
            animation: rotate 100s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .login-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 50px 100px -20px rgba(50, 50, 93, 0.15), 0 30px 60px -30px rgba(0, 0, 0, 0.2);
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            padding: 3rem;
            width: 100%;
            max-width: 480px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 12px;
        }

        .brand-icon {
            background: var(--primary);
            color: white;
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 10px 20px rgba(107, 98, 221, 0.3);
        }

        .brand-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--secondary);
            letter-spacing: -0.5px;
        }

        .setup-badge {
            background: rgba(107, 98, 221, 0.1);
            color: var(--primary);
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .form-control-custom {
            height: 56px;
            padding: 12px 16px 12px 48px;
            border-radius: 14px;
            border: 2px solid #eef2f7;
            background: #f8fafc;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(107, 98, 221, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 0;
        }

        .btn-auth {
            height: 56px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.1rem;
            background: var(--primary);
            border: none;
            box-shadow: 0 10px 20px rgba(107, 98, 221, 0.2);
            transition: all 0.3s ease;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(107, 98, 221, 0.3);
            background: var(--primary-light);
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 16px;
            color: white;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .feature-icon-circle {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    <div class="auth-wrapper">
        <div class="container-fluid p-0">
            <div class="row g-0 min-vh-100">
                
                <!-- Left Content -->
                <div class="col-lg-7 d-none d-lg-flex align-items-center justify-content-center auth-left">
                    <div class="p-5 animate__animated animate__fadeInLeft" style="max-width: 600px;">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            Welcome to the <br>
                            <span style="color: var(--primary-light)">eSchoolKart Family</span>
                        </h1>
                        <p class="lead text-white-50 mb-5">
                            You're just one step away from managing your school uniform ecosystem with ease and security.
                        </p>

                        <div class="feature-item">
                            <div class="feature-icon-circle"><i class="ti ti-user-plus"></i></div>
                            <div>
                                <h5 class="mb-1 fw-bold">Personalized Profile</h5>
                                <p class="mb-0 text-white-50 small">Choose a unique username for your account</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-circle"><i class="ti ti-shield-lock"></i></div>
                            <div>
                                <h5 class="mb-1 fw-bold">Account Security</h5>
                                <p class="mb-0 text-white-50 small">Your data is protected with industry standards</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-circle"><i class="ti ti-check"></i></div>
                            <div>
                                <h5 class="mb-1 fw-bold">Instant Access</h5>
                                <p class="mb-0 text-white-50 small">Ready to start right after setup</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Form -->
                <div class="col-lg-5 d-flex align-items-center justify-content-center p-4">
                    <div class="login-card animate__animated animate__fadeInRight">
                        
                        <div class="text-center mb-4">
                            <a href="/" class="brand-logo justify-content-center mb-4">
                                <div class="brand-icon"><i class="ti ti-school"></i></div>
                                <span class="brand-name">eSchoolKart</span>
                            </a>
                            <div class="setup-badge">
                                <i class="ti ti-rocket me-1"></i> FINAL STEP
                            </div>
                            <h3 class="fw-bold text-secondary mb-1">Account Setup</h3>
                            <p class="text-muted small">Complete your profile for <strong>{{ $user->email }}</strong></p>
                        </div>

                        <form method="POST" action="{{ URL::signedRoute('setup-password.store', ['user' => $user->id]) }}">
                            @csrf

                            <div class="position-relative mb-4">
                                <input id="username" type="text" name="username" value="{{ old('username') }}"
                                    class="form-control form-control-custom @error('username') is-invalid @enderror"
                                    placeholder="Choose a unique username" required autofocus>
                                <i class="ti ti-user input-icon"></i>
                                @error('username')
                                    <div class="invalid-feedback d-block text-start mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="position-relative mb-4">
                                <div class="position-relative">
                                    <input id="password" type="password" name="password"
                                        class="form-control form-control-custom @error('password') is-invalid @enderror"
                                        placeholder="Create a strong password" required>
                                    <i class="ti ti-lock input-icon"></i>
                                    <button type="button" class="password-toggle togglePassword">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block text-start mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="position-relative mb-4">
                                <div class="position-relative">
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                        class="form-control form-control-custom"
                                        placeholder="Confirm your password" required>
                                    <i class="ti ti-lock-check input-icon"></i>
                                    <button type="button" class="password-toggle togglePassword">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-auth mt-2">
                                Complete & Login <i class="ti ti-arrow-right ms-2"></i>
                            </button>

                        </form>

                        <div class="text-center mt-5">
                            <small class="text-muted">
                                © {{ date('Y') }} Kwality Uniform ERP.
                            </small>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.togglePassword').click(function() {
                const input = $(this).parent().find('input');
                const icon = $(this).find('i');
                if (input.attr('type') === "password") {
                    input.attr('type', 'text');
                    icon.removeClass('ti-eye').addClass('ti-eye-off');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('ti-eye-off').addClass('ti-eye');
                }
            });
        });
    </script>
@endsection
