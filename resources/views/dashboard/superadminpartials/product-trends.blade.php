<div class="section-label">Inventory Overview</div>

<div class="row g-4">

    <!-- Product Upload Trend -->
    <div class="col-lg-8">
        <div class="panel h-100">
            <div class="panel-title">
                <i class="ti ti-chart-line" style="color:var(--primary)"></i>
                Product Upload Trend
            </div>

            <div id="productUploadChart" style="height:320px;"></div>
        </div>
    </div>

    <!-- Product Status -->
   <div class="col-lg-4">
    <div class="panel h-100">

        <div class="panel-header">
            <h3 class="panel-title">
                <i class="ti ti-trophy" style="color:#f59e0b"></i>
                Top Vendors
            </h3>

            <span class="badge bg-light text-dark">
                Top {{ $topVendors->count() }}
            </span>
        </div>

        <div class="panel-body vendor-scroll">

    @php
        $maxProducts = max($topVendors->max('products_count'), 1);
    @endphp

    @foreach($topVendors as $index => $vendor)

        <div class="vendor-card">

            <div class="vendor-rank">
                {{ $index + 1 }}
            </div>

            <div class="vendor-content">

                <div class="vendor-header">

                    <div class="vendor-name">
                        {{ Str::limit($vendor->business_name, 28) }}
                    </div>

                    <div class="vendor-count">
                        {{ number_format($vendor->products_count) }}
                    </div>

                </div>

                <div class="vendor-progress">
                    <div class="vendor-progress-fill"
                        style="width: {{ ($vendor->products_count / $maxProducts) * 100 }}%">
                    </div>
                </div>

            </div>

        </div>

    @endforeach

</div>

    </div>
</div>

</div>
