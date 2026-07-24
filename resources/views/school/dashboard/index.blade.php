@extends('layouts.common')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-bold text-primary">School Dashboard</h4>
            <p class="text-muted fs-14">Welcome back, {{ $stats['school']->school_name }}</p>
        </div>
    </div>

    {{-- KPI Cards --}}
    <div class="row">
        @foreach([
            ['subtitle' => 'Total Students', 'value' => $stats['kpis']['total_students'], 'icon' => 'ti-user', 'growth' => 5],
            ['subtitle' => 'Registered Students', 'value' => $stats['kpis']['registered_students'], 'icon' => 'ti-check-box', 'growth' => 12],
            ['subtitle' => 'Total Revenue', 'value' => '₹' . number_format($stats['kpis']['total_revenue'], 2), 'icon' => 'ti-wallet', 'growth' => 8],
            ['subtitle' => 'Pending Orders', 'value' => $stats['kpis']['pending_orders'], 'icon' => 'ti-package', 'growth' => -2]
        ] as $kpi)
        <div class="col-xl-3 col-lg-6 col-md-6">
            @include('components.kpi-card', $kpi)
        </div>
        @endforeach
    </div>

    {{-- Analytics Section --}}
    <div class="row mt-4">
        <div class="col-xl-8">
            <div class="card custom-card">
                <div class="card-header"><div class="card-title">Order Trends</div></div>
                <div class="card-body">
                    <div id="order-trend-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card custom-card">
                <div class="card-header"><div class="card-title">Order Status</div></div>
                <div class="card-body">
                    <div id="status-donut-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Order Trends Chart
    var optionsTrend = {
        series: [{ name: 'Orders', data: {!! json_encode(array_values($stats['order_trends'])) !!} }],
        chart: { type: 'line', height: 350 },
        xaxis: { categories: {!! json_encode(array_keys($stats['order_trends'])) !!} }
    };
    new ApexCharts(document.querySelector("#order-trend-chart"), optionsTrend).render();

    // Order Status Chart
    var optionsStatus = {
        series: {!! json_encode(array_values($stats['status_distribution'])) !!},
        chart: { type: 'donut', height: 350 },
        labels: {!! json_encode(array_keys($stats['status_distribution'])) !!}
    };
    new ApexCharts(document.querySelector("#status-donut-chart"), optionsStatus).render();
</script>
@endpush

