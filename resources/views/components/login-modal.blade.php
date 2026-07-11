<!-- Login Modal Component -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl login-modal-dialog">
        <div class="modal-content login-modal-content">

            <button type="button" class="login-modal-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>

            <div class="login-modal-grid">

                {{-- Brand panel --}}
                <div class="login-brand-panel">
                    <div class="login-brand-orb login-brand-orb-1"></div>
                    <div class="login-brand-orb login-brand-orb-2"></div>
                    <div class="login-brand-pattern"></div>

                    <div class="login-brand-content">
                        <div class="login-modal-icon">
                            <i class="ti ti-school"></i>
                        </div>
                        <h4 class="login-modal-title">Welcome Back</h4>
                        <p class="login-modal-subtitle">Sign in to continue to your account</p>

                        <ul class="login-brand-features">
                            <li><span class="login-brand-feature-icon"><i class="ti ti-shield-check"></i></span> Secure, encrypted sign‑in</li>
                            <li><span class="login-brand-feature-icon"><i class="ti ti-bolt"></i></span> Fast OTP‑based access</li>
                            <li><span class="login-brand-feature-icon"><i class="ti ti-users"></i></span> One account, every role</li>
                        </ul>
                    </div>
                </div>

                {{-- Form panel --}}
                <div class="login-form-panel">
                    <div class="login-modal-body">

                        <div class="login-form-header d-md-none">
                            <div class="login-modal-icon login-modal-icon-sm">
                                <i class="ti ti-school"></i>
                            </div>
                            <h4 class="login-modal-title login-modal-title-sm">Welcome Back</h4>
                            <p class="login-modal-subtitle login-modal-subtitle-dark">Sign in to continue to your account</p>
                        </div>

                        {{-- Dual Method Tabs --}}
                        <div class="login-tab-group mb-4" id="modalLoginTabs" role="tablist">
                            <button class="login-tab-btn active" id="modalPassword-tab" data-bs-toggle="tab" data-bs-target="#modalPasswordPane" type="button" role="tab">
                                <i class="ti ti-lock me-2"></i> Password
                            </button>
                            <button class="login-tab-btn" id="modalOtp-tab" data-bs-toggle="tab" data-bs-target="#modalOtpPane" type="button" role="tab">
                                <i class="ti ti-smartphone me-2"></i> OTP
                            </button>
                        </div>

                        <div class="tab-content" id="modalLoginTabsContent">

                            {{-- Password Pane --}}
                            <div class="tab-pane fade show active" id="modalPasswordPane" role="tabpanel">
                                <form id="modalPasswordForm" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div id="modalPasswordFeedback" class="d-none alert alert-small mb-3 py-2 px-3" style="font-size: 13px; border-radius: 8px;"></div>
                                    <div class="login-field mb-3">
                                        <label class="login-field-label">Email or Username</label>
                                        <div class="login-input-wrap">
                                            <span class="login-input-icon-badge"><i class="ti ti-mail"></i></span>
                                            <input type="text" name="email" id="modalLoginEmail" class="login-input" placeholder="name@example.com" required>
                                        </div>
                                    </div>

                                    <div class="login-field mb-3">
                                        <label class="login-field-label">Password</label>
                                        <div class="login-input-wrap">
                                            <span class="login-input-icon-badge"><i class="ti-lock"></i></span>
                                            <input type="password" name="password" id="modalPasswordInput" class="login-input" placeholder="••••••••" required>
                                            <button type="button" class="login-password-toggle" id="modalPasswordToggle">
                                                <i class="ti-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <label class="login-remember">
                                            <input type="checkbox" name="remember" id="modalRemember">
                                            <span class="login-remember-box"><i class="ti ti-check"></i></span>
                                            <span class="login-remember-text">Remember me</span>
                                        </label>
                                        <a href="{{ route('password.request') }}" class="login-forgot-link">Forgot?</a>
                                    </div>

                                    <button type="submit" id="modalPasswordSubmitBtn" class="btn-login-submit">
                                        <span>Sign In</span> <i class="ti-arrow-right ms-1"></i>
                                    </button>
                                </form>
                            </div>

                            {{-- OTP Pane --}}
                            <div class="tab-pane fade" id="modalOtpPane" role="tabpanel">
                                <form id="modalOtpForm" method="POST" action="{{ route('otp.login') }}">
                                    @csrf

                                    <div id="modalOtpFeedback" class="d-none alert alert-small mb-3 py-2 px-3" style="font-size: 13px; border-radius: 8px;"></div>

                                    <div id="modalEmailStep">
                                        <div class="login-field mb-4">
                                            <label class="login-field-label">Registered Email</label>
                                            <div class="login-input-wrap">
                                                <span class="login-input-icon-badge"><i class="ti ti-mail"></i></span>
                                                <input type="email" id="modalOtpEmail" name="email" class="login-input" placeholder="email@example.com" required>
                                            </div>
                                        </div>
                                        <button type="button" id="modalSendOtpBtn" class="btn-login-submit">
                                            <span>Get OTP</span> <i class="ti ti-send ms-1"></i>
                                        </button>
                                    </div>

                                    <div id="modalOtpStep" class="d-none">
                                        <div class="text-center mb-4">
                                            <div class="otp-sent-icon"><i class="ti ti-mail-check"></i></div>
                                            <p class="otp-sent-text">Code sent to <span id="modalDisplayEmail" class="fw-bold"></span></p>
                                        </div>

                                        {{-- Hidden field that actually submits with the form --}}
                                        <input type="hidden" name="otp" id="modalOtpCode">

                                        <div class="login-field mb-4">
                                            <label class="login-field-label text-center d-block">Enter 6-Digit Code</label>
                                            <div class="otp-digit-group" id="otpDigitGroup">
                                                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit-box" data-index="0">
                                                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit-box" data-index="1">
                                                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit-box" data-index="2">
                                                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit-box" data-index="3">
                                                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit-box" data-index="4">
                                                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit-box" data-index="5">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <span id="modalTimerText" class="otp-timer-text"></span>
                                            <button type="button" id="modalResendOtpBtn" class="btn-resend-otp d-none">Resend OTP</button>
                                        </div>

                                        <button type="submit" class="btn-login-submit">
                                            <span>Verify & Login</span> <i class="ti ti-circle-check ms-1"></i>
                                        </button>
                                        <button type="button" class="btn-change-email" onclick="resetModalOtpSteps()">
                                            <i class="ti ti-arrow-left me-1"></i> Change Email
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <div class="text-center mt-4">
                            <p class="small text-muted mb-0">
                                Don't have an account?
                                <a href="javascript:void(0);" onclick="switchModal('loginModal', 'registerModal')" class="fw-bold text-primary text-decoration-none">Register now</a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function resetModalOtpSteps() {
        $('#modalOtpStep').addClass('d-none');
        $('#modalEmailStep').removeClass('d-none');
        $('#modalOtpEmail').val('');
        $('.otp-digit-box').val('').removeClass('is-filled');
        $('#modalOtpCode').val('');
    }

    // Switch between two Bootstrap modals cleanly (hide one, show the other after transition)
    function switchModal(hideId, showId) {
        const $hideModal = $('#' + hideId);
        const $showModal = $('#' + showId);

        if (!$showModal.length) {
            console.warn('Target modal #' + showId + ' not found on this page.');
            return;
        }

        $hideModal.one('hidden.bs.modal', function () {
            const modalInstance = bootstrap.Modal.getOrCreateInstance($showModal[0]);
            modalInstance.show();
        });

        bootstrap.Modal.getInstance($hideModal[0])?.hide();
    }

    $(document).ready(function() {

        // Custom tab active-state sync (Bootstrap's own tab JS handles pane switching)
        $('.login-tab-btn').on('click', function() {
            $('.login-tab-btn').removeClass('active');
            $(this).addClass('active');
        });

        // Password show/hide toggle
        $('#modalPasswordToggle').on('click', function() {
            const $input = $('#modalPasswordInput');
            const $icon = $(this).find('i');
            const isPassword = $input.attr('type') === 'password';

            $input.attr('type', isPassword ? 'text' : 'password');
            $icon.toggleClass('ti-eye ti-eye-off');
        });

        // OTP digit boxes: auto-advance, backspace, and paste support
        const $digitBoxes = $('.otp-digit-box');

        $digitBoxes.on('input', function() {
            const $this = $(this);
            $this.val($this.val().replace(/[^0-9]/g, ''));

            if ($this.val()) {
                $this.addClass('is-filled');
                $digitBoxes.eq($this.data('index') + 1).trigger('focus');
            } else {
                $this.removeClass('is-filled');
            }

            syncOtpCode();
        });

        $digitBoxes.on('keydown', function(e) {
            const $this = $(this);
            if (e.key === 'Backspace' && !$this.val()) {
                $digitBoxes.eq($this.data('index') - 1).trigger('focus');
            }
        });

        $digitBoxes.on('paste', function(e) {
            e.preventDefault();
            const pasted = (e.originalEvent.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
            pasted.split('').slice(0, 6).forEach((char, i) => {
                $digitBoxes.eq(i).val(char).addClass('is-filled');
            });
            syncOtpCode();
            $digitBoxes.eq(Math.min(pasted.length, 5)).trigger('focus');
        });

        function syncOtpCode() {
            let code = '';
            $digitBoxes.each(function() { code += $(this).val(); });
            $('#modalOtpCode').val(code);
        }

        $('#modalSendOtpBtn').click(function() {
            const email = $('#modalOtpEmail').val();
            const btn = $(this);
            const feedback = $('#modalOtpFeedback');
            if (!email) {
                feedback.removeClass('d-none').addClass('alert-danger').text('Please enter email');
                return;
            }

            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Sending...');
            feedback.addClass('d-none');

            $.ajax({
                url: "{{ route('otp.send') }}",
                method: "POST",
                headers: {
                    'Accept': 'application/json'
                },
                data: { _token: "{{ csrf_token() }}", email: email },
                success: function(response) {
                    $('#modalDisplayEmail').text(email);
                    $('#modalEmailStep').addClass('d-none');
                    $('#modalOtpStep').removeClass('d-none');
                    $digitBoxes.eq(0).trigger('focus');
                    startModalTimer(60);
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html('Get OTP <i class="ti ti-send ms-1"></i>');
                    let errorMsg = 'Failed to send OTP';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMsg = Object.values(xhr.responseJSON.errors)[0][0];
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    feedback.removeClass('d-none').addClass('alert-danger').text(errorMsg);
                }
            });
        });

        let modalTimerInterval;
        function startModalTimer(duration) {
            let timer = duration;
            $('#modalResendOtpBtn').addClass('d-none');
            clearInterval(modalTimerInterval);
            modalTimerInterval = setInterval(function () {
                let seconds = timer % 60;
                $('#modalTimerText').text("Resend in " + (seconds < 10 ? "0" + seconds : seconds) + "s");
                if (--timer < 0) {
                    clearInterval(modalTimerInterval);
                    $('#modalTimerText').text("");
                    $('#modalResendOtpBtn').removeClass('d-none');
                }
            }, 1000);
        }

        $('#modalPasswordSubmitBtn').click(function(e) {
            e.preventDefault();
            console.log('Login button clicked. Starting AJAX request...');

            const form = $('#modalPasswordForm');
            const btn = $(this);
            const feedback = $('#modalPasswordFeedback');
            
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Signing In...');
            feedback.addClass('d-none');

            console.log('Form Data:', form.serialize());

            $.ajax({
                url: form.attr('action'),
                method: "POST",
                headers: {
                    'Accept': 'application/json'
                },
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    console.log('Login success response:', response);
                    feedback.removeClass('d-none').addClass('alert-success').text(response.message || 'Login successful! Redirecting...');
                    setTimeout(function() {
                        console.log('Redirecting to:', response.redirect);
                        window.location.href = response.redirect;
                    }, 1500);
                },
                error: function(xhr) {
                    console.error('Login error:', xhr);
                    btn.prop('disabled', false).html('<span>Sign In</span> <i class="ti-arrow-right ms-1"></i>');
                    let errorMsg = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMsg = Object.values(xhr.responseJSON.errors)[0][0];
                    }
                    console.log('Error message to display:', errorMsg);
                    feedback.removeClass('d-none').addClass('alert-danger').text(errorMsg);
                }
            });
        });

        $('#modalOtpForm').submit(function(e) {
            e.preventDefault();

            const feedback = $('#modalOtpFeedback');
            if ($('#modalOtpCode').val().length < 6) {
                feedback.removeClass('d-none').addClass('alert-danger').text('Please enter the complete 6-digit code');
                return;
            }

            const form = $(this);
            const btn = form.find('button[type="submit"]');
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Verifying...');
            feedback.addClass('d-none');

            $.ajax({
                url: form.attr('action'),
                method: "POST",
                headers: {
                    'Accept': 'application/json'
                },
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html('Verify & Login <i class="ti ti-circle-check ms-1"></i>');
                    let errorMsg = 'Verification failed';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMsg = Object.values(xhr.responseJSON.errors)[0][0];
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    feedback.removeClass('d-none').addClass('alert-danger').text(errorMsg);
                }
            });
        });
    });
</script>