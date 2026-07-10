<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>eSchool Cart | Premium School Uniform Marketplace</title>
    <link rel="icon" href="{{ asset('assets/icons/fav.png') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom Style Sheets -->
 <script src="{{ asset('assets/website/js/app.js') }}" defer></script> 
    <link href="{{ asset('assets/website/css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/website/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <link href="{{ asset('assets/modal.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/auth-modal.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


</head>

<body data-page="home">

    <!-- Premium Loader Wrapper -->
    <div id="premium-loader" class="premium-loader-wrap">
      <div class="loader-crest-container">
        <div class="loader-crest-ring"></div>
        <div class="loader-crest-ring-inner"></div>
        <svg class="loader-crest-svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          <path d="M12 8v8"/>
          <path d="M9 11h6"/>
        </svg>
      </div>
      <div class="loader-brand-title">eSchool<span>Cart</span></div>
      <div class="loader-sub-title">Premium Institutional Wear</div>
      <div class="loader-progress-container">
        <div class="loader-progress-bar"></div>
      </div>
    </div>

    <script>
      (function() {
        let loaderWrap = document.getElementById('premium-loader');
        
        const fadeOutLoader = () => {
          if (!loaderWrap || loaderWrap.classList.contains('loaded')) return;
          
          loaderWrap.classList.add('loaded');
          document.body.classList.remove('loader-active');
          document.body.classList.add('loader-transition-active');
          
          // Force hide and remove after animation
          setTimeout(() => {
            if (loaderWrap) {
              loaderWrap.style.display = 'none';
              loaderWrap.remove();
            }
            document.body.classList.remove('loader-transition-active');
          }, 1200);
        };

        try {
          if (loaderWrap) {
            document.body.classList.add('loader-active');
            // Trigger fade out after animation completes
            setTimeout(fadeOutLoader, 2000);
            // Hard fail-safe
            setTimeout(fadeOutLoader, 5000);
          }
        } catch (e) {
          console.error('Loader error:', e);
          if (loaderWrap) loaderWrap.remove();
          document.body.classList.remove('loader-active');
        }
      })();
    </script>


    <!-- 1. Announcement Bar -->
    <div class="qu-announcement">
        🎒 Back to School Sale: Save 15% on All Complete School Uniform Bundles!
    </div>

    @include('components.login-modal')
    @include('components.register-modal')
    @include('layouts.modals.editmodal', [
        'modalId' => 'cartModal',
        'title' => 'Your Shopping Basket',
        'modalClass' => 'qv-modal-premium',
        'subtitle' => 'Review your selected garments',
        'showFooter' => false,
    ])
    @include('components.user-account-modal')
    {{-- header section --}}
    @include('website.components.header')
    {{-- yeld section for mid content --}}
    @yield('content')
    {{-- yeld section for mid content --}}
    {{-- footer section --}}
    @include('website.components.footer')



    <!-- Tab Switcher Script -->
    <script>
        function switchOnboardingTab(tabType) {
            const schoolBtn = document.getElementById('tab-school-btn');
            const vendorBtn = document.getElementById('tab-vendor-btn');
            const schoolContent = document.getElementById('tab-content-school');
            const vendorContent = document.getElementById('tab-content-vendor');

            if (tabType === 'school') {
                schoolBtn.style.backgroundColor = 'var(--qu-primary)';
                schoolBtn.style.color = 'var(--qu-bg-white)';
                schoolBtn.classList.remove('text-secondary');

                vendorBtn.style.backgroundColor = 'transparent';
                vendorBtn.style.color = 'var(--qu-secondary)';
                vendorBtn.classList.add('text-secondary');

                schoolContent.classList.remove('d-none');
                vendorContent.classList.add('d-none');
            } else {
                vendorBtn.style.backgroundColor = 'var(--qu-primary)';
                vendorBtn.style.color = 'var(--qu-bg-white)';
                vendorBtn.classList.remove('text-secondary');

                schoolBtn.style.backgroundColor = 'transparent';
                schoolBtn.style.color = 'var(--qu-secondary)';
                schoolBtn.classList.add('text-secondary');

                vendorContent.classList.remove('d-none');
                schoolContent.classList.add('d-none');
            }
        }
        $(document).ready(function() {

            $('.select2').select2({

                width: '100%',

                dropdownAutoWidth: true,

                dropdownCssClass: 'premium-dropdown',

                minimumResultsForSearch: 5

            });
        });
    </script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Application Logic -->
   
    <script src="{{ asset('assets/modal.js') }}"></script>
    <script src="{{ asset('assets/js/cart.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/cart-gate.js') }}"></script>

</body>

</html>
