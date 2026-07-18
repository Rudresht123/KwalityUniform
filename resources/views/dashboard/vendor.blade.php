@php
    $breadcrumb = 'Dashboard';
    $title = 'Vendor Business Overview';
@endphp

<script src="{{ asset('assets/js/dashboard-charts.js') }}"></script>

<div class="g-root" data-loading="true">
    @if (!$vendor)
        <div class="warn-panel">
            <i class="ti ti-alert-triangle"></i>
            <div>
                <h6>Account Configuration Incomplete</h6>
                <p>Your user account is not yet linked to a vendor profile. Please contact the system administrator.</p>
            </div>
        </div>
    @else

    {{-- greeting sections --}}
        @php($greeting = greetings())

        <div class="dashboard-greeting">
            <div class="greeting-content">
                <h1>
                    {{ $greeting['icon'] }}
                    {{ $greeting['title'] }}, {{ $vendor->business_name }}
                </h1>

                <p>{{ $greeting['message'] }}</p>
            </div>

            <div class="greeting-date">
                <div>{{ now()->format('l') }}</div>
                <span>{{ now()->format('d M Y • h:i A') }}</span>
            </div>
        </div>

        {{-- ROW 1: QUICK ACTIONS & KEY KPIS --}}
        @include('dashboard.vendorpartials.kpi')

        {{-- ROW 2: CORE ANALYTICS --}}
        @include("dashboard.vendorpartials.revenu-trend")

                {{-- ROW 2: CORE ANALYTICS --}}
        @include("dashboard.vendorpartials.order-trend")

        {{-- ROW 3: SECONDARY KPIS & CHARTS --}}
        @include("dashboard.vendorpartials.order-status")

          
    @endif
</div>


