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
            border-radius: 28px;
            box-shadow: 0 40px 100px -20px rgba(50, 50, 93, 0.12), 0 30px 60px -30px rgba(0, 0, 0, 0.15);
            background: var(--bg-glass);
            backdrop-filter: blur(15px);
            padding: 3.5rem;
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
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

        .nav-tabs-custom {
            background: #f1f4f8;
            padding: 6px;
            border-radius: 16px;
            border: none;
            display: flex;
            margin-bottom: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .nav-tabs-custom .nav-item {
            flex: 1;
        }

        .nav-tabs-custom .nav-link {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            color: var(--text-muted);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
        }

        .nav-tabs-custom .nav-link.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .nav-tabs-custom .nav-link:hover:not(.active) {
            color: var(--primary);
            background: rgba(255, 255, 255, 0.5);
        }

        .floating-label-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control-custom {
            height: 60px;
            padding: 12px 16px 12px 52px;
            border-radius: 16px;
            border: 2px solid #eef2f7;
            background: #f8fafc;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 10px 20px rgba(107, 98, 221, 0.08);
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control-custom:focus + .input-icon {
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
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

        .btn-login {
            height: 56px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.1rem;
            background: var(--primary);
            border: none;
            box-shadow: 0 10px 20px rgba(107, 98, 221, 0.2);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
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

        /* Step Transitions */
        .step-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .fade-out {
            opacity: 0;
            transform: translateX(-20px);
            pointer-events: none;
        }
        
        .fade-in {
            opacity: 1 !important;
            transform: translateX(0) !important;
        }

        .otp-input-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .otp-digit {
            width: 45px;
            height: 55px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            border: 2px solid #eef2f7;
            border-radius: 12px;
            background: #f8fafc;
            transition: all 0.3s ease;
        }

        .otp-digit:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(107, 98, 221, 0.1);
            outline: none;
        }
    </style>

    <div class="auth-wrapper">
        <div class="container-fluid p-0">
            <div class="row g-0 min-vh-100">
                
                <!-- Left Content -->
                <div class="col-lg-7 d-none d-lg-flex align-items-center justify-content-center auth-left">
                    <div class="p-5 animate__animated animate__fadeInLeft" style="max-width: 600px;">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            Seamless Uniform <br>
                            <span style="color: var(--primary-light)">Management System</span>
                        </h1>
                        <p class="lead text-white-50 mb-5">
                            Everything you need to manage school uniforms, inventory, and orders in one powerful dashboard.
                        </p>

                        <div class="feature-item">
                            <div class="feature-icon-circle"><i class="ti ti-building-school"></i></div>
                            <div>
                                <h5 class="mb-1 fw-bold">School Portal</h5>
                                <p class="mb-0 text-white-50 small">Automated order processing for schools</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-circle"><i class="ti ti-users"></i></div>
                            <div>
                                <h5 class="mb-1 fw-bold">Vendor Dashboard</h5>
                                <p class="mb-0 text-white-50 small">Manage stock and track performance</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-circle"><i class="ti ti-device-mobile"></i></div>
                            <div>
                                <h5 class="mb-1 fw-bold">Multi-Login Support</h5>
                                <p class="mb-0 text-white-50 small">Secure Password or instant OTP access</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Form -->
                <div class="col-lg-5 d-flex align-items-center justify-content-center p-4">
                    <div class="login-card animate__animated animate__fadeInRight">
                        
                        <div class="text-center mb-5">
                            <a href="/" class="brand-logo justify-content-center mb-4">
                                <div class="brand-icon"><i class="ti ti-school"></i></div>
                                <span class="brand-name">eSchoolKart</span>
                            </a>
                            <h3 class="fw-bold text-secondary">Welcome Back!</h3>
                            <p class="text-muted">Choose your preferred login method</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
                                <i class="ti ti-circle-check me-2"></i> {{ session('status') }}
                            </div>
                        @endif

                        <ul class="nav nav-tabs nav-tabs-custom" id="loginTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-pane" type="button" role="tab">
                                    <i class="ti ti-lock-square me-2"></i> Password
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="otp-tab" data-bs-toggle="tab" data-bs-target="#otp-pane" type="button" role="tab">
                                    <i class="ti ti-device-mobile me-2"></i> OTP
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="loginTabsContent">
                            <!-- Password Login Pane -->
                            <div class="tab-pane fade show active" id="password-pane" role="tabpanel">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="floating-label-group">
                                        <input type="text" name="email" value="{{ old('email') }}" 
                                               class="form-control form-control-custom @error('email') is-invalid @enderror" 
                                               placeholder="Email or Username" required autofocus>
                                        <i class="ti ti-mail input-icon"></i>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="floating-label-group">
                                        <div class="position-relative">
                                            <input type="password" name="password" id="passwordInput"
                                                   class="form-control form-control-custom @error('password') is-invalid @enderror" 
                                                   placeholder="Password" required>
                                            <i class="ti ti-key input-icon"></i>
                                            <button type="button" class="password-toggle" onclick="togglePass('passwordInput', this)">
                                                <i class="ti ti-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                            <label class="form-check-label text-muted small" for="remember">Remember me</label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-primary small fw-bold text-decoration-none">Forgot?</a>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 btn-login">
                                        Sign In <i class="ti ti-arrow-right ms-2"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- OTP Login Pane -->
                            <div class="tab-pane fade" id="otp-pane" role="tabpanel">
                                <form id="otpForm" method="POST" action="{{ route('otp.login') }}">
                                    @csrf
                                    <div id="emailStep" class="step-transition">
                                        <div class="floating-label-group">
                                            <input type="email" id="otpEmail" name="email" 
                                                   class="form-control form-control-custom" 
                                                   placeholder="Enter registered email" required>
                                            <i class="ti ti-mail input-icon"></i>
                                            <div id="otpEmailError" class="invalid-feedback d-block"></div>
                                        </div>
                                        <button type="button" id="sendOtpBtn" class="btn btn-primary w-100 btn-login">
                                            Get OTP <i class="ti ti-send ms-2"></i>
                                        </button>
                                    </div>

                                    <div id="otpStep" class="step-transition d-none" style="opacity: 0; transform: translateX(20px);">
                                        <div class="text-center mb-4">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-light bg-opacity-10 text-primary p-3 rounded-circle mb-3">
                                                <i class="ti ti-mail-opened fs-2"></i>
                                            </div>
                                            <p class="text-muted small">We've sent a 6-digit code to<br><span id="displayEmail" class="fw-bold text-secondary"></span></p>
                                        </div>
                                        
                                        <div class="floating-label-group">
                                            <input type="text" name="otp" id="otpCode" 
                                                   class="form-control form-control-custom text-center fw-bold fs-4" 
                                                   placeholder="· · · · · ·" maxlength="6" required
                                                   style="letter-spacing: 0.5rem;">
                                            <i class="ti ti-shield-check input-icon"></i>
                                            <div id="otpCodeError" class="invalid-feedback d-block"></div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember_otp">
                                                <label class="form-check-label text-muted small" for="remember_otp">Remember me</label>
                                            </div>
                                            <div class="text-end">
                                                <span id="timerText" class="text-muted small d-block"></span>
                                                <button type="button" id="resendOtpBtn" class="btn btn-link text-primary small fw-bold p-0 text-decoration-none d-none">Resend OTP</button>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 btn-login">
                                            Verify & Login <i class="ti ti-circle-check ms-2"></i>
                                        </button>
                                        
                                        <button type="button" class="btn btn-link w-100 mt-3 text-muted small text-decoration-none" onclick="resetOtpSteps()">
                                            <i class="ti ti-arrow-left me-1"></i> Use different email
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePass(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('ti-eye', 'ti-eye-off');
            } else {
                input.type = 'password';
                icon.classList.replace('ti-eye-off', 'ti-eye');
            }
        }

        function resetOtpSteps() {
            $('#otpStep').addClass('fade-out');
            setTimeout(() => {
                $('#otpStep').addClass('d-none').removeClass('fade-out fade-in');
                $('#emailStep').removeClass('d-none').addClass('fade-in');
                $('#otpEmailError, #otpCodeError').text('');
                $('#sendOtpBtn').prop('disabled', false).html('Get OTP <i class="ti ti-send ms-2"></i>');
            }, 400);
        }

        $(document).ready(function() {
            // Show toast on server-side error
            @if($errors->has('email') || $errors->has('password'))
                toast.error("{{ $errors->first('email') ?: $errors->first('password') }}");
            @endif

            @if($errors->has('otp') || old('otp'))
                setTimeout(function() {
                    const otpTab = document.querySelector('#otp-tab');
                    if (otpTab) {
                        const tab = new bootstrap.Tab(otpTab);
                        tab.show();
                        $('#displayEmail').text("{{ old('email') }}");
                        $('#otpEmail').val("{{ old('email') }}");
                        $('#emailStep').addClass('d-none');
                        $('#otpStep').removeClass('d-none').addClass('fade-in');
                    }
                }, 100);
            @endif

            $('#sendOtpBtn').click(function() {
                const email = $('#otpEmail').val();
                const btn = $(this);
                
                if(!email) {
                    $('#otpEmailError').text('Please enter your email.');
                    return;
                }

                btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Sending...');
                $('#otpEmailError').text('');

                $.ajax({
                    url: "{{ route('otp.send') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: email
                    },
                    success: function(response) {
                        $('#displayEmail').text(email);
                        
                        // Start animation
                        $('#emailStep').addClass('fade-out');
                        setTimeout(() => {
                            $('#emailStep').addClass('d-none');
                            $('#otpStep').removeClass('d-none');
                            setTimeout(() => {
                                $('#otpStep').addClass('fade-in');
                            }, 50);
                            startTimer(60);
                        }, 400);
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('Get OTP <i class="ti ti-send ms-2"></i>');
                        if(xhr.status === 422) {
                            $('#otpEmailError').text(xhr.responseJSON.errors.email[0]);
                        } else {
                            $('#otpEmailError').text('Failed to send OTP. Try again.');
                        }
                    }
                });
            });

            let timerInterval;
            function startTimer(duration) {
                let timer = duration;
                $('#resendOtpBtn').addClass('d-none');
                clearInterval(timerInterval);
                timerInterval = setInterval(function () {
                    let minutes = parseInt(timer / 60, 10);
                    let seconds = parseInt(timer % 60, 10);
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    $('#timerText').text("Resend available in " + minutes + ":" + seconds);

                    if (--timer < 0) {
                        clearInterval(timerInterval);
                        $('#timerText').text("");
                        $('#resendOtpBtn').removeClass('d-none');
                    }
                }, 1000);
            }

            $('#resendOtpBtn').click(function() {
                $('#sendOtpBtn').click();
            });

            // AJAX Login Submission
            $('#otpForm').submit(function(e) {
                e.preventDefault();
                const form = $(this);
                const btn = form.find('button[type="submit"]');
                const originalHtml = btn.html();

                btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Verifying...');
                $('#otpCodeError').text('');

                $.ajax({
                    url: form.attr('action'),
                    method: "POST",
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        btn.html('<i class="ti ti-check me-2"></i> Success!').addClass('btn-success').removeClass('btn-primary');
                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 500);
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html(originalHtml);
                        if(xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            if(errors.otp) $('#otpCodeError').text(errors.otp[0]);
                            if(errors.email) $('#otpEmailError').text(errors.email[0]);
                        } else {
                            $('#otpCodeError').text('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endsection