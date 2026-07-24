<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eSchoolKart - Software</title>
    <link rel="icon" href="{{ asset('assets/icons/fav.png') }}">

    {{-- links for the css --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
    @include('partials.datatable-fix')
    </head>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.scss') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/alertify.css') }}">


    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apex.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modal.css') }}">
    <script src="{{ asset('assets/js/alertify.js') }}"></script>
    <script src="{{ asset('assets/modal.js') }}"></script>
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/chartsfunctions.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @notifyCss


    @stack('styles')
    <script>
        window.userId = {{ auth()->id() ?? 'null' }};
    </script>

</head>

<body>
    @include('partials.impersonation-banner')
    @include('components.loader')
    @include('layouts.off-canvas')
    @include('components.alerts')
    <div class="page">
        {{-- Header Include --}}
        @include('layouts.header')

        {{-- Side bar Section --}}
        @include('layouts.aside')

        {{-- Main Section Start Here --}}
        <div class="main-content app-content">
            <div class="container-fluid">

                @include('components.breadcrumb')

                @yield('content')

            </div>
        </div>


        {{-- Footer section --}}
        {{-- @include('layouts.footer') --}}
    </div>
    {{-- links for the js --}}

    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Toast Notifications --}}
    <script src="{{ asset('assets/js/toast.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>


    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/sticky.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard-charts.js') }}"></script>
    <script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script>
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/sticky.js') }}"></script>


    {{-- Datatable --}}
    <script src="{{ asset('assets/js/datatables/datatableinitalize.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/responsive.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/notification.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>

    @if ($errors->any() && !session()->has('notify.message'))
        @php
            notify()->error('Please check the form for validation errors.', 'Validation Failed');
        @endphp
    @endif


    <script>
        // Show loader on page refresh, navigation, or back/forward navigation
        window.addEventListener("beforeunload", function() {
            document.getElementById("preloader").style.display = "block";
        });

        // Show loader even when navigating back/forward using browser arrows
        window.addEventListener("pageshow", function(event) {
            // Show the loader on back/forward navigation
            if (event.persisted) {
                document.getElementById("preloader").style.display = "block";
            }

            // Hide the loader after the page fully loads
            document.getElementById("preloader").style.display = "none";
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const togglePassword =
                document.getElementById('togglePassword');

            const passwordInput =
                document.getElementById('password');

            togglePassword.addEventListener('click', function() {

                const icon =
                    this.querySelector('i');

                if (passwordInput.type === 'password') {

                    passwordInput.type = 'text';

                    icon.classList.remove('ti-eye');
                    icon.classList.add('ti-eye-off');

                } else {

                    passwordInput.type = 'password';

                    icon.classList.remove('ti-eye-off');
                    icon.classList.add('ti-eye');
                }

            });

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const loader = document.getElementById("preloader");

            // Hide loader after page load
            window.addEventListener("load", function() {

                if (loader) {
                    loader.style.opacity = "0";
                    loader.style.transition = "opacity 0.4s ease";
                    loader.style.display = "none";
                }
            });

            // Show loader on page navigation
            window.addEventListener("beforeunload", function() {

                if (loader) {
                    loader.style.display = "flex";
                    loader.style.opacity = "1";
                }
            });

            // Show loader on form submit
            document.querySelectorAll("form").forEach(function(form) {

                form.addEventListener("submit", function() {

                    if (loader && !form.classList.contains('no-loader')) {
                        loader.style.display = "flex";
                        loader.style.opacity = "1";
                    }
                });

            });

        });
        // Delete Button Confirmation Section
        $(document).on('click', '.deleteBtn', function(e) {

            e.preventDefault();

            const url = $(this).data('url');
            const title = $(this).data('title') || 'Record';

            Swal.fire({
                title: `Delete ${title}?`,
                html: `
            <div class="delete-modal-content">
                <div class="delete-icon-wrapper">
                    <i class="ti ti-trash"></i>
                </div>

                <p class="delete-description">
                    This action is permanent and cannot be undone.
                    Once deleted, the selected ${title.toLowerCase()} will be removed forever.
                </p>
            </div>
        `,
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                focusCancel: true,
                confirmButtonText: `
            <i class="ti ti-trash me-1"></i>
            Delete
        `,
                cancelButtonText: `
            <i class="ti ti-x me-1"></i>
            Cancel
        `,
                customClass: {
                    popup: 'custom-delete-popup',
                    confirmButton: 'btn btn-danger delete-confirm-btn',
                    cancelButton: 'btn btn-light delete-cancel-btn'
                },
                buttonsStyling: false

            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({

                    url: url,

                    type: 'DELETE',

                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    beforeSend: function() {

                        Swal.fire({
                            title: 'Deleting...',
                            text: `Please wait while we delete the ${title.toLowerCase()}.`,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                    },

                    success: function(response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted Successfully',
                            text: response.message || `${title} deleted successfully.`,
                            confirmButtonText: 'Continue',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false

                        }).then(() => {

                            if ($.fn.DataTable.isDataTable('#datatable')) {

                                $('#datatable').DataTable().ajax.reload(null, false);

                            } else {

                                location.reload();

                            }

                        });

                    },

                    error: function(xhr) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Deletion Failed',
                            text: xhr.responseJSON?.message || 'Something went wrong.',
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });

                    }

                });

            });

        });
        $(document).ready(function() {

            $('.select2').select2();
        });
        document.querySelectorAll('.dropdown-toggle').forEach(el => {
            new bootstrap.Dropdown(el, {
                popperConfig(defaults) {
                    return {
                        ...defaults,
                        strategy: 'fixed'
                    };
                }
            });
        });
    </script>

    @stack('scripts')
    @notifyJs
    <x-notify::notify />
    @vite(['resources/js/app.js'])
</body>

</html>
