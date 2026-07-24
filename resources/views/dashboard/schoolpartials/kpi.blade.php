<div class="row g-4">

    <div class="col-xl-9">

        <div class="row g-3">

            {{-- Revenue --}}
            <div class="col-xl-4 col-md-6">
                <div class="dashboard-card">
                    <div class="card-header-info">
                        <div class="card-icon success">
                            <i class="ti ti-currency-rupee"></i>
                        </div>

                        <span>Total Students</span>
                    </div>

                    <h2 id="kpi-todays-revenue"> {{ number_format($stats['kpis']['total_students'] ?? 0) }}</h2>
                </div>
            </div>


            {{-- Orders --}}
            <div class="col-xl-4 col-md-6">
                <div class="dashboard-card">
                    <div class="card-header-info">
                        <div class="card-icon primary">
                            <i class="ti-shopping-cart"></i>
                        </div>

                        <span>Revenue</span>
                    </div>

                    <h2 id="kpi-todays-orders">₹ {{ number_format($stats['kpis']['total_revenue'] ?? 0, 2) }}</h2>
                </div>
            </div>

            {{-- Pending --}}
            <div class="col-xl-4 col-md-6">
                <div class="dashboard-card">
                    <div class="card-header-info">
                        <div class="card-icon warning">
                            <i class="ti ti-clock"></i>
                        </div>

                        <span>Pending Orders</span>
                    </div>

                    <h2 id="kpi-pending-orders">{{ number_format($stats['kpis']['pending_orders'] ?? 0) }}</h2>
                </div>
            </div>




        </div>

    </div>


</div>
