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
                                <a href="#school-directory" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Find Your School</a>
                                <a href="shop.html" class="btn btn-outline-light btn-lg px-4"
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
                                <a href="#school-directory" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Find Your School</a>
                                <a href="shop.html" class="btn btn-outline-light btn-lg px-4"
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
                                <a href="#school-directory" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Find Your School</a>
                                <a href="shop.html" class="btn btn-outline-light btn-lg px-4"
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
                                <a href="#school-directory" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Find Your School</a>
                                <a href="shop.html" class="btn btn-outline-light btn-lg px-4"
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
                                <a href="#school-directory" class="btn btn-primary btn-lg px-4"
                                    style="font-weight: 600; border-radius: var(--qu-radius-sm);">Find Your School</a>
                                <a href="shop.html" class="btn btn-outline-light btn-lg px-4"
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
    <section class="schools-section  py-5">

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



            </div>


            <div class="row g-4">

                @foreach ($featuredSchools as $school)
                    <div class="col-md-6 col-xl-3">

                        <div class="partner-school-card">

                            <!-- Top Strip -->

                            <div class="card-strip"></div>

                            <!-- Logo -->

                            <div class="school-logo-wrapper">

                                <img src="{{ $school->logo_url ? asset($school->logo_url) : asset('assets/images/no_image.jpg') }}"
                                    class="school-logo" alt="{{ $school->school_name }}">

                            </div>

                            <!-- Body -->

                            <div class="partner-school-body">

                                <span class="partner-status">

                                    <i class="bi bi-patch-check-fill"></i>

                                    Official Partner

                                </span>

                                <h4>

                                    {{ $school->school_name }}

                                </h4>

                                <p class="location">

                                    <i class="bi bi-geo-alt-fill"></i>

                                    {{ $school->city }},
                                    {{ $school->state }}

                                </p>

                                <div class="school-divider"></div>

                                <div class="school-footer">

                                    <div>

                                        <small>Available</small>

                                        <strong>

                                            {{ $school->products_count ?? '50+' }}

                                            Products

                                        </strong>

                                    </div>

                                    <a href="{{ route('website.shop', ['school' => $school->school_id]) }}"
                                        class="explore-btn">

                                        Explore

                                        <i class="bi bi-arrow-right"></i>

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    <section class="category-section py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-8 text-center">

                    <span class="category-badge">
                        Complete Uniform Collection
                    </span>

                    <h2 class="category-heading mt-3">
                        Shop By <span>Category</span>
                    </h2>

                    <p class="category-description">
                        Browse our complete range of officially approved school
                        uniforms and accessories designed for comfort,
                        durability and everyday confidence.
                    </p>

                </div>

            </div>

            <div class="row mt-5 g-4 justify-content-center">

                @foreach ($featuredCategories as $category)
                    <div class="col-6 col-md-4 col-lg-2">

                        <a href="{{ route('website.shop', ['category' => Str::slug($category->name)]) }}"
                            class="category-card">

                            <div class="category-icon">

                                {{-- SVG HERE --}}

                            </div>

                            <h6>{{ $category->name }}</h6>

                            <span>

                                {{ $category->products_count ?? '0' }}

                                Products

                            </span>

                        </a>

                    </div>
                @endforeach

            </div>

            <div class="text-center mt-5">

                <a href="{{ route('website.shop') }}" class="btn btn-primary px-5 py-3 rounded-pill">

                    Explore Collection

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>

        </div>

    </section>



    <!-- 8. Featured Products -->
    <section class="py-5" style="background-color: #F8FAFC; border-bottom: 1px solid var(--qu-border-color);">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-5">
                <div>
                    <span class="badge-geo mb-2">Core Campus Styles</span>
                    <h2 class="display-6 fw-bold text-dark mb-1">Featured Campus Styles</h2>
                    <p class="text-muted mb-0">Discover our highest-rated everyday shirts, polos, and scholastic
                        accessories.</p>
                </div>
                <a href="shop.html" class="btn btn-outline-primary d-none d-md-block"
                    style="border-radius: 10px; font-weight: 600;">View All Catalogue &rarr;</a>
            </div>

            <div class="row g-4" id="featured-products-grid">
                @foreach ($featuredProducts as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card-geo">
                            <div class="product-thumb-geo" style="cursor: pointer;"
                                onclick="window.location.href='{{ route('website.shop') }}?id={{ $product->id }}">
                                <img src="{{ $product->image_url ? asset($product->image_url) : asset('assets/images/no_image.jpg') }}"
                                    alt="{{ $product->name }}">
                            </div>
                            <div class="product-school-geo">{{ $product->school?->school_name ?? 'General Wear' }}</div>
                            <h4 class="product-name-geo" style="cursor: pointer;"
                                onclick="window.location.href='{{ route('website.shop') }}?id={{ $product->id }}">
                                {{ $product->name }}</h4>
                            <div class="product-price-geo">${{ number_format($product->price, 2) }}</div>
                            <button class="btn btn-primary btn-sm mt-3 w-100"
                                onclick="State.addToCart({{ json_encode([
                                    'id' => $product->id,
                                    'name' => $product->name,
                                    'price' => $product->price,
                                    'image' => $product->image_url ? asset($product->image_url) : asset('assets/images/no_image.jpg'),
                                    'sizes' => $product->variants->pluck('size')->unique()->toArray(),
                                    'colors' => $product->variants->pluck('color')->unique()->map(fn($c) => ['name' => $c, 'value' => '#CCC'])->toArray(),
                                ]) }}, 1, 'M', 'Default Color')">Add
                                to Basket</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="how-section py-5">

        <div class="container">

            <div class="text-center mb-5">

                <span class="how-badge">

                    How It Works

                </span>

                <h2 class="how-title">

                    Order Your Uniform
                    <span>In 3 Easy Steps</span>

                </h2>

                <p class="how-desc">

                    A simple and seamless ordering experience designed for
                    parents, students and schools.

                </p>

            </div>

            <div class="timeline-line"></div>

            <div class="row g-4 position-relative">

                <!-- STEP 1 -->

                <div class="col-lg-4">

                    <div class="step-card">

                        <div class="step-number">

                            01

                        </div>

                        <div class="step-icon">

                            <i class="bi bi-buildings"></i>

                        </div>

                        <h4>

                            Choose School

                        </h4>

                        <p>

                            Select your school to access officially approved
                            uniforms and accessories.

                        </p>

                    </div>

                </div>

                <!-- STEP 2 -->

                <div class="col-lg-4">

                    <div class="step-card">

                        <div class="step-number">

                            02

                        </div>

                        <div class="step-icon">

                            <i class="bi bi-bag-check"></i>

                        </div>

                        <h4>

                            Pick Products

                        </h4>

                        <p>

                            Browse your school's catalogue and choose the
                            required size and quantity.

                        </p>

                    </div>

                </div>

                <!-- STEP 3 -->

                <div class="col-lg-4">

                    <div class="step-card">

                        <div class="step-number">

                            03

                        </div>

                        <div class="step-icon">

                            <i class="bi bi-truck"></i>

                        </div>

                        <h4>

                            Fast Delivery

                        </h4>

                        <p>

                            Sit back while we deliver your order safely
                            to your doorstep.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- 11. Why Choose eSchool Cart -->
    <section class="py-5 bg-white">
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

    <!-- 12. Trending Products -->
    <section class="py-5 bg-light border-top border-bottom">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-5">
                <div>
                    <span class="badge-geo mb-2">High Demand Uniforms</span>
                    <h2 class="display-6 fw-bold text-dark mb-1">Trending School Wear</h2>
                    <p class="text-muted mb-0">These active school products have high seasonal demand and custom reviews.
                    </p>
                </div>
                <a href="shop.html" class="btn btn-outline-primary" style="border-radius: 10px; font-weight: 600;">Shop
                    Full Selection</a>
            </div>

            <div class="row g-4">
                <!-- Item 1: Chinos -->
                <div class="col-lg-3 col-md-6">
                    <div class="product-card-geo">
                        <div class="product-thumb-geo" style="cursor: pointer;"
                            onclick="window.location.href='product-details.html?id=pants-chino'">
                            <img src="https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&q=80&w=600"
                                alt="Smart Regular-Fit School Pleated Shorts">
                        </div>
                        <div class="product-school-geo">Essential Wear</div>
                        <h4 class="product-name-geo" style="cursor: pointer;"
                            onclick="window.location.href='product-details.html?id=pants-chino'">Smart Regular-Fit School
                            Pleated Shorts</h4>
                        <div class="product-price-geo">$18.00</div>
                        <button class="btn btn-primary btn-sm mt-3 w-100"
                            onclick="State.addToCart({id: 'pants-chino', name: 'Smart Regular-Fit School Pleated Shorts', price: 18.00, image: 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&q=80&w=600', sizes: ['XS','S','M','L','XL'], colors: [{name: 'Charcoal Grey', value:'#374151'}]}, 1, 'M', 'Charcoal Grey')">Add
                            to Basket</button>
                    </div>
                </div>
                <!-- Item 2: Gym Set -->
                <div class="col-lg-3 col-md-6">
                    <div class="product-card-geo">
                        <div class="product-thumb-geo" style="cursor: pointer;"
                            onclick="window.location.href='product-details.html?id=sportswear-pe-set'">
                            <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&q=80&w=600"
                                alt="DryFit School House Gym Uniform Set">
                        </div>
                        <div class="product-school-geo">Official Gym Bundle</div>
                        <h4 class="product-name-geo" style="cursor: pointer;"
                            onclick="window.location.href='product-details.html?id=sportswear-pe-set'">DryFit School House
                            Gym Uniform Set</h4>
                        <div class="product-price-geo">$22.00 <span
                                class="text-muted small text-decoration-line-through fs-7">$30.00</span></div>
                        <button class="btn btn-primary btn-sm mt-3 w-100"
                            onclick="State.addToCart({id: 'sportswear-pe-set', name: 'DryFit School House Gym Uniform Set', price: 22.00, image: 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&q=80&w=600', sizes: ['S','M','L','XL'], colors: [{name: 'Navy Blue House', value:'#1E3A8A'}]}, 1, 'M', 'Navy Blue House')">Add
                            to Basket</button>
                    </div>
                </div>
                <!-- Item 3: Backpack -->
                <div class="col-lg-3 col-md-6">
                    <div class="product-card-geo">
                        <div class="product-thumb-geo" style="cursor: pointer;"
                            onclick="window.location.href='product-details.html?id=ergo-backpack'">
                            <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&q=80&w=600"
                                alt="Orthopedic Ergonomic School Backpack">
                        </div>
                        <div class="product-school-geo">Essential Gear</div>
                        <h4 class="product-name-geo" style="cursor: pointer;"
                            onclick="window.location.href='product-details.html?id=ergo-backpack'">Orthopedic Ergonomic
                            School Backpack</h4>
                        <div class="product-price-geo">$32.00</div>
                        <button class="btn btn-primary btn-sm mt-3 w-100"
                            onclick="State.addToCart({id: 'ergo-backpack', name: 'Orthopedic Ergonomic School Backpack', price: 32.00, image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&q=80&w=600', sizes: ['One Size'], colors: [{name: 'Deep Navy', value:'#1E3A8A'}]}, 1, 'One Size', 'Deep Navy')">Add
                            to Basket</button>
                    </div>
                </div>
                <!-- Item 4: Polo -->
                <div class="col-lg-3 col-md-6">
                    <div class="product-card-geo">
                        <div class="product-thumb-geo" style="cursor: pointer;"
                            onclick="window.location.href='product-details.html?id=polo-pique'">
                            <img src="https://images.unsplash.com/photo-1581655353564-df123a1eb820?auto=format&fit=crop&q=80&w=600"
                                alt="Everyday P.E. House Sports Polo">
                        </div>
                        <div class="product-school-geo">Essential Wear</div>
                        <h4 class="product-name-geo" style="cursor: pointer;"
                            onclick="window.location.href='product-details.html?id=polo-pique'">Everyday P.E. House Sports
                            Polo</h4>
                        <div class="product-price-geo">$15.00 <span
                                class="text-muted small text-decoration-line-through fs-7">$18.00</span></div>
                        <button class="btn btn-primary btn-sm mt-3 w-100"
                            onclick="State.addToCart({id: 'polo-pique', name: 'Everyday P.E. House Sports Polo', price: 15.00, image: 'https://images.unsplash.com/photo-1581655353564-df123a1eb820?auto=format&fit=crop&q=80&w=600', sizes: ['XS','S','M','L','XL'], colors: [{name: 'Navy Blue', value:'#1E3A8A'}]}, 1, 'M', 'Navy Blue')">Add
                            to Basket</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 13. Partner Schools (Administrative trust) -->
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <div class="text-center mb-4">
                <span class="badge-geo mb-2">Institutional Networks</span>
                <h3 class="h5 fw-bold text-dark">Trusted by Board-Certified Academic Districts</h3>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-3">
                    <div class="partner-logo-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path>
                        </svg>
                        <span class="partner-logo-name">Metro Prep Dist.</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="partner-logo-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        <span class="partner-logo-name">East Prep Board</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="partner-logo-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <span class="partner-logo-name">Academic Guild</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="partner-logo-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span class="partner-logo-name">Scholastic Spines</span>
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

    <!-- 15. School Gallery -->
    <section class="py-5" style="background-color: #F8FAFC;">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge-geo mb-2">Campus Chronicles</span>
                <h2 class="display-6 fw-bold text-dark">Our Uniforms In Action</h2>
                <p class="text-muted max-w-2xl mx-auto">Explore snapshots of scholastic life, sporting convocations, and
                    daily classroom activity from our partner schools.</p>
            </div>

            <div class="row g-4">
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="gallery-item-geo">
                        <img src="https://images.unsplash.com/photo-1596495578065-6e0763fa1141?auto=format&fit=crop&q=80&w=600"
                            alt="Assembly Hall" class="gallery-img">
                        <div class="gallery-overlay">
                            <h5 class="text-white fw-bold mb-0" style="font-size: 16px;">Morning Assemblies</h5>
                            <p class="text-white-50 small mb-0">Delhi Public School Assemblies</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="gallery-item-geo">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=600"
                            alt="Library Study" class="gallery-img">
                        <div class="gallery-overlay">
                            <h5 class="text-white fw-bold mb-0" style="font-size: 16px;">Academic Focus</h5>
                            <p class="text-white-50 small mb-0">Army Public School Library Sessions</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="gallery-item-geo">
                        <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&q=80&w=600"
                            alt="Sports Field" class="gallery-img">
                        <div class="gallery-overlay">
                            <h5 class="text-white fw-bold mb-0" style="font-size: 16px;">Physical Training</h5>
                            <p class="text-white-50 small mb-0">Active Athletic Inter-School Sports</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="gallery-item-geo">
                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&q=80&w=600"
                            alt="Classroom Discussion" class="gallery-img">
                        <div class="gallery-overlay">
                            <h5 class="text-white fw-bold mb-0" style="font-size: 16px;">Modern Learning</h5>
                            <p class="text-white-50 small mb-0">St. Xavier's High School Seminar Classrooms</p>
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

    <!-- 18. Newsletter -->
    <section class="py-5" style="background: linear-gradient(135deg, #1E3A8A 0%, #0F172A 100%);">
        <div class="container text-center text-white" style="max-width: 600px;">
            <span class="badge-geo mb-3"
                style="background: rgba(255,255,255,0.15); color: #FFF; border-color: transparent;">Stay Informed</span>
            <h3 class="h2 fw-bold mb-2 text-white">Join the eSchool Cart Newsletter</h3>
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

    <!-- 19. Onboarding Hub (Become Partner / Become Vendor) -->
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
                        <button class="btn rounded-pill px-4 py-2 fw-semibold" id="tab-school-btn"
                            onclick="switchOnboardingTab('school')"
                            style="font-size: 14px; border: none; background-color: var(--qu-primary); color: var(--qu-bg-white); transition: all 0.3s ease;">
                            Register Your School
                        </button>
                        <button class="btn rounded-pill px-4 py-2 fw-semibold text-secondary" id="tab-vendor-btn"
                            onclick="switchOnboardingTab('vendor')"
                            style="font-size: 14px; border: none; background-color: transparent; color: var(--qu-secondary); transition: all 0.3s ease;">
                            Become a Vendor
                        </button>
                    </div>
                </div>
            </div>

            <!-- School Partner Tab Panel -->
            <div id="tab-content-school" class="onboarding-tab-content">
                <div class="row align-items-center g-5">
                    <!-- Text and info column -->
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
                    <!-- Form Card column -->
                    <div class="col-lg-6">
                        <div class="card-geo p-4 border-0 shadow-sm" style="background-color: var(--qu-bg-white);">
                            <h4 class="fw-bold text-dark mb-1">Register Your School</h4>
                            <p class="text-secondary small mb-4">Our Institutional Partnerships manager will contact you
                                with mock designs.</p>

                            <form id="partner-school-form">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">School Name</label>
                                        <input type="text" required class="form-control"
                                            placeholder="e.g. St. Xavier's High"
                                            style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">Contact Person</label>
                                        <input type="text" required class="form-control"
                                            placeholder="e.g. Principal Sharma"
                                            style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">Email Address</label>
                                        <input type="email" required class="form-control"
                                            placeholder="admin@school.edu"
                                            style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">Phone Number</label>
                                        <input type="tel" required class="form-control" placeholder="+91 98765 43210"
                                            style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100 py-3 mt-2"
                                            style="border-radius: var(--qu-radius-sm); font-weight: 600;">Submit
                                            Partnership Request</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Success Message -->
                            <div id="partner-school-success" class="d-none text-center py-4">
                                <div
                                    style="background-color: #DEF7EC; color: #03543F; width: 56px; height: 56px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="3">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </div>
                                <h5 class="fw-bold text-dark">Partnership Request Submitted!</h5>
                                <p class="text-secondary small mb-0 mt-2">Thank you! Our Institutional Onboarding Team
                                    will
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
                    <!-- Text and info column -->
                    <div class="col-lg-6">
                        <span class="badge-geo mb-3"
                            style="background-color: var(--qu-badge-bg); color: var(--qu-primary);">Join
                            eSchoolKart</span>
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
                    <!-- Form Card column -->
                    <div class="col-lg-6">
                        <div class="card-geo p-4 border-0 shadow-sm" style="background-color: var(--qu-bg-white);">
                            <h4 class="fw-bold text-dark mb-1">Apply to Supply</h4>
                            <p class="text-secondary small mb-4">Submit your manufacturing registration details to undergo
                                credential verification.</p>

                            <form id="vendor-partner-form">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">Company Name</label>
                                        <input type="text" required class="form-control"
                                            placeholder="e.g. Apex Uniform Mills"
                                            style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">Product Category</label>
                                        <select required class="form-select"
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
                                        <input type="email" required class="form-control"
                                            placeholder="partner@company.com"
                                            style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">GSTIN / Corporate ID</label>
                                        <input type="text" required class="form-control"
                                            placeholder="e.g. 29GGGGG1314R1Z1"
                                            style="border-radius: var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 10px 14px;">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100 py-3 mt-2"
                                            style="border-radius: var(--qu-radius-sm); font-weight: 600;">Apply as
                                            Authorized Supplier</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Success Message -->
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

    <!-- 21. Footer -->
@endsection
