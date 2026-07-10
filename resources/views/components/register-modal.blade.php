
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg login-modal-dialog">
        <div class="modal-content login-modal-content">

            <button type="button" class="login-modal-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>

            <div class="login-modal-body">

                <div class="login-form-header">
                    <h4 class="login-modal-title">Create Your Account</h4>
                    <p class="login-modal-subtitle">Join our community for seamless uniform shopping</p>
                </div>

                <!-- Step indicator -->
                <div class="login-steps" id="registerSteps">
                    <div class="login-step is-active" data-step="1">
                        <span class="login-step-dot">1</span>
                        <span class="login-step-label">Account</span>
                    </div>
                    <div class="login-step" data-step="2">
                        <span class="login-step-dot">2</span>
                        <span class="login-step-label">Address</span>
                    </div>
                    <div class="login-step" data-step="3">
                        <span class="login-step-dot">3</span>
                        <span class="login-step-label">Personal</span>
                    </div>
                    <div class="login-step" data-step="4">
                        <span class="login-step-dot">4</span>
                        <span class="login-step-label">Emergency</span>
                    </div>
                    <div class="login-step" data-step="5">
                        <span class="login-step-dot">5</span>
                        <span class="login-step-label">Finish</span>
                    </div>
                </div>

                <form id="modalRegisterForm" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="login-panels">

                        <!-- STEP 1 — Account (required) -->
                        <div class="login-panel is-active" data-panel="1">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>Full Name</legend>
                                        <input type="text" name="name" class="login-input" placeholder="John Doe" required autofocus>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>Email Address</legend>
                                        <input type="email" name="email" class="login-input" placeholder="name@example.com" required>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>Password</legend>
                                        <div class="login-input-wrap1">
                                            <input type="password" name="password" id="registerPasswordInput" class="login-input" placeholder="••••••••" required>
                                            <button type="button" class="login-password-toggle" id="registerPasswordToggle">
                                                <i class="ti ti-eye"></i>
                                            </button>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>Confirm Password</legend>
                                        <div class="login-input-wrap1">
                                            <input type="password" name="password_confirmation" id="registerPasswordConfirmInput" class="login-input" placeholder="••••••••" required>
                                            <button type="button" class="login-password-toggle" id="registerPasswordConfirmToggle">
                                                <i class="ti ti-eye"></i>
                                            </button>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <p class="login-panel-hint">Required — everything after this is optional and can be added later from your profile.</p>
                        </div>

                        <!-- STEP 2 — Address (optional) -->
                        <div class="login-panel" data-panel="2">
                            <fieldset class="login-field mb-3">
                                <legend>Residential Address</legend>
                                <input type="text" name="address" class="login-input" placeholder="Street, Apartment, Suite">
                            </fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <fieldset class="login-field mb-3">
                                        <legend>City</legend>
                                        <input type="text" name="city" class="login-input" placeholder="City">
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="login-field mb-3">
                                        <legend>State/Province</legend>
                                        <input type="text" name="state" class="login-input" placeholder="State">
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="login-field mb-3">
                                        <legend>Zip Code</legend>
                                        <input type="text" name="zip_code" class="login-input" placeholder="Zip Code">
                                    </fieldset>
                                </div>
                            </div>
                            <p class="login-panel-hint">Optional — helps us estimate delivery times.</p>
                        </div>

                        <!-- STEP 3 — Personal Details (optional) -->
                        <div class="login-panel" data-panel="3">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>Gender</legend>
                                        <select name="gender" class="login-input">
                                            <option value="" selected disabled>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>Date of Birth</legend>
                                        <input type="date" name="date_of_birth" class="login-input">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>National ID / Passport</legend>
                                        <input type="text" name="national_id" class="login-input" placeholder="ID Number">
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>Alternate Phone</legend>
                                        <input type="text" name="alternate_phone" class="login-input" placeholder="+1 234 567 890">
                                    </fieldset>
                                </div>
                            </div>
                            <p class="login-panel-hint">Optional — used only for age-appropriate sizing recommendations.</p>
                        </div>

                        <!-- STEP 4 — Emergency Contact (optional) -->
                        <div class="login-panel" data-panel="4">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>Emergency Contact Name</legend>
                                        <input type="text" name="emergency_contact_name" class="login-input" placeholder="Full Name">
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="login-field mb-3">
                                        <legend>Emergency Phone</legend>
                                        <input type="text" name="emergency_contact_phone" class="login-input" placeholder="Phone Number">
                                    </fieldset>
                                </div>
                            </div>
                            <fieldset class="login-field mb-3">
                                <legend>Relationship</legend>
                                <input type="text" name="emergency_contact_relationship" class="login-input" placeholder="e.g. Father, Spouse, Sibling">
                            </fieldset>
                            <p class="login-panel-hint">Optional — only used in genuine emergencies.</p>
                        </div>

                        <!-- STEP 5 — Notes + Terms + Submit -->
                        <div class="login-panel" data-panel="5">
                            <fieldset class="login-field mb-3">
                                <legend>Additional Notes</legend>
                                <textarea name="notes" class="login-input" rows="3" placeholder="Any specific requirements or instructions..."></textarea>
                            </fieldset>

                            <div id="modalRegisterFeedback" class="d-none alert alert-small mb-3 py-2 px-3"></div>

                            <div class="login-field mb-2">
                                <label class="login-remember">
                                    <input type="checkbox" name="terms" id="registerTerms" required>
                                    <span class="login-remember-box"><i class="ti ti-check"></i></span>
                                    <span class="login-remember-text">I agree to the <a href="javascript:void(0);" class="fw-bold text-decoration-none login-link">Terms</a> & <a href="javascript:void(0);" class="fw-bold text-decoration-none login-link">Privacy Policy</a></span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- Step navigation -->
                    <div class="login-step-nav">
                        <button type="button" class="btn-step-back" id="registerBackBtn">
                            <i class="ti ti-arrow-left"></i> Back
                        </button>
                        <button type="button" class="btn-step-next" id="registerNextBtn">
                            Continue <i class="ti ti-arrow-right ms-1"></i>
                        </button>
                        <button type="submit" id="modalRegisterSubmitBtn" class="btn-login-submit d-none">
                            <span>Create Account</span> <i class="ti ti-arrow-right ms-1"></i>
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="small text-muted mb-0">
                        Already have an account?
                        <a href="javascript:void(0);" onclick="switchModal('registerModal', 'loginModal')" class="fw-bold text-decoration-none login-link">Sign In</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    // Shared with login-modal.blade.php — only declare this once if both
    // partials are on the same page (the second declaration simply overrides
    // the first with identical behavior, so it's safe either way).
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
        function bindPasswordToggle(toggleId, inputId) {
            $(toggleId).on('click', function() {
                const $input = $(inputId);
                const $icon = $(this).find('i');
                const isPassword = $input.attr('type') === 'password';

                $input.attr('type', isPassword ? 'text' : 'password');
                $icon.toggleClass('ti-eye ti-eye-off');
            });
        }

        bindPasswordToggle('#registerPasswordToggle', '#registerPasswordInput');
        bindPasswordToggle('#registerPasswordConfirmToggle', '#registerPasswordConfirmInput');

        // ---- Step wizard ----
        const TOTAL_STEPS = 5;
        let currentStep = 1;

        const $panels = $('.login-panel');
        const $steps = $('.login-step');
        const $backBtn = $('#registerBackBtn');
        const $nextBtn = $('#registerNextBtn');
        const $submitBtn = $('#modalRegisterSubmitBtn');

        function goToStep(step) {
            currentStep = step;

            $panels.removeClass('is-active');
            $panels.filter('[data-panel="' + step + '"]').addClass('is-active');

            $steps.each(function() {
                const s = parseInt($(this).data('step'));
                $(this).removeClass('is-active is-done');
                if (s === step) $(this).addClass('is-active');
                else if (s < step) $(this).addClass('is-done');
            });

            $backBtn.toggleClass('is-visible', step > 1);

            if (step === TOTAL_STEPS) {
                $nextBtn.addClass('d-none');
                $submitBtn.removeClass('d-none');
            } else {
                $nextBtn.removeClass('d-none');
                $submitBtn.addClass('d-none');
            }
        }

        function validateCurrentPanel() {
            let valid = true;
            const $fields = $panels.filter('[data-panel="' + currentStep + '"]').find('input[required], select[required], textarea[required]');

            $fields.each(function() {
                this.classList.remove('is-invalid-shake');
                if (!this.checkValidity()) {
                    valid = false;
                    $(this).closest('fieldset.login-field, .login-field').addClass('is-invalid');
                    this.reportValidity();
                } else {
                    $(this).closest('fieldset.login-field, .login-field').removeClass('is-invalid');
                }
            });

            return valid;
        }

        $nextBtn.on('click', function() {
            if (!validateCurrentPanel()) return;
            if (currentStep < TOTAL_STEPS) goToStep(currentStep + 1);
        });

        $backBtn.on('click', function() {
            if (currentStep > 1) goToStep(currentStep - 1);
        });

        // Allow clicking a step dot to jump back to a completed step
        $steps.on('click', function() {
            const target = parseInt($(this).data('step'));
            if (target < currentStep) goToStep(target);
        });

        goToStep(1);

        function clearRegisterErrors($form) {
            $form.find('fieldset.login-field, .login-field').removeClass('is-invalid');
        }

        $('#modalRegisterForm').submit(function(e) {
            e.preventDefault();

            if (!validateCurrentPanel()) return;

            const form = $(this);
            const btn = $submitBtn;
            const feedback = $('#modalRegisterFeedback');

            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Creating Account...');
            feedback.addClass('d-none').removeClass('alert-success alert-danger');
            clearRegisterErrors(form);

            $.ajax({
                url: form.attr('action'),
                method: "POST",
                data: form.serialize(),
                dataType: 'json',
                headers: {
                    'Accept': 'application/json'
                },
                success: function(response) {
                    feedback.removeClass('d-none').addClass('alert-success').text(response.message || 'Account created successfully! Redirecting...');
                    setTimeout(function() {
                        window.location.href = response.redirect;
                    }, 1500);
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html('<span>Create Account</span> <i class="ti ti-arrow-right ms-1"></i>');

                    let errorMsg = 'An unexpected error occurred. Please try again.';

                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            const firstErrorKey = Object.keys(errors)[0];
                            errorMsg = errors[firstErrorKey][0];

                            Object.keys(errors).forEach(function(field) {
                                const $field = form.find('[name="' + field + '"]');
                                $field.closest('fieldset.login-field, .login-field').addClass('is-invalid');

                                // Jump to whichever step contains the first error
                                const $panel = $field.closest('.login-panel');
                                if ($panel.length) {
                                    goToStep(parseInt($panel.data('panel')));
                                }
                            });
                        } else if (xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                    } else if (xhr.status === 500) {
                        errorMsg = 'Server error (500). Please check if the site is under maintenance.';
                    } else if (xhr.status) {
                        errorMsg = 'Server returned an error: ' + xhr.status;
                    }

                    feedback.removeClass('d-none').addClass('alert-danger').text(errorMsg);
                }
            });
        });
    });
</script>   