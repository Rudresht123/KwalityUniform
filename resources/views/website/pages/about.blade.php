
@extends("website.components.common")

@section('content')

<!-- ================= Hero Banner ================= -->
<div class="geo-page-header">
    <div class="geo-page-header-overlay"></div>

    <div class="container">
        <span class="badge-geo mb-3">eSchoolKart</span>

        <h1 class="display-4 fw-bold text-white mb-3">
            About eSchoolKart
        </h1>

        <p class="text-white-50 fs-5 col-lg-7">
            Your trusted destination for premium school uniforms, bringing
            schools, vendors and parents together on one reliable platform.
        </p>

        <ul class="geo-breadcrumb mt-4">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>&bull;</li>
            <li class="active-item">About Us</li>
        </ul>
    </div>
</div>

<!-- ================= About ================= -->

<section class="py-5">
    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <span class="badge-geo mb-3">
                    Who We Are
                </span>

                <h2 class="fw-bold mb-4" style="color:var(--qu-primary)">
                    Simplifying School Uniform Shopping Across India
                </h2>

                <p class="text-muted mb-4 fs-5">
                    eSchoolKart is a dedicated marketplace created to make
                    school uniform shopping easier, faster and more reliable.
                    We connect schools, trusted vendors and parents through
                    one seamless platform.
                </p>

                <p class="text-muted mb-4">
                    Every product listed on our marketplace is carefully
                    reviewed to ensure it matches official school
                    specifications while maintaining premium quality,
                    durability and student comfort.
                </p>

                <p class="text-muted mb-5">
                    From everyday uniforms and winter wear to accessories,
                    we make purchasing simple with secure payments,
                    fast delivery and complete order tracking.
                </p>

                <div class="row g-3">

                    <div class="col-6">

                        <div class="card-geo p-4 text-center h-100">

                            <i class="fa-solid fa-school fs-1 mb-3 text-primary"></i>

                            <h4 class="fw-bold">100+</h4>

                            <small class="text-muted">
                                Partner Schools
                            </small>

                        </div>

                    </div>

                    <div class="col-6">

                        <div class="card-geo p-4 text-center h-100">

                            <i class="fa-solid fa-store fs-1 mb-3 text-success"></i>

                            <h4 class="fw-bold">50+</h4>

                            <small class="text-muted">
                                Verified Vendors
                            </small>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="card-geo overflow-hidden border-0 shadow-md">

                    <img src="{{ asset('assets/images/slide3.png') }}"
                         class="img-fluid"
                         alt="Students">

                </div>

            </div>

        </div>

    </div>
</section>

<!-- ================= Why Choose Us ================= -->

<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <span class="badge-geo mb-3">
                Why Choose Us
            </span>

            <h2 class="fw-bold">
                Why Thousands Trust eSchoolKart
            </h2>

            <p class="text-muted col-lg-7 mx-auto">
                We focus on quality, authenticity and convenience so parents
                can confidently purchase school uniforms online.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">

                <div class="card-geo p-4 text-center h-100">

                    <i class="fa-solid fa-certificate text-primary fs-1 mb-4"></i>

                    <h5 class="fw-bold">
                        Authentic Uniforms
                    </h5>

                    <p class="text-muted small mb-0">
                        Every product follows approved school standards
                        and specifications.
                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="card-geo p-4 text-center h-100">

                    <i class="fa-solid fa-shirt text-danger fs-1 mb-4"></i>

                    <h5 class="fw-bold">
                        Premium Quality
                    </h5>

                    <p class="text-muted small mb-0">
                        Comfortable fabrics designed for everyday
                        school life.
                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="card-geo p-4 text-center h-100">

                    <i class="fa-solid fa-truck-fast text-success fs-1 mb-4"></i>

                    <h5 class="fw-bold">
                        Fast Delivery
                    </h5>

                    <p class="text-muted small mb-0">
                        Reliable shipping with real-time
                        order tracking.
                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="card-geo p-4 text-center h-100">

                    <i class="fa-solid fa-headset text-warning fs-1 mb-4"></i>

                    <h5 class="fw-bold">
                        Customer Support
                    </h5>

                    <p class="text-muted small mb-0">
                        Friendly assistance whenever you
                        need help.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= Mission Vision ================= -->

<section class="py-5">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-6">

                <div class="card-geo p-5 h-100">

                    <div class="mb-4">

                        <i class="fa-solid fa-bullseye fs-1 text-primary"></i>

                    </div>

                    <h3 class="fw-bold mb-3">

                        Our Mission

                    </h3>

                    <p class="text-muted mb-0">

                        To simplify school uniform shopping by creating a
                        trusted marketplace where schools, vendors and
                        parents can connect effortlessly while ensuring
                        quality, affordability and convenience.

                    </p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="card-geo p-5 h-100">

                    <div class="mb-4">

                        <i class="fa-solid fa-eye fs-1 text-success"></i>

                    </div>

                    <h3 class="fw-bold mb-3">

                        Our Vision

                    </h3>

                    <p class="text-muted mb-0">

                        To become India's most trusted school uniform
                        marketplace by delivering exceptional products,
                        seamless shopping experiences and outstanding
                        customer satisfaction.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
@endsection
