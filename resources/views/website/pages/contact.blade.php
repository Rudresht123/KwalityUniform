@extends('website.components.common')

@section('content')
    <!-- ================= Hero ================= -->

    <div class="geo-page-header">

        <div class="geo-page-header-overlay"></div>

        <div class="container">

            <span class="badge-geo mb-3">


                Contact Us
            </span>

            <h1 class="display-4 fw-bold text-white">
                We'd Love to Hear From You
            </h1>

            <p class="text-white-50 col-lg-7 fs-5">
                Whether you have questions about uniforms, orders, schools, or partnerships,
                our team is here to help.
            </p>

            <ul class="geo-breadcrumb mt-4">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>&bull;</li>
                <li class="active-item">Contact Us</li>
            </ul>

        </div>

    </div>

    <!-- ================= Contact ================= -->

    <section class="py-5">

        <div class="container">

            <div class="row g-5">

                <div class="col-lg-7">

                    <div class="card-geo p-5">

                        <h2 class="fw-bold mb-4">
                            Send us a Message
                        </h2>

                        <form id="contact-form">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">Full Name</label>

                                    <input type="text" name="full_name" id="full_name"
                                        class="form-control form-control-lg" placeholder="Enter your name" required>

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">Email Address</label>

                                    <input type="email" name="email" id="email" class="form-control form-control-lg"
                                        placeholder="Enter email" required>

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">Phone Number</label>

                                    <input type="text" name="phone" id="phone" class="form-control form-control-lg"
                                        placeholder="Enter phone">

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label">Subject</label>

                                    <input type="text" name="subject" id="subject" class="form-control form-control-lg"
                                        placeholder="Subject" required>

                                </div>

                                <div class="col-12 mb-4">

                                    <label class="form-label">
                                        Message
                                    </label>

                                    <textarea rows="6" name="message" id="message" class="form-control" placeholder="Write your message..."
                                        required></textarea>

                                </div>

                                <div class="col-12">

                                    <button type="submit" id="submit-btn" class="btn btn-primary btn-lg px-5">

                                        <i class="fa-solid fa-paper-plane me-2"></i>

                                        Send Message

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

                <div class="col-lg-5">
                     <div class="card-geo p-4 mb-4">

        <div class="d-flex">

            <div class="me-4">

                <i class="fa-solid fa-location-dot fs-2 text-primary"></i>

            </div>

            <div>

                <h5 class="fw-bold">
                    Office Address
                </h5>

                <p class="text-muted mb-0">

                    {{ $contactInfo['address'] }}

                </p>

            </div>

        </div>

    </div>

  

    <div class="card-geo p-4 mb-4">

        <div class="d-flex">

            <div class="me-4">

                <i class="fa-solid fa-envelope fs-2 text-danger"></i>

            </div>

            <div>

                <h5 class="fw-bold">

                    Email

                </h5>

                <p class="text-muted mb-0">

                    {{ $contactInfo['email'] }}

                </p>

            </div>

        </div>

    </div>

    <div class="card-geo p-4">

        <div class="d-flex">

            <div class="me-4">

                <i class="fa-solid fa-clock fs-2 text-warning"></i>

            </div>

            <div>

                <h5 class="fw-bold">

                    Working Hours

                </h5>

                <p class="text-muted mb-0">

                    {!! $contactInfo['hours'] !!}

                </p>

            </div>

        </div>

    </div>

   
                </div>

            </div>

        </div>

    </section>

    <div class="contact-toast" id="contactToast"></div>

    <style>
        .contact-toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1080;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .contact-toast .toast-item {
            background: #1e293b;
            color: #fff;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            box-shadow: 0 10px 24px -8px rgba(15, 23, 42, 0.35);
            display: flex;
            align-items: center;
            gap: 8px;
            animation: toastIn 0.2s ease;
        }

        .contact-toast .toast-item.is-error {
            background: #B91C1C;
        }

        .contact-toast .toast-item.is-success {
            background: #15803D;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            function showToast(message, type) {
                const $toast = $('<div class="toast-item is-' + type + '"><i class="fa-solid fa-' + (type ===
                    'error' ? 'circle-exclamation' : 'circle-check') + '"></i> ' + message + '</div>');
                $('#contactToast').append($toast);
                setTimeout(function() {
                    $toast.fadeOut(200, function() {
                        $(this).remove();
                    });
                }, 4000);
            }

            $('#contact-form').on('submit', function(e) {
                e.preventDefault();

                const $btn = $('#submit-btn');
                const $form = $(this);
                const originalHtml = $btn.html();

                // Clear previous validation states
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                $btn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm me-2"></span> Sending...');

                $.ajax({
                    url: "{{ route('website.contact.send') }}",
                    method: 'POST',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        showToast(response.message, 'success');
                        $form[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let firstError = '';

                            $.each(errors, function(field, messages) {
                                const $input = $(`#${field}`);
                                $input.addClass('is-invalid');
                                $input.after(
                                    `<div class="invalid-feedback">${messages[0]}</div>`
                                    );
                                if (!firstError) firstError = messages[0];
                            });

                            showToast(firstError || 'Please correct the errors in the form.',
                                'error');
                        } else {
                            showToast('Something went wrong. Please try again later.', 'error');
                        }
                    },
                    complete: function() {
                        $btn.prop('disabled', false).html(originalHtml);
                    }
                });
            });
        });
    </script>

    </div>

    </div>

    </div>

    </section>
@endsection
