@extends('website.components.common')

@section('content')

<!-- ================= Hero Banner ================= -->
<div class="geo-page-header">
    <div class="container">
        <span class="badge-geo mb-3">eSchoolKart</span>
        <h1 class="display-4 fw-bold text-white mb-3">Privacy Policy</h1>
        <p class="text-white-50 fs-5 col-lg-8">How eSchoolKart collects, uses, and protects your information across the uniform marketplace.</p>
        <ul class="geo-breadcrumb mt-4">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>&bull;</li>
            <li class="active-item">Privacy Policy</li>
        </ul>
    </div>
</div>

<!-- ================= Content ================= -->
<section class="py-5">
    <div class="container">
        <div class="tnc-split">

            <!-- Left: Content -->
            <div class="tnc-content-col">
                <div class="card-geo p-5">

                    <div class="d-flex align-items-center gap-2 mb-4">
                        <i class="ti ti-shield-lock fs-3" style="color:var(--qu-primary)"></i>
                        <h2 class="fw-bold mb-0" style="color:var(--qu-primary)">Your Privacy is Our Priority</h2>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">01</div>
                        <div>
                            <h4 class="fw-bold text-dark">Information We Collect</h4>
                            <p>Name, contact details, shipping info, school/student details, and order history — only what's needed to fulfil your order.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">02</div>
                        <div>
                            <h4 class="fw-bold text-dark">How We Use It</h4>
                            <p>To process orders, provide support, send updates, and keep the platform secure — nothing else.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">03</div>
                        <div>
                            <h4 class="fw-bold text-dark">Sharing Your Information</h4>
                            <p>We never sell your data. It's shared only with delivery partners, payment providers, or verified vendors to fulfil orders.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">04</div>
                        <div>
                            <h4 class="fw-bold text-dark">Cookies & Analytics</h4>
                            <p>Used to remember your cart, preferences, and improve site performance.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">05</div>
                        <div>
                            <h4 class="fw-bold text-dark">Data Security</h4>
                            <p>Industry-standard safeguards protect your data from unauthorized access or misuse.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">06</div>
                        <div>
                            <h4 class="fw-bold text-dark">Your Rights</h4>
                            <p>You can request access, correction, or deletion of your personal data anytime.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">07</div>
                        <div>
                            <h4 class="fw-bold text-dark">Contact Us</h4>
                            <p>Questions about this policy? Reach out to the eSchoolKart support team anytime.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right: Illustration -->
            <div class="tnc-image-col">
                               <img src="{{ asset("assets/website/images/privacy.png") }}" alt="">

            </div>

        </div>
    </div>
</section>
@endsection