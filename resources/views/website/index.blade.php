@extends('website.components.common')

@section('content')
    <!-- 3. Premium Hero Banner Carousel -->
    <section class="home-hero-carousel">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <!-- Indicators -->
            <div class="carousel-indicators-custom">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>

            <div class="carousel-inner">
                <!-- Slide 1: Official School Uniforms -->
                <div class="carousel-item active">
                    <div class="carousel-bg-wrap">
                        <img src="{{ asset('assets/images/slide1.png') }}" class="carousel-bg-img"
                            alt="Official School Uniforms" referrerPolicy="no-referrer" />
                    </div>
                    <div class="carousel-overlay"></div>
                    <div class="container carousel-container">
                        <div class="carousel-content-block text-white">
                            <span class="badge-geo mb-3"
                                style="background-color: var(--qu-accent); border-color: var(--qu-accent); color: #FFF;">Approved
                                School Uniform Marketplace</span>
                            <h1 class="display-3 fw-extrabold mb-3"
                                style="font-family: var(--font-display); line-height: 1.15; color: #FFFFFF !important;">
                                Official School Uniforms For Premier Institutions
                            </h1>
                            <p class="fs-5 text-light mb-4" style="font-weight: 300; line-height: 1.6;">
                                Premium, board-approved uniforms crafted with double-reinforced stitching and colorfast
                                weave structure. Ensuring happy, confident, and natural comfort for students of all age
                                groups.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <button type="button" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);"
                                    data-bs-toggle="modal" data-bs-target="#schoolSearchModal">Find Your School</button>
                                <a href="{{ route('website.shop') }}" class="btn btn-outline-light btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Shop Uniforms</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Find Your School -->
                <div class="carousel-item">
                    <div class="carousel-bg-wrap">
                        <img src="{{ asset('assets/images/slide2.png') }}" class="carousel-bg-img" alt="Find Your School"
                            referrerPolicy="no-referrer" />
                    </div>
                    <div class="carousel-overlay"></div>
                    <div class="container carousel-container">
                        <div class="carousel-content-block text-white">
                            <span class="badge-geo mb-3"
                                style="background-color: var(--qu-accent); border-color: var(--qu-accent); color: #FFF;">Direct
                                Parent Portal</span>
                            <h1 class="display-3 fw-extrabold mb-3"
                                style="font-family: var(--font-display); line-height: 1.15; color: #FFFFFF !important;">
                                Find Your Approved School Portal Instantly
                            </h1>
                            <p class="fs-5 text-light mb-4" style="font-weight: 300; line-height: 1.6;">
                                No more queues. Simply search for your educational district or school code to access
                                customized sizing packages pre-approved by your school board.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <button type="button" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);"
                                    data-bs-toggle="modal" data-bs-target="#schoolSearchModal">Find Your School</button>
                                <a href="{{ route('website.shop') }}" class="btn btn-outline-light btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Shop Uniforms</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Complete Uniform Kits -->
                <div class="carousel-item">
                    <div class="carousel-bg-wrap">
                        <img src="{{ asset('assets/images/slide3.png') }}" class="carousel-bg-img"
                            alt="Complete Uniform Kits" referrerPolicy="no-referrer" />
                    </div>
                    <div class="carousel-overlay"></div>
                    <div class="container carousel-container">
                        <div class="carousel-content-block text-white">
                            <span class="badge-geo mb-3"
                                style="background-color: var(--qu-accent); border-color: var(--qu-accent); color: #FFF;">Pre-Packaged
                                Sizing Boxes</span>
                            <h1 class="display-3 fw-extrabold mb-3"
                                style="font-family: var(--font-display); line-height: 1.15; color: #FFFFFF !important;">
                                All-In-One Complete School Uniform Kits
                            </h1>
                            <p class="fs-5 text-light mb-4" style="font-weight: 300; line-height: 1.6;">
                                Equip your child for assembly in three minutes. Our all-inclusive bundles package shirts,
                                trousers, skirts, blazers, belts, ties, and socks under a single discounted rate.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <button type="button" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);"
                                    data-bs-toggle="modal" data-bs-target="#schoolSearchModal">Find Your School</button>
                                <a href="{{ route('website.shop') }}" class="btn btn-outline-light btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Shop Uniforms</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4: Sports & House Uniforms -->
                <div class="carousel-item">
                    <div class="carousel-bg-wrap">
                        <img src="{{ asset('assets/images/slide4.png') }}" class="carousel-bg-img"
                            alt="Sports & House Uniforms" referrerPolicy="no-referrer" />
                    </div>
                    <div class="carousel-overlay"></div>
                    <div class="container carousel-container">
                        <div class="carousel-content-block text-white">
                            <span class="badge-geo mb-3"
                                style="background-color: var(--qu-accent); border-color: var(--qu-accent); color: #FFF;">High-Performance
                                Activewear</span>
                            <h1 class="display-3 fw-extrabold mb-3"
                                style="font-family: var(--font-display); line-height: 1.15; color: #FFFFFF !important;">
                                Durable Sports & House Activity Uniforms
                            </h1>
                            <p class="fs-5 text-light mb-4" style="font-weight: 300; line-height: 1.6;">
                                Woven from lightweight, moisture-wicking synthetic mesh and treated with active soil-guards.
                                Optimized to withstand high-tensile playground play and inter-school games.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <button type="button" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);"
                                    data-bs-toggle="modal" data-bs-target="#schoolSearchModal">Find Your School</button>
                                <a href="{{ route('website.shop') }}" class="btn btn-outline-light btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Shop Uniforms</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 5: Back to School Collection -->
                <div class="carousel-item">
                    <div class="carousel-bg-wrap">
                        <img src="https://images.unsplash.com/photo-1596495578065-6e0763fa1141?auto=format&fit=crop&q=80&w=1600"
                            class="carousel-bg-img" alt="Back to School Collection" referrerPolicy="no-referrer" />
                    </div>
                    <div class="carousel-overlay"></div>
                    <div class="container carousel-container">
                        <div class="carousel-content-block text-white">
                            <span class="badge-geo mb-3"
                                style="background-color: var(--qu-accent); border-color: var(--qu-accent); color: #FFF;">Fresh
                                Term Premium Collection</span>
                            <h1 class="display-3 fw-extrabold mb-3"
                                style="font-family: var(--font-display); line-height: 1.15; color: #FFFFFF !important;">
                                Fresh Back To School Wardrobe Curations
                            </h1>
                            <p class="fs-5 text-light mb-4" style="font-weight: 300; line-height: 1.6;">
                                Start the semester with comfortable, breathable, and stretch-infused everyday designs.
                                Beautifully styled to meet the strict guidelines of leading Indian scholastic boards.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <button type="button" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);"
                                    data-bs-toggle="modal" data-bs-target="#schoolSearchModal">Find Your School</button>
                                <a href="{{ route('website.shop') }}" class="btn btn-outline-light btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Shop Uniforms</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-custom carousel-control-prev-custom" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="prev">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-custom carousel-control-next-custom" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="next">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>


    {{-- Info section --}}
    <div class="container-fluid min-vh-100 p-0 d-flex flex-column justify-content-between position-relative">

        <div class="row g-0 flex-grow-1 align-items-stretch">

            <!-- Left Section: Details & Features -->
            <div
                class="col-12 col-lg-7 d-flex flex-column justify-content-center py-5 px-4 px-md-5 bg-white hero-left-col position-relative z-3">
                <div class="mx-auto w-100" style="max-width: 680px;">

                    <!-- Badge -->
                    <div class="mb-4">
                        <span class="badge-school-partner font-display">
                            <!-- Shield icon SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M20 13c0 5-3.5 7.5-7.66 9.7a1 1 0 0 1-.68 0C7.5 20.5 4 18 4 13V6a1 1 0 0 1 .76-.97l8-2a1 1 0 0 1 .48 0l8 2A1 1 0 0 1 20 6z" />
                                <path d="m9 12 2 2 4-4" />
                            </svg>
                            OFFICIAL SCHOOL UNIFORM PARTNER
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="display-4 fw-extrabold text-navy-deep font-display tracking-tight mb-4 lh-sm"
                        style="font-weight: 800; letter-spacing: -0.02em;">
                        Everything Your <br class="d-none d-md-inline">
                        Child Needs, <br>
                        <span class="text-royal-blue font-display d-inline-block mt-2">
                            All in One Place
                        </span>
                    </h1>

                    <!-- Paragraph Description -->
                    <p class="lead text-secondary mb-5 fs-5 fw-normal lh-base"
                        style="max-width: 600px; color: var(--color-slate-600);">
                        We make school uniform shopping simple, reliable and stress-free. Every product is carefully
                        selected to match your school's approved dress code with premium quality and perfect fit.
                    </p>

                    <!-- Core Feature Grid (4 Features) -->
                    <div class="row g-4 mb-5">

                        <!-- Feature 1: Official Uniforms -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="d-flex flex-column align-items-start">
                                <div class="icon-circle icon-circle-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M20 13c0 5-3.5 7.5-7.66 9.7a1 1 0 0 1-.68 0C7.5 20.5 4 18 4 13V6a1 1 0 0 1 .76-.97l8-2a1 1 0 0 1 .48 0l8 2A1 1 0 0 1 20 6z" />
                                        <path d="m9 12 2 2 4-4" />
                                    </svg>
                                </div>
                                <h3 class="fs-6 fw-bold text-navy-deep mb-2">Official Uniforms</h3>
                                <p class="text-muted small mb-0" style="font-size: 0.82rem; lineHeight: 1.4;">
                                    School-approved designs & colors
                                </p>
                            </div>
                        </div>

                        <!-- Feature 2: Fast Delivery -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="d-flex flex-column align-items-start">
                                <div class="icon-circle icon-circle-green">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 18H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v10" />
                                        <polygon points="12 2 12 10 17 6" />
                                        <line x1="2" y1="10" x2="22" y2="10" />
                                        <line x1="17" y1="14" x2="22" y2="14" />
                                        <rect x="14" y1="14" width="8" height="6" rx="1" />
                                    </svg>
                                </div>
                                <h3 class="fs-6 fw-bold text-navy-deep mb-2">Fast Delivery</h3>
                                <p class="text-muted small mb-0" style="font-size: 0.82rem; lineHeight: 1.4;">
                                    Quick doorstep delivery across India
                                </p>
                            </div>
                        </div>

                        <!-- Feature 3: Premium Quality -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="d-flex flex-column align-items-start">
                                <div class="icon-circle icon-circle-purple">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="8" r="6" />
                                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11" />
                                    </svg>
                                </div>
                                <h3 class="fs-6 fw-bold text-navy-deep mb-2">Premium Quality</h3>
                                <p class="text-muted small mb-0" style="font-size: 0.82rem; lineHeight: 1.4;">
                                    Durable fabrics for everyday comfort
                                </p>
                            </div>
                        </div>

                        <!-- Feature 4: Trusted Support -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="d-flex flex-column align-items-start">
                                <div class="icon-circle icon-circle-orange">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 18v-6a9 9 0 0 1 18 0v6" />
                                        <path
                                            d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z" />
                                    </svg>
                                </div>
                                <h3 class="fs-6 fw-bold text-navy-deep mb-2">Trusted Support</h3>
                                <p class="text-muted small mb-0" style="font-size: 0.82rem; lineHeight: 1.4;">
                                    Easy returns & friendly support
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- Trusted Schools Card -->
                    <div class="d-inline-block">
                        <div class="card-trusted-schools">
                            <div class="card-trusted-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m12 3-10 9h3v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8h3L12 3z" />
                                    <path d="M9 21V11h6v10" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-muted small mb-0" style="font-size: 0.78rem; font-weight: 500;">Trusted
                                    by</div>
                                <div class="text-royal-blue fw-extrabold font-display"
                                    style="font-size: 1.15rem; line-height: 1.2;">250+ Schools</div>
                                <div class="text-muted small" style="font-size: 0.78rem;">Across India</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Section: Ambient image with smooth fading mask -->
            <div class="col-12 col-lg-5 position-relative bg-light d-flex align-items-stretch">
                <div class="hero-gradient-overlay"></div>
                <div class="w-100 h-100 position-relative overflow-hidden">
                    <img src="{{ asset('assets/images/image1.png') }}"
                        alt="Happy school children running and smiling in their school uniforms"
                        class="w-100 h-100 object-fit-cover position-absolute" style="object-position: center 20%;">
                    <!-- Soft mobile gradient cover so text stacks legibly on smaller screens -->
                    <div class="d-lg-none position-absolute top-0 start-0 end-0 bottom-0"
                        style="background: linear-gradient(to top, rgba(255,255,255,1) 8%, rgba(255,255,255,0.4) 50%, rgba(0,0,0,0.1) 100%);">
                    </div>
                </div>
            </div>

        </div>



    </div>



    <!-- =========================
                         Featured Partner Schools
                    ========================== -->
    <section class="schools-section py-5">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-lg-8">
                    <span class="school-badge">
                        <i class="bi bi-patch-check-fill"></i>
                        Trusted School Network
                    </span>
                    <h2 class="school-title mt-3">
                        Official Partner Schools
                    </h2>
                    <p class="school-description">
                        Explore our growing network of partner schools across India.
                        Every school has its own dedicated catalogue with officially
                        approved uniforms, accessories and a seamless shopping experience.
                    </p>
                </div>
                <div class="col-lg-4 text-end">
                    <div class="slider-nav">
                        <div class="swiper-prev"><i class="bi bi-chevron-left"></i></div>
                        <div class="swiper-next"><i class="bi bi-chevron-right"></i></div>
                    </div>
                </div>
            </div>

            <!-- Swiper Slider -->
            <div class="swiper schoolSwiper">
                <div class="swiper-wrapper">
                    @foreach ($featuredSchools as $school)
                        <div class="swiper-slide">
                            <div class="partner-school-card" onclick="openSchoolDetails(event, '{{ $school->school_id }}', '{{ addslashes($school->school_name) }}', '{{ addslashes($school->city) }}', '{{ addslashes($school->state) }}', '{{ $school->products_count ?? '50+' }}')">
                                <div class="card-strip"></div>
                                <div class="school-logo-wrapper">
                                    <img src="{{ $school->logo_url ? asset($school->logo_url) : asset('assets/images/no_image.jpg') }}"
                                        class="school-logo" alt="{{ $school->school_name }}">
                                </div>
                                <div class="partner-school-body">
                                    <span class="partner-status">
                                        <i class="bi bi-patch-check-fill"></i>
                                        Official Partner
                                    </span>
                                    <h4>{{ $school->school_name }}</h4>
                                    <p class="location">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        {{ $school->city }}, {{ $school->state }}
                                    </p>
                                    <div class="school-divider"></div>
                                    <div class="school-footer">
                                        <span class="explore-btn">
                                            Explore <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- School Details Modal -->
    <div class="modal fade" id="schoolDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 bg-primary text-white p-4">
                    <h5 class="modal-title fw-bold" id="modalSchoolName">School Name</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="school-logo-wrapper mb-4" style="margin-top: -60px; position: relative; z-index: 2;">
                        <img id="modalSchoolLogo" src="" class="school-logo" style="width: 80px; height: 80px;" alt="School Logo">
                    </div>
                    <p class="location fs-5 mb-3">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span id="modalSchoolLocation">Location</span>
                    </p>
                    <p class="text-secondary mb-4">
                        This official partner school provides premium uniforms with strictly approved designs and high-quality fabrics.
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a id="modalExploreLink" href="#" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">
                            Browse Catalogue <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.schoolSwiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-next',
                    prevEl: '.swiper-prev',
                },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 4 },
                },
            });
        });

        function openSchoolDetails(event, id, name, city, state, count) {
            document.getElementById('modalSchoolName').innerText = name;
            document.getElementById('modalSchoolLocation').innerText = city + ', ' + state;
            document.getElementById('modalExploreLink').href = "{{ route('website.shop') }}?school=" + id;

            const card = event.currentTarget;
            const logoSrc = card.querySelector('.school-logo').src;
            document.getElementById('modalSchoolLogo').src = logoSrc;

            const modal = new bootstrap.Modal(document.getElementById('schoolDetailsModal'));
            modal.show();
        }
    </script>

<section class="how-section py-5">

    <div class="container">

        <div class="text-center mb-5">

            <span class="how-badge">
                How It Works
            </span>

            <h2 class="how-title">
                Order Your Uniform
                <span>In 5 Easy Steps</span>
            </h2>

            <p class="how-desc">
                A simple and seamless ordering experience designed for
                parents, students and schools.
            </p>

        </div>

        <div class="row g-4 steps-row">

            <!-- STEP 1 -->
            <div class="col-lg col-md-6">
                <div class="step-card">
                    <div class="step-connector"></div>
                    <div class="step-icon-wrap">
                        <div class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21a8 8 0 0 0-16 0"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <span class="step-number">01</span>
                    </div>
                    <h4>Create Profile</h4>
                    <p>Register your account and link your profile with your school to access approved products.</p>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="col-lg col-md-6">
                <div class="step-card">
                    <div class="step-connector"></div>
                    <div class="step-icon-wrap">
                        <div class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 4l4 3 4-3 3 4-3 2v10H8V10L5 8l3-4z"/>
                            </svg>
                        </div>
                        <span class="step-number">02</span>
                    </div>
                    <h4>Try Your Size</h4>
                    <p>Visit your school's wardrobe to try uniforms and find your perfect size before ordering.</p>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="col-lg col-md-6">
                <div class="step-card">
                    <div class="step-connector"></div>
                    <div class="step-icon-wrap">
                        <div class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m21 21-4.3-4.3"/>
                            </svg>
                        </div>
                        <span class="step-number">03</span>
                    </div>
                    <h4>Browse Products</h4>
                    <p>Explore your school's official uniforms, books, shoes, bags, and accessories.</p>
                </div>
            </div>

            <!-- STEP 4 -->
            <div class="col-lg col-md-6">
                <div class="step-card">
                    <div class="step-connector"></div>
                    <div class="step-icon-wrap">
                        <div class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="20" r="1"/>
                                <circle cx="18" cy="20" r="1"/>
                                <path d="M5 5h2l2.5 10h8.5l2-7H8"/>
                            </svg>
                        </div>
                        <span class="step-number">04</span>
                    </div>
                    <h4>Place Your Order</h4>
                    <p>Select your required products, review your cart, and securely place your order online.</p>
                </div>
            </div>

            <!-- STEP 5 -->
            <div class="col-lg col-md-6">
                <div class="step-card step-card-last">
                    <div class="step-icon-wrap">
                        <div class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 21h18"/>
                                <path d="M5 21V7a2 2 0 0 1 2-2h4v16"/>
                                <path d="M11 21V3h6a2 2 0 0 1 2 2v16"/>
                                <path d="M7 9h2"/>
                                <path d="M15 7h2"/>
                            </svg>
                        </div>
                        <span class="step-number">05</span>
                    </div>
                    <h4>Collect from School</h4>
                    <p>Your order is delivered to your school for convenient collection at the designated distribution point.</p>
                </div>
            </div>

        </div>

    </div>

</section>

<style>
.how-section {
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    background: #fafbfc;
}

.how-badge {
    display: inline-block;
    background: rgba(59,130,246,0.1);
    color: #3b82f6;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 0.4rem 1rem;
    border-radius: 999px;
    margin-bottom: 1rem;
}

.how-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #1a1d29;
    margin-bottom: 0.75rem;
    line-height: 1.3;
}

.how-title span {
    display: block;
    color: #3b82f6;
    font-size: 1.9rem;
}

.how-desc {
    max-width: 520px;
    margin: 0 auto;
    color: #7c8291;
    font-size: 1rem;
    line-height: 1.6;
}

.steps-row {
    position: relative;
}

.step-card {
    background: #fff;
    border: 1px solid #eef0f3;
    border-radius: 16px;
    padding: 2rem 1.5rem 1.75rem;
    height: 100%;
    text-align: center;
    position: relative;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
}

.step-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(59,130,246,0.1);
    border-color: rgba(59,130,246,0.25);
}

.step-icon-wrap {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.25rem;
}

.step-icon {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 18px rgba(59,130,246,0.28);
    position: relative;
    z-index: 2;
}

.step-number {
    position: absolute;
    top: -8px;
    right: calc(50% - 44px);
    background: #1a1d29;
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    border: 2px solid #fafbfc;
}

.step-connector {
    display: none;
}

@media (min-width: 992px) {
    .step-connector {
        display: block;
        position: absolute;
        top: 2.75rem;
        left: 50%;
        width: 100%;
        height: 2px;
        background: repeating-linear-gradient(
            to right,
            #d7dce4 0,
            #d7dce4 6px,
            transparent 6px,
            transparent 12px
        );
        z-index: 1;
    }
}

.step-card h4 {
    font-size: 1.05rem;
    font-weight: 600;
    color: #1a1d29;
    margin-bottom: 0.6rem;
}

.step-card p {
    font-size: 0.88rem;
    color: #8b93a1;
    line-height: 1.6;
    margin-bottom: 0;
}
</style>
<!-- 11. Why Choose eSchool Cart -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge-geo mb-2">Unparalleled Standards</span>
                <h2 class="display-6 fw-bold text-dark">Why eSchool Cart Stands Out</h2>
                <p class="text-muted max-w-2xl mx-auto">We construct garments that withstand active playground sessions
                    while honoring school board identity guidelines.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card-geo p-4 h-100">
                        <div
                            style="background: var(--qu-badge-bg); width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="var(--qu-primary)" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                        </div>
                        <h4 class="fw-bold h5">100% Institution Compliant</h4>
                        <p class="text-secondary small mb-0">Every thread, fabric shade, and crest placement is validated
                            with partner leadership boards for assembly guidelines eligibility.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-geo p-4 h-100">
                        <div
                            style="background: var(--qu-badge-bg); width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="var(--qu-primary)" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                        <h4 class="fw-bold h5">Double Reinforced Sewing</h4>
                        <p class="text-secondary small mb-0">High-tension stress joints, double-layered knee fabric, and
                            colorfast weave structure prevent fraying and tear cycles on active kids.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-geo p-4 h-100">
                        <div
                            style="background: var(--qu-badge-bg); width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="var(--qu-primary)" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h4 class="fw-bold h5">Easy Multi-Pack Bundles</h4>
                        <p class="text-secondary small mb-0">Save time and financial budget. Purchase unified sizing boxes
                            customized for your child's schedule and keep spares ready.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- 14. Parent Testimonials -->
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge-geo mb-2">Verified Parent Feedback</span>
                <h2 class="display-6 fw-bold text-dark">What Our Community Says</h2>
                <p class="text-muted max-w-2xl mx-auto">Read authentic reviews from families who trust eSchool Cart with
                    their children's clothing standards term after term.</p>
            </div>

            <div class="row g-4">
                <!-- Review 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="rating-stars-container mb-3">
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                            </div>
                            <p class="testimonial-quote">"The Delhi Public School (DPS) girls salwar kameez suit fits
                                absolutely perfectly! The cotton fabric is extremely breathable and comfortable during hot
                                Delhi summer afternoons, yet remains formal and elegant. Truly premium."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">HA</div>
                            <div>
                                <h5 class="h6 fw-bold mb-0 text-dark">Helen Andrews</h5>
                                <span class="text-muted small">Parent of DPS Student</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Review 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="rating-stars-container mb-3">
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                            </div>
                            <p class="testimonial-quote">"Finding official school dress-code compliant wear was always a
                                chore. This direct authorized directory let me order my son's St. Xavier's High set in under
                                three minutes. Absolutely brilliant system."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">MR</div>
                            <div>
                                <h5 class="h6 fw-bold mb-0 text-dark">Marcus Ramirez</h5>
                                <span class="text-muted small">Parent of St. Xavier's Student</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Review 3 -->
                <div class="col-lg-4 d-md-none d-lg-block">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="rating-stars-container mb-3">
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 24 24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                            </div>
                            <p class="testimonial-quote">"The orthopedic spinal-support backpack lives up to the billing.
                                Highly functional compartments and very supportive during my daughter's daily transit. High
                                recommend to all families."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">SC</div>
                            <div>
                                <h5 class="h6 fw-bold mb-0 text-dark">Sarah Cooper</h5>
                                <span class="text-muted small">Parent of Army Public School Student</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <!-- 17. FAQ -->
    <section class="py-5" style="background-color: #F8FAFC; border-bottom: 1px solid var(--qu-border-color);">
        <div class="container" style="max-width: 800px;">
            <div class="text-center mb-5">
                <span class="badge-geo mb-2">Help Center</span>
                <h2 class="display-6 fw-bold text-dark">Frequently Asked Questions</h2>
                <p class="text-muted small">Find immediate answers regarding school codes, sizing adjustments, and return
                    procedures.</p>
            </div>

            <details class="faq-accordion-geo" open>
                <summary class="faq-summary">
                    <span>How do I find the correct uniform matching my child's campus?</span>
                    <svg class="faq-icon text-muted" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24" width="20" height="20">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </summary>
                <div class="faq-content">
                    Simply input your school's name in the "Search Your School" locator bar at the top, or select your
                    campus from the Partner Directory. The portal automatically locks into authorized crest embroideries,
                    approved pant colors, and correct tartan plaid weaves required by leadership.
                </div>
            </details>

            <details class="faq-accordion-geo">
                <summary class="faq-summary">
                    <span>What is your return and sizing exchange policy?</span>
                    <svg class="faq-icon text-muted" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24" width="20" height="20">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </summary>
                <div class="faq-content">
                    We understand children grow quickly. We offer a hassle-free 14-day exchange and return cycle on all
                    garments. Items must be unworn and contain their original manufacturing tags. Replacement garments are
                    shipped back to you at no extra delivery fee.
                </div>
            </details>

            <details class="faq-accordion-geo">
                <summary class="faq-summary">
                    <span>Can I save budget with complete multi-pack uniform bundles?</span>
                    <svg class="faq-icon text-muted" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24" width="20" height="20">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </summary>
                <div class="faq-content">
                    Absolutely. Purchasing a Complete Uniform Set automatically applies a 15% promotional discount. Complete
                    bundles include the official crested blazer, standard button-down shirts, matching trousers/skirts, and
                    neckwear coordinates.
                </div>
            </details>

            <details class="faq-accordion-geo">
                <summary class="faq-summary">
                    <span>How durable is the active physical education (PE) clothing?</span>
                    <svg class="faq-icon text-muted" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24" width="20" height="20">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </summary>
                <div class="faq-content">
                    Our PE training kit is woven from high-tensile, moisture-wicking dry-fit synthetics. Features double
                    safety seams at high-stress joints to withstand intense playground sports, frequent machine washings,
                    and continuous wear.
                </div>
            </details>
        </div>
    </section>


    <section class="admin-portal-section py-5">

    <div class="container-fluid">

        <div class="admin-portal">

            <div class="row align-items-center g-5">

                <!-- LEFT CONTENT -->
                <div class="col-lg-6">

                    <span class="portal-badge">
                        <i class="ti ti-shield-lock"></i>
                        ADMIN PORTAL
                    </span>

                    <h2 class="portal-title">
                        Manage Your School Operations
                        <span>From One Powerful Dashboard</span>
                    </h2>

                    <p class="portal-desc">
                        Securely access your administration dashboard to manage
                        schools, vendors, products, orders, inventory, reports,
                        and day-to-day operations from one centralized platform.
                    </p>

                    <div class="portal-features">

                        <div class="portal-feature">
                            <i class="ti-package"></i>
                            <span>Product Management</span>
                        </div>

                        <div class="portal-feature">
                            <i class="ti-shopping-cart"></i>
                            <span>Order Tracking</span>
                        </div>

                      
                    

                        <div class="portal-feature">
                            <i class="ti ti-chart-bar"></i>
                            <span>Reports & Analytics</span>
                        </div>

                        <div class="portal-feature">
                            <i class="ti ti-shield-check"></i>
                            <span>Role Based Access</span>
                        </div>

                    </div>

                    <a href="{{ route('login') }}" class="portal-btn">
                        Access Admin Portal
                        <i class="ti ti-arrow-right"></i>
                    </a>

                    <div class="portal-note">
                        <i class="ti ti-info-circle"></i>
                        For School Administrators, Vendors and Authorized Staff only.
                    </div>

                </div>

                <!-- RIGHT IMAGE -->

                <div class="col-lg-6 text-center">

                    <img src="{{ asset('assets/website/images/login.png') }}"
                         class="img-fluid portal-image"
                         alt="Admin Dashboard">

                </div>

            </div>

        </div>

    </div>

</section>

    <!-- 18. Newsletter -->
    <section class="py-5" style="background: linear-gradient(135deg, #1E3A8A 0%, #0F172A 100%);">
        <div class="container text-center text-white" style="max-width: 600px;">
            <span class="badge-geo mb-3"
                style="background: rgba(255,255,255,0.15); color: #FFF; border-color: transparent;">Stay Informed</span>
            <h3 class="h2 fw-bold mb-2 text-white">Join the eSchoolKart Newsletter</h3>
            <p class="text-white-50 small mb-4">Subscribe to receive notifications about Back-To-School sizing days,
                partner school directory expansions, and seasonal uniform promotions.</p>

            <form class="d-flex gap-2"
                onsubmit="event.preventDefault(); alert('Thank you for subscribing to eSchool Cart notifications!'); this.reset();">
                <input type="email" required class="form-control" placeholder="Enter your email address..."
                    style="border-radius: 12px; border: none; font-size: 15px; padding: 12px 20px;">
                <button type="submit" class="btn btn-primary px-4"
                    style="border-radius: 12px; font-weight: 600;">Subscribe</button>
            </form>
        </div>
    </section>

    @include('website.components.school-search-modal')

    {{-- <!-- 19. Onboarding Hub (Become Partner / Become Vendor) --> --}}
   {{-- @include("website.partials.onboarding") --}}

@endsection

