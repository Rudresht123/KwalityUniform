@extends('layouts.common')

@section('content')
<div class="container-fluid">
    {{-- KPI Cards --}}
    <div class="row">
        <div class="col-md-3">
            @component('components.kpi-card', ['label' => 'Total Orders', 'value' => $stats['total_orders'], 'icon' => 'ti ti-shopping-cart', 'iconClass' => 'bg-info-transparent text-info']) @endcomponent
        </div>
        <div class="col-md-3">
            @component('components.kpi-card', ['label' => 'Pending Orders', 'value' => $stats['pending_orders'], 'icon' => 'ti ti-alert-triangle', 'iconClass' => 'bg-warning-transparent text-warning']) @endcomponent
        </div>
        <div class="col-md-3">
            @component('components.kpi-card', ['label' => 'Confirmed Orders', 'value' => $stats['confirmed_orders'], 'icon' => 'ti ti-check', 'iconClass' => 'bg-primary-transparent text-primary']) @endcomponent
        </div>
        <div class="col-md-3">
            @component('components.kpi-card', ['label' => 'Delivered Orders', 'value' => $stats['delivered_orders'], 'icon' => 'ti ti-truck', 'iconClass' => 'bg-success-transparent text-success']) @endcomponent
        </div>
    </div>

    {{-- Active Partnerships Table --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5 class="card-title">Active Vendor Partnerships</h5></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Vendor</th>
                                <th>Approved Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partnerships as $partnership)
                            <tr>
                                <td>{{ $partnership->category->category_name }}</td>
                                <td>{{ $partnership->vendor->business_name }}</td>
                                <td>{{ $partnership->approved_at->format('d M, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Orders and Chart --}}
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5 class="card-title">Recent Orders</h5></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Placed At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td><span class="badge bg-{{ $order->status->color() }}">{{ $order->status->label() }}</span></td>
                                <td>{{ number_format($order->grand_total, 2) }}</td>
                                <td>{{ $order->placed_at->format('d M, Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h5 class="card-title">Order Distribution</h5></div>
                <div class="card-body">
                    <div id="orderStatusChart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var options = {
        series: @json(array_values($orderDistribution)),
        chart: {
            type: 'pie',
            height: 350
        },
        labels: @json(array_keys($orderDistribution)),
        responsive: [{
            breakpoint: 480,
            options: {
                chart: { width: 200 },
                legend: { position: 'bottom' }
            }
        }]
    };
    var chart = new ApexCharts(document.querySelector("#orderStatusChart"), options);
    chart.render();
</script>
@endpush
@endsection
