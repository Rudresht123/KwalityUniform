<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>eSchool Cart | Premium School Uniform Marketplace</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom Style Sheets -->
    <link href="{{ asset('assets/website/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/website/css/responsive.css') }}" rel="stylesheet" />
</head>

<body data-page="home">

    <!-- 1. Announcement Bar -->
    <div class="qu-announcement">
      🎒 Back to School Sale: Save 15% on All Complete School Uniform Bundles!
    </div>

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
    </script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Application Logic -->
    <script src="{{ asset('assets/website/js/app.js') }}"></script>
</body>

</html>
