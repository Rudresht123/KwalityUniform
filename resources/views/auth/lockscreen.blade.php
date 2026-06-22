@extends('layouts.without-header-footer')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --primary: #6B62DD;
            --primary-light: #8b83e6;
            --secondary: #32325d;
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

        .lock-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 50px 100px -20px rgba(50, 50, 93, 0.15), 0 30px 60px -30px rgba(0, 0, 0, 0.2);
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            padding: 3rem;
            width: 100%;
            max-width: 440px;
            text-align: center;
        }

        .user-avatar-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            object-fit: cover;
        }

        .lock-status-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 32px;
            height: 32px;
            background: #e11d48;
            color: white;
            border-radius: 50%;
            border: 3px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
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
        }

        .btn-unlock {
            height: 56px;
            border-radius: 14px;
            font-weight: 700;
            background: var(--primary);
            border: none;
            box-shadow: 0 10px 20px rgba(107, 98, 221, 0.2);
            transition: all 0.3s ease;
        }

        .btn-unlock:hover {
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
                
                <!-- Left Content: Security Focus -->
                <div class="col-lg-7 d-none d-lg-flex align-items-center justify-content-center auth-left">
                    <div class="p-5 animate__animated animate__fadeInLeft" style="max-width: 600px;">
                        <div class="mb-4">
                            <span class="badge bg-danger-transparent text-danger px-3 py-2 rounded-pill fw-bold">
                                <i class="ti ti-shield-lock me-1"></i> SECURE SESSION
                            </span>
                        </div>
                        <h1 class="display-4 fw-bold text-white mb-4">
                            Your Session is <br>
                            <span style="color: var(--primary-light)">Safely Locked</span>
                        </h1>
                        <p class="lead text-white-50 mb-5">
                            We've paused your session to protect your data. Enter your password to resume exactly where you left off.
                        </p>

                        <div class="feature-item">
                            <div class="feature-icon-circle"><i class="ti ti-lock-check"></i></div>
                            <div>
                                <h5 class="mb-1 fw-bold">Data Protection</h5>
                                <p class="mb-0 text-white-50 small">Your active work is encrypted and secured</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-circle"><i class="ti ti-user-check"></i></div>
                            <div>
                                <h5 class="mb-1 fw-bold">Identity Verified</h5>
                                <p class="mb-0 text-white-50 small">Only you can unlock this specific dashboard</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-circle"><i class="ti ti-refresh"></i></div>
                            <div>
                                <h5 class="mb-1 fw-bold">Auto-Resume</h5>
                                <p class="mb-0 text-white-50 small">Instantly go back to your previous task</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Form: Unlock Card -->
                <div class="col-lg-5 d-flex align-items-center justify-content-center p-4">
                    <div class="lock-card animate__animated animate__fadeInRight">
                        
                        <div class="user-avatar-wrapper animate__animated animate__bounceIn animate__delay-1s">
                            <img src="{{ auth()->user()->avatar_url }}" class="user-avatar" alt="User">
                            <div class="lock-status-icon">
                                <i class="ti ti-lock"></i>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h3 class="fw-bold text-secondary mb-1">Hi, {{ auth()->user()->name }}</h3>
                            <p class="text-muted">Enter your password to unlock the screen</p>
                        </div>

                        <form method="POST" action="{{ route('lockscreen.unlock') }}">
                            @csrf
                            <div class="position-relative mb-4">
                                <input type="password" name="password" class="form-control form-control-custom @error('password') is-invalid @enderror" 
                                       placeholder="Password" required autofocus>
                                <i class="ti ti-key input-icon"></i>
                                @error('password')
                                    <div class="invalid-feedback d-block text-start mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-unlock">
                                Unlock Now <i class="ti ti-lock-open ms-2"></i>
                            </button>

                            <div class="mt-5 pt-3 border-top">
                                <p class="text-muted small mb-0">Not you?</p>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                   class="text-primary fw-bold text-decoration-none">
                                    Sign out and use a different account
                                </a>
                            </div>
                        </form>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
