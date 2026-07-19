
<div class="section-label">
    Alerts
</div>
<div class="row">
     {{-- Low Stock Products --}}
        <div class="col-lg-6">

    <div class="custom-panel h-100">

        <div class="custom-panel-header">

            <div class="custom-panel-title">

                <div class="custom-panel-icon">
                    <i class="ti ti-alert-triangle"></i>
                </div>

                <div>

                    <h5>Low Stock Alerts</h5>

                    <small>Products requiring immediate attention</small>

                </div>

            </div>

          

        </div>

        <div class="custom-panel-body">

            @forelse($inventory_alerts as $variant)

                <div class="stock-item">

                    <div class="stock-left">

                        <div class="stock-avatar">

                            <i class="ti ti-package"></i>

                        </div>

                        <div>

                            <div class="stock-title">

                                {{ Str::limit($variant->product->product_name ?? 'Unknown Product',25) }}

                            </div>

                            <div class="stock-subtitle">

                                SKU : {{ $variant->sku }}

                            </div>

                        </div>

                    </div>

                    <div class="stock-right">

                        <div class="stock-count">

                            {{ $variant->stock_qty }}

                        </div>

                        <span class="status-pill status-danger">

                            Threshold : {{ $variant->low_stock_alert }}

                        </span>

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="ti ti-package-off"></i>

                    </div>

                    <h6>No Low Stock Products</h6>

                    <p>Inventory levels look healthy.</p>

                </div>

            @endforelse

        </div>

    </div>

</div>

       <div class="col-lg-6">

    <div class="custom-panel h-100">

        <div class="custom-panel-header">

            <div class="custom-panel-title">

                <div class="custom-panel-icon">

                    <i class="ti ti-trending-up"></i>

                </div>

                <div>

                    <h5>Top Selling Products</h5>

                    <small>Best performing products</small>

                </div>

            </div>

         

        </div>

        <div class="custom-panel-body">

            @forelse($top_selling_products as $product)

                <div class="top-product-item">

                    <div class="top-product-left">

                        <div class="top-product-rank">

                            {{ $loop->iteration }}

                        </div>

                        <div>

                            <div class="top-product-title">

                                {{ Str::limit($product['product_name'],30) }}

                            </div>

                            <div class="top-product-subtitle">

                                {{ number_format($product['total_sold']) }} Units Sold

                            </div>

                        </div>

                    </div>

                    <div class="top-product-right">

                        <div class="top-product-badge">

                            #{{ $loop->iteration }}

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="ti ti-chart-bar-off"></i>

                    </div>

                    <h6>No Sales Data</h6>

                    <p>Top selling products will appear here.</p>

                </div>

            @endforelse

        </div>

    </div>

</div>

</div>