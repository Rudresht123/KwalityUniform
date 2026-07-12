@extends("website.components.common")

@section('content')

<!-- ================= Hero Banner ================= -->
<div class="geo-page-header">
    <div class="container">
        <span class="badge-geo mb-3">eSchoolKart</span>
        <h1 class="display-4 fw-bold text-white mb-3">Return Policy</h1>
        <p class="text-white-50 fs-5 col-lg-8">Our guidelines for returns, exchanges, and refunds.</p>
        <ul class="geo-breadcrumb mt-4">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>&bull;</li>
            <li class="active-item">Return Policy</li>
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
                        <i class="ti ti-replace fs-3" style="color:var(--qu-primary)"></i>
                        <h2 class="fw-bold mb-0" style="color:var(--qu-primary)">Returns & Exchanges</h2>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">01</div>
                        <div>
                            <h4 class="fw-bold text-dark">Return Window</h4>
                            <p>Return within 2 days of delivery. Items must be unworn, unwashed, with tags attached.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">02</div>
                        <div>
                            <h4 class="fw-bold text-dark">Eligible Items</h4>
                            <p>Accepted for defects or sizing issues. Customized items may follow different vendor-specific terms.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">03</div>
                        <div>
                            <h4 class="fw-bold text-dark">Refund Process</h4>
                            <p>Refunded to your original payment method within 7-10 business days after inspection.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">04</div>
                        <div>
                            <h4 class="fw-bold text-dark">Exchange Requests</h4>
                            <p>Need a different size? Exchange is subject to stock availability with the vendor.</p>
                        </div>
                    </div>

                    <div class="tnc-item">
                        <div class="tnc-num">05</div>
                        <div>
                            <h4 class="fw-bold text-dark">Tags & Wash Condition</h4>
                            <p>Washed, worn, or tag-removed items are not eligible for return or exchange.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right: Illustration -->
            <div class="tnc-image-col">
                                              <img src="{{ asset("assets/website/images/return.png") }}" alt="">

            </div>

        </div>
    </div>
</section>
@endsection