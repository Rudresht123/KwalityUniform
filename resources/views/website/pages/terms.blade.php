@extends("website.components.common")

@section('content')


<!-- ================= Hero Banner ================= -->
<div class="geo-page-header">
    <div class="container">
        <span class="badge-geo mb-3">eSchoolkart</span>
        <h1 class="display-4 fw-bold text-white mb-3">Terms and Conditions</h1>
        <p class="text-white-50 fs-5 col-lg-8">The rules that govern how schools, parents, and vendors buy and sell uniforms on QualityUniform.</p>
        <ul class="geo-breadcrumb mt-4">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>&bull;</li>
            <li class="active-item">Terms & Conditions</li>
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
                        <i class="ti ti-file-text fs-3" style="color:var(--qu-primary)"></i>
                        <h2 class="fw-bold mb-0" style="color:var(--qu-primary)">User Agreement</h2>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">01</div>
                        <div>
                            <h4 class="fw-bold text-dark">Use of Platform</h4>
                            <p>Browse, order, and fulfil school uniform needs only — for lawful use, not resale.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">02</div>
                        <div>
                            <h4 class="fw-bold text-dark">Accounts & Roles</h4>
                            <p>Keep your login secure — you're responsible for activity under your account.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">03</div>
                        <div>
                            <h4 class="fw-bold text-dark">Sizing & School Specs</h4>
                            <p>Every listing follows the size chart approved by your school — check it before ordering.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">04</div>
                        <div>
                            <h4 class="fw-bold text-dark">Orders & Payments</h4>
                            <p>Vendor-set prices, secure gateways. An order is confirmed once payment is captured.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">05</div>
                        <div>
                            <h4 class="fw-bold text-dark">Shipping & Delivery</h4>
                            <p>Vendors ship directly. Courier delays are outside our direct control.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">06</div>
                        <div>
                            <h4 class="fw-bold text-dark">Returns & Exchanges</h4>
                            <p>Unworn items with tags can be exchanged within 7 days. Innerwear excluded for hygiene.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">07</div>
                        <div>
                            <h4 class="fw-bold text-dark">School Logos & IP</h4>
                            <p>School crests and names stay the school's property, used only with authorization.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">08</div>
                        <div>
                            <h4 class="fw-bold text-dark">Limitation of Liability</h4>
                            <p>We facilitate the connection — vendor fulfilment issues are handled via mediation, not direct liability.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right: Illustration -->
            <div class="tnc-image-col">
                <img src="{{ asset("assets/website/images/tem_con.png") }}" alt="">
            </div>

        </div>
    </div>
</section>

@endsection