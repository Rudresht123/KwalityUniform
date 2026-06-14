@extends('layouts.without-header-footer')

@section('content')
    <div class="login-wrapper">
        <div class="container-fluid">
            <div class="row min-vh-100">

                <!-- Left Side -->

                <div class="col-lg-7 d-none d-lg-flex auth-left">


                    <div class="left-content">

                        <div>

                            <span class="platform-badge">
                                Secure Account Recovery
                            </span>

                            <h1 class="hero-title">
                                Forgot Your
                                <span>Password?</span>
                            </h1>

                            <p class="hero-description">
                                No worries. Enter your registered email address
                                and we'll send you a secure password reset link
                                to regain access to your account.
                            </p>

                            <div class="security-features">

                                <div class="security-item">

                                    <div class="security-icon">
                                        <i class="ti ti-mail-check"></i>
                                    </div>

                                    <div>
                                        <h6>Email Verification</h6>
                                        <small>
                                            Verify ownership using your registered email
                                        </small>
                                    </div>

                                </div>

                                <div class="security-item">

                                    <div class="security-icon">
                                        <i class="ti ti-shield-lock"></i>
                                    </div>

                                    <div>
                                        <h6>Secure Recovery</h6>
                                        <small>
                                            Password reset links are encrypted and secure
                                        </small>
                                    </div>

                                </div>

                                <div class="security-item">

                                    <div class="security-icon">
                                        <i class="ti ti-lock-access"></i>
                                    </div>

                                    <div>
                                        <h6>Protected Access</h6>
                                        <small>
                                            Keep your account safe from unauthorized access
                                        </small>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="col-lg-5 d-flex align-items-center justify-content-center auth-right">

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

                            <div class="text-center mb-4">

                                <h4 class="fw-bold mb-2">
                                    Forgot Password?
                                </h4>

                                <p class="text-muted mb-0">
                                    Enter your email address to receive a reset link.
                                </p>

                            </div>

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="mb-4">

                                    <label class="form-label">
                                        Email Address
                                    </label>

                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control auth-input @error('email') is-invalid @enderror"
                                        placeholder="Enter your email address" required autofocus>

                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-auth">

                                    Send Reset Link

                                </button>

                                <a href="{{ route('login') }}" class="btn btn-light w-100 mt-3">

                                    Back To Login

                                </a>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </div>


    </div>


    <style>
        .auth-left {


            background:
                linear-gradient(135deg,
                    #6259ca,
                    #7c71ff);

            color: #fff;

            padding: 60px;

            position: relative;

            overflow: hidden;


        }

        .auth-left::before {


            content: "";

            position: absolute;

            width: 450px;
            height: 450px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, .08);

            top: -150px;
            right: -150px;


        }

        .auth-left::after {


            content: "";

            position: absolute;

            width: 350px;
            height: 350px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, .05);

            bottom: -120px;
            left: -120px;


        }

        .left-content {


            position: relative;

            z-index: 2;

            width: 100%;

            display: flex;

            flex-direction: column;

            justify-content: center;
            


        }

        .platform-badge {


            display: inline-block;

            padding: 10px 18px;

            border-radius: 50px;

            background:
                rgba(255, 255, 255, .15);

            margin-bottom: 25px;


        }

        .hero-title {


            font-size: 54px;

            font-weight: 800;

            line-height: 1.2;

            margin-bottom: 20px;


        }

        .hero-title span {


            display: block;

            color: #ffd54f;


        }


        .security-features {


            max-width: 520px;


        }

        .security-item {


            display: flex;

            gap: 15px;

            margin-bottom: 20px;


        }

        .security-icon {


            width: 55px;
            height: 55px;

            border-radius: 15px;

            background:
                rgba(255, 255, 255, .15);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;


        }

        .security-item h6 {


            margin-bottom: 5px;

            color: #fff;


        }

        .security-item small {


            color: #e5e7eb;


        }

        .security-image {


            text-align: center;

            margin-top: 30px;


        }

        .security-image img {


            max-width: 420px;

            width: 100%;


        }
    </style>
@endsection
