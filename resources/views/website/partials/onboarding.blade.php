{{-- ==========================================================
     Onboarding Hub — Schools & Vendors (complete + premium alerts)
     Requires jQuery + SweetAlert2 (included below) and
     <meta name="csrf-token" content="{{ csrf_token() }}"> in your layout head.
=========================================================== --}}
<section id="become-partner-section" class="py-5"
    style="background-color: var(--qu-bg-light); border-bottom: 1px solid var(--qu-border-color);">
    <div class="container">

        <!-- Tab Triggers -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <span class="badge-geo mb-2"
                    style="background-color: var(--qu-badge-bg); color: var(--qu-primary);">Marketplace Hub</span>
                <h2 class="display-6 fw-extrabold text-dark mb-3"
                    style="font-family: var(--font-display); color: var(--qu-primary) !important;">
                    Onboard Your Organization
                </h2>
                <p class="text-secondary mb-4 small">Select your portal to join the country's leading official school
                    supply ecosystem.</p>

                <div class="d-inline-flex p-1 bg-white rounded-pill border" style="box-shadow: var(--qu-shadow-sm);">
                    <button type="button" class="btn rounded-pill px-4 py-2 fw-semibold" id="tab-school-btn"
                        onclick="switchOnboardingTab('school')" aria-selected="true" role="tab"
                        style="font-size: 14px; border: none; background-color: var(--qu-primary); color: var(--qu-bg-white); transition: all 0.3s ease;">
                        Register Your School
                    </button>
                    <button type="button" class="btn rounded-pill px-4 py-2 fw-semibold text-secondary"
                        id="tab-vendor-btn" onclick="switchOnboardingTab('vendor')" aria-selected="false" role="tab"
                        style="font-size: 14px; border: none; background-color: transparent; color: var(--qu-secondary); transition: all 0.3s ease;">
                        Become a Vendor
                    </button>
                </div>
            </div>
        </div>

        <!-- School Partner Tab Panel -->
        <div id="tab-content-school" class="onboarding-tab-content">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge-geo mb-3"
                        style="background-color: var(--qu-badge-bg); color: var(--qu-primary);">For Academic
                        Institutions</span>
                    <h3 class="display-6 fw-bold text-dark mb-3"
                        style="font-family: var(--font-display); color: var(--qu-primary) !important;">
                        Sell Official Uniforms
                    </h3>
                    <p class="fs-6 text-secondary mb-4" style="line-height: 1.7;">
                        Create a custom-crested digital storefront for your educational campus on eSchoolKart. Enable
                        parents to search, size, and purchase authenticated uniforms, books, and sports kits with
                        absolute trust and zero queue-times.
                    </p>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--qu-primary)" stroke-width="2.5" class="flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold text-dark small">Official School Partners</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--qu-primary)" stroke-width="2.5" class="flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold text-dark small">Quality Assured Standards</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--qu-primary)" stroke-width="2.5" class="flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold text-dark small">Dedicated Customer Support</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--qu-primary)" stroke-width="2.5" class="flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold text-dark small">Authorized Badge Cresting</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card-geo p-4 border-0 shadow-sm" style="background-color: var(--qu-bg-white);">
                        <h4 class="fw-bold text-dark mb-1">Register Your School</h4>
                        <p class="text-secondary small mb-4">Our Institutional Partnerships manager will contact you
                            with mock designs.</p>

                        <form id="partner-school-form" action="{{ route('website.partnership.school') }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">School Name</label>
                                    <input type="text" name="school_name" required class="form-control"
                                        placeholder="e.g. St. Xavier's High"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Contact Person</label>
                                    <input type="text" name="contact_person" required class="form-control"
                                        placeholder="e.g. Principal Sharma"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Email Address</label>
                                    <input type="email" name="email" required class="form-control"
                                        placeholder="admin@school.edu"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Phone Number</label>
                                    <input type="tel" name="phone" required class="form-control"
                                        placeholder="+91 98765 43210"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Upload Proof / Registration Document
                                        (PDF, JPG, PNG)</label>
                                    <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png"
                                        class="form-control"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                </div>
                                <div class="col-12">
                                    <button type="submit" id="submitSchoolRequest"
                                        class="btn btn-primary w-100 py-3 mt-2"
                                        style="border-radius: var(--qu-radius-sm); font-weight: 600;">Submit
                                        Partnership Request</button>
                                </div>
                            </div>
                        </form>

                        <div id="partner-school-success" class="d-none text-center py-4">
                            <div
                                style="background-color: #DEF7EC; color: #03543F; width: 56px; height: 56px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <h5 class="fw-bold text-dark">Partnership Request Submitted!</h5>
                            <p class="text-secondary small mb-0 mt-2">Thank you! Our Institutional Onboarding Team will
                                reach out to schedule a virtual portal demo and garment sample validation in 24 hours.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor Partner Tab Panel -->
        <div id="tab-content-vendor" class="onboarding-tab-content d-none">
            <div class="row align-items-center g-5 flex-row-reverse">
                <div class="col-lg-6">
                    <span class="badge-geo mb-3"
                        style="background-color: var(--qu-badge-bg); color: var(--qu-primary);">Join eSchoolKart</span>
                    <h3 class="display-6 fw-bold text-dark mb-3"
                        style="font-family: var(--font-display); color: var(--qu-primary) !important;">
                        Become an Approved Supplier
                    </h3>
                    <p class="fs-6 text-secondary mb-4" style="line-height: 1.7;">
                        Are you an authorized manufacturer or licensed supplier of premium school shoes, accessories,
                        stationery, or bags? Access high-volume, secure seasonal demand by distributing verified
                        products straight to school-authorized dashboards.
                    </p>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--qu-primary)" stroke-width="2.5" class="flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold text-dark small">Secure Payments Gateway</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--qu-primary)" stroke-width="2.5" class="flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold text-dark small">Fast Delivery Logistics</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--qu-primary)" stroke-width="2.5" class="flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold text-dark small">Easy, Integrated Returns</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--qu-primary)" stroke-width="2.5" class="flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold text-dark small">Guaranteed Calendar Volume</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card-geo p-4 border-0 shadow-sm" style="background-color: var(--qu-bg-white);">
                        <h4 class="fw-bold text-dark mb-1">Apply to Supply</h4>
                        <p class="text-secondary small mb-4">Submit your manufacturing registration details to undergo
                            credential verification.</p>

                        <form id="vendor-partner-form" action="{{ route('website.partnership.vendor') }}"
                            method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Company Name</label>
                                    <input type="text" name="company_name" required class="form-control"
                                        placeholder="e.g. Apex Uniform Mills"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Product Category</label>
                                    <select name="category" required class="form-select"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                        <option value="" disabled selected>Select category...</option>
                                        <option value="uniforms">Uniform Fabrics & Tailoring</option>
                                        <option value="shoes">School Shoes & Socks</option>
                                        <option value="bags">School Bags & Accessories</option>
                                        <option value="books">Stationery, Books & Art Kits</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Contact Email</label>
                                    <input type="email" name="email" required class="form-control"
                                        placeholder="partner@company.com"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">GSTIN / Corporate ID</label>
                                    <input type="text" name="gstin" required class="form-control"
                                        placeholder="e.g. 29GGGGG1314R1Z1"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Upload Business License / GST
                                        Certificate (PDF, JPG, PNG)</label>
                                    <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png"
                                        class="form-control"
                                        style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 py-3 mt-2"
                                        style="border-radius: var(--qu-radius-sm); font-weight: 600;">Apply as
                                        Authorized Supplier</button>
                                </div>
                            </div>
                        </form>

                        <div id="vendor-partner-success" class="d-none text-center py-4">
                            <div
                                style="background-color: #DEF7EC; color: #03543F; width: 56px; height: 56px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <h5 class="fw-bold text-dark">Supplier Application Received!</h5>
                            <p class="text-secondary small mb-0 mt-2">Thank you! Your company details and catalog
                                categories are successfully registered. Our Merchant Desk will review your tax status
                                and GST credentials within 2 business days.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- 21. Footer --}}


{{-- =========================================================
     Premium SweetAlert2 theme + form wiring
========================================================= --}}
<style>
    /* Premium alert shell — rounded, elevated, with a brand accent bar
           echoing the ribbon strip used on the product/school cards. */
    .swal-premium {
        border-radius: 22px !important;
        padding: 2rem 1.75rem 1.75rem !important;
        overflow: hidden;
        position: relative;
        box-shadow: 0 24px 64px rgba(15, 23, 42, 0.22) !important;
    }

    .swal-premium::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--qu-primary, #1E3A8A) 0%, var(--qu-accent, #F97316) 100%);
    }

    .swal-premium .swal2-title {
        font-family: var(--font-display, 'Outfit', sans-serif);
        font-weight: 700;
        color: var(--qu-primary, #1E3A8A);
        font-size: 1.4rem;
        padding-top: 0.25rem;
    }

    .swal-premium .swal2-html-container {
        font-size: 0.94rem;
        color: #475569;
        line-height: 1.6;
    }

    .swal-premium .swal2-icon {
        border-width: 2.5px;
        transform: scale(0.9);
    }

    .swal-btn-premium {
        border-radius: 999px !important;
        padding: 0.65rem 2rem !important;
        font-weight: 700 !important;
        font-size: 0.9rem !important;
        box-shadow: 0 8px 20px rgba(30, 58, 138, 0.25) !important;
        transition: transform 0.15s ease !important;
    }

    .swal-btn-premium:hover {
        transform: translateY(-1px);
    }

    /* Toast */
    .swal-toast-premium {
        border-radius: 14px !important;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.18) !important;
        padding: 0.85rem 1.1rem !important;
    }

    .swal-toast-premium .swal2-title {
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        color: #1e293b !important;
    }
</style>

<script>
    $(document).ready(function() {

        /* =====================================================================
           Tab switching — the buttons call this on click, but it was never
           defined anywhere, so "Become a Vendor" did nothing.
           ===================================================================== */
        window.switchOnboardingTab = function(tab) {
            var isSchool = tab === 'school';

            $('#tab-content-school').toggleClass('d-none', !isSchool);
            $('#tab-content-vendor').toggleClass('d-none', isSchool);

            var $schoolBtn = $('#tab-school-btn');
            var $vendorBtn = $('#tab-vendor-btn');

            $schoolBtn.css({
                backgroundColor: isSchool ? 'var(--qu-primary)' : 'transparent',
                color: isSchool ? 'var(--qu-bg-white)' : 'var(--qu-secondary)',
            }).attr('aria-selected', isSchool);

            $vendorBtn.css({
                backgroundColor: !isSchool ? 'var(--qu-primary)' : 'transparent',
                color: !isSchool ? 'var(--qu-bg-white)' : 'var(--qu-secondary)',
            }).attr('aria-selected', !isSchool);
        };

        /* =====================================================================
           Toast — referenced as showToast() below but never implemented, so
           the "if (typeof showToast === 'function')" guard always no-op'd.
           ===================================================================== */
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
            customClass: {
                popup: 'swal-toast-premium'
            },
            didOpen: function(el) {
                el.addEventListener('mouseenter', Swal.stopTimer);
                el.addEventListener('mouseleave', Swal.resumeTimer);
            },
        });

        function showToast(message) {
            Toast.fire({
                icon: 'success',
                title: message
            });
        }

        function csrfToken() {
            var token = $('meta[name="csrf-token"]').attr('content');
            if (!token) {
                console.warn('No <meta name="csrf-token"> found — add one to your layout <head>.');
                return '{{ csrf_token() }}';
            }
            return token;
        }

        function wireForm(formId, successPanelId, options) {

            const $form = $('#' + formId);

            if (!$form.length) {
                console.error('Form not found:', formId);
                return;
            }

            $form.on('submit', function(e) {

                e.preventDefault();

                const $submitBtn = $form.find('button[type="submit"]');
                const originalText = $submitBtn.html();

                $submitBtn
                    .prop('disabled', true)
                    .html('<span class="spinner-border spinner-border-sm me-2"></span>' + options
                        .loadingText);

                $.ajax({

                    url: $form.attr('action'),
                    type: 'POST',
                    data: new FormData(this),

                    processData: false,
                    contentType: false,
                    cache: false,

                    dataType: 'json',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken(),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },

                    beforeSend: function() {

                        console.group('%c========== AJAX REQUEST ==========',
                            'color:blue;font-weight:bold;');

                        console.log('URL :', $form.attr('action'));
                        console.log('Method : POST');

                        console.groupEnd();
                    },

                    success: function(response, textStatus, xhr) {

                        console.group('%c========== AJAX SUCCESS ==========',
                            'color:green;font-weight:bold;');

                        console.log('Status :', xhr.status);
                        console.log('Response :', response);

                        const contentType = xhr.getResponseHeader('Content-Type');

                        console.log('Content-Type :', contentType);

                        if (contentType && contentType.indexOf('text/html') !== -1) {

                            console.error('❌ Server returned HTML instead of JSON');

                            console.log(xhr.responseText);

                            console.groupEnd();

                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Response',
                                html: '<b>Server returned HTML instead of JSON.</b><br><br>Check Console.'
                            });

                            return;
                        }

                        console.groupEnd();

                        Swal.fire({
                            icon: 'success',
                            iconColor: '#10B981',
                            title: response.title || options.successTitle,
                            text: response.message || options.successMessage,
                            confirmButtonText: 'Awesome!',
                            confirmButtonColor: '#1E3A8A'
                        }).then(function() {

                            $form.trigger('reset');
                            $form.addClass('d-none');

                            $('#' + successPanelId).removeClass('d-none');

                            if (typeof showToast === 'function') {
                                showToast(options.toastMessage);
                            }

                        });

                    },

                    error: function(xhr, textStatus, errorThrown) {

                        console.group('%c========== AJAX ERROR ==========',
                            'color:red;font-weight:bold;');

                        console.log('Status Code :', xhr.status);
                        console.log('Status Text :', xhr.statusText);
                        console.log('Text Status :', textStatus);
                        console.log('Error Thrown :', errorThrown);

                        console.log('Response JSON :');
                        console.log(xhr.responseJSON);

                        console.log('Response Text :');
                        console.log(xhr.responseText);

                        console.log('Response Headers :');
                        console.log(xhr.getAllResponseHeaders());

                        if (xhr.responseText) {

                            if (
                                xhr.responseText.indexOf('<!DOCTYPE html>') !== -1 ||
                                xhr.responseText.indexOf('<html') !== -1
                            ) {

                                console.error('❌ HTML returned instead of JSON');

                                const title = xhr.responseText.match(
                                    /<title>(.*?)<\/title>/i);

                                if (title) {
                                    console.error('HTML Page Title :', title[1]);
                                }

                                console.log(xhr.responseText.substring(0, 3000));
                            }

                        }

                        console.groupEnd();

                        if (xhr.status === 422 && xhr.responseJSON?.errors) {

                            let html = '<ul class="text-start mb-0 ps-3">';

                            $.each(xhr.responseJSON.errors, function(key, value) {
                                html +=
                                    `<li><strong>${key}</strong> : ${value[0]}</li>`;
                            });

                            html += '</ul>';

                            Swal.fire({
                                icon: 'warning',
                                title: 'Validation Error',
                                html: html
                            });

                            return;
                        }

                        if (xhr.status === 419) {

                            Swal.fire({
                                icon: 'error',
                                title: '419 CSRF Token Expired',
                                html: '<b>Your session has expired.</b><br>Please refresh the page.'
                            });

                            return;
                        }

                        if (xhr.status === 401) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Unauthorized',
                                text: 'Please login first.'
                            });

                            return;
                        }

                        if (xhr.status === 403) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Forbidden',
                                text: 'You do not have permission.'
                            });

                            return;
                        }

                        if (xhr.status === 404) {

                            Swal.fire({
                                icon: 'error',
                                title: '404 Route Not Found',
                                html: '<b>Check the form action URL.</b>'
                            });

                            return;
                        }

                        if (xhr.status === 500) {

                            Swal.fire({
                                icon: 'error',
                                title: '500 Internal Server Error',
                                html: '<b>Check storage/logs/laravel.log</b>'
                            });

                            return;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: options.errorTitle || 'Something went wrong',
                            html: `
                        <div class="text-start">
                            <b>Status :</b> ${xhr.status}<br>
                            <b>Error :</b> ${errorThrown}<br><br>
                            <small>Open Console (F12) for complete debug information.</small>
                        </div>
                    `
                        });

                    },

                    complete: function() {

                        $submitBtn
                            .prop('disabled', false)
                            .html(originalText);
                    }

                });

            });

        }

        wireForm('partner-school-form', 'partner-school-success', {
            loadingText: 'Submitting...',
            successTitle: 'School Partnership Request Submitted!',
            successMessage: 'Thank you for your interest. Our onboarding team will contact you shortly.',
            errorTitle: 'School Partnership Submission Failed',
            toastMessage: '🏫 Partnership request submitted!',
        });

        wireForm('vendor-partner-form', 'vendor-partner-success', {
            loadingText: 'Submitting...',
            successTitle: 'Vendor Application Submitted!',
            successMessage: 'Thank you for applying as a supplier.',
            errorTitle: 'Vendor Application Submission Failed',
            toastMessage: '🏢 Supplier application received!',
        });

    });
</script>
