<div class="section-label">Orders Performance</div>
<div class="row">
    <div class="col-md-8">

        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">
                    <i class="ti ti-chart-line" style="color: var(--primary)"></i>
                    Orders Trend
                </h3>

                <select id="order-performance-filter" class="panel-select">
                    <option value="week" selected>Last Week</option>
                    <option value="month">Last Month</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div>
                <div id="order-performance-chart" class="data-content"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card custom-card">

            <div class="card-header border-bottom">
                <div>
                    <h5 class="card-title mb-1">Recent Orders</h5>
                    <p class="text-muted fs-12 mb-0">
                        Latest orders received
                    </p>
                </div>
            </div>

          <div class="card-body recent-orders-body p-0">

                @forelse($recentOrders as $order)
                    <div class="d-flex align-items-center justify-content-between  py-3 border p-2 mb-2 radius-3">

                        <div class="d-flex align-items-center">

                            <div class="avatar avatar-sm me-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($order['product_name']) }}&background=4F46E5&color=fff"
                                    class="rounded-circle" alt="">
                            </div>

                            <div>

                                <h6 class="mb-1 fw-semibold">
                                    {{ $order['full_name'] }}
                                </h6>

                                <div class="text-muted fs-12">
                                    {{ $order['product_name'] }}
 
                                </div>

                                <small class="text-muted">
                                    Qty : {{ $order['quantity'] }}
                                </small>

                            </div>

                        </div>

                        <div class="text-end">

                            <div class="fw-bold text-primary">
                                ₹{{ number_format($order['amount'], 2) }}
                            </div>

                            <span
                                class="badge bg-{{ match ($order['status']) {
                                    'pending' => 'warning',
                                    'confirmed' => 'info',
                                    'processing' => 'primary',
                                    'packed' => 'secondary',
                                    'shipped' => 'dark',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'light',
                                } }}">
                                {{ ucfirst($order['status']->value) }}
                            </span>

                            <div class="fs-11 text-muted mt-1">
                                {{ $order['date'] }}
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i class="ti ti-shopping-cart-off fs-1 text-muted"></i>

                        <h6 class="mt-3 mb-1">No Recent Orders</h6>

                        <p class="text-muted mb-0">
                            Orders will appear here once customers start purchasing.
                        </p>

                    </div>
                @endforelse

</div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        loadOrderPerformance();

        document
            .getElementById('order-performance-filter')
            .addEventListener('change', function() {
                loadOrderPerformance(this.value);
            });

    });


    /**
     * Load Order Performance
     */
    async function loadOrderPerformance(filter = 'week') {

        try {

            const response = await fetch(
                `{{ route('ajax.vendor.order-trend') }}?filter=${filter}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            if (!response.ok) {
                throw new Error('Unable to load order performance.');
            }

            const data = await response.json();

            renderOrderPerformanceChart(data);

        } catch (error) {

            console.error(error);

        }

    }


    /**
     * Render Order Performance Chart
     */
    function renderOrderPerformanceChart(data) {

        ChartHelper.area({

            id: 'order-performance-chart',

            height: 300,

            categories: data.labels,

            series: [
                ChartHelper.series(
                    'Orders',
                    data.data,
                    ChartHelper.colors.primary
                )
            ],

            stroke: {
                width: 3
            },

            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 0.35,
                    opacityFrom: 0.35,
                    opacityTo: 0.05,
                    stops: [0, 100]
                }
            },

            markers: {
                size: 4,
                hover: {
                    size: 6
                }
            },

            xaxis: {
                title: {
                    text: 'Date'
                }
            },

            yaxis: {
                title: {
                    text: 'Orders'
                },
                min: 0,
                forceNiceScale: true
            },

            tooltip: {
                y: {
                    formatter(value) {
                        return `${value} Orders`;
                    }
                }
            }

        });

    }
</script>
