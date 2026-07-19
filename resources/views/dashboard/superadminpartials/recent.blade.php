<div class="section-label">Recent Trends</div>

<div class="row ">
    {{-- Recent Vendors --}}
    <div class="col-lg-6">

        <div class="custom-panel h-100">

            <div class="custom-panel-header">

                <div class="custom-panel-title">

                    <div class="custom-panel-icon">

                        <i class="ti ti-building-store"></i>

                    </div>

                    <div>

                        <h5>Recent Vendors</h5>

                        <small>Recently registered vendors</small>

                    </div>

                </div>

                <a href="{{ route("vendor.index") }}" class="custom-panel-link">
                    View All
                    <i class="ti-arrow-right"></i>
                </a>

            </div>

            <div class="custom-panel-body">

                @forelse($recent_vendors as $vendor)
                    <div class="vendor-item">

                        <div class="vendor-left">

                            <div class="vendor-avatar">

                                {{ strtoupper(substr($vendor->business_name, 0, 1)) }}

                            </div>

                            <div>

                                <div class="vendor-name">

                                    {{ Str::limit($vendor->business_name, 24) }}

                                </div>

                                <div class="vendor-phone">

                                    {{ $vendor->phone }}

                                </div>

                            </div>

                        </div>

                        <div>

                            <span class="status-pill status-success">

                                {{ ucfirst($vendor->status) }}

                            </span>

                        </div>

                    </div>

                @empty

                    @include('dashboard.empty-returns')
                @endforelse

            </div>

        </div>

    </div>

    {{-- Return Requests --}}
    <div class="col-lg-6">

        <div class="custom-panel h-100">

            <div class="custom-panel-header">

                <div class="custom-panel-title">

                    <div class="custom-panel-icon">

                        <i class="ti ti-refresh"></i>

                    </div>

                    <div>

                        <h5>Return Requests</h5>

                        <small>Latest customer returns</small>

                    </div>

                </div>

                <a href="{{ route("reports.recent-orders.index") }}" class="custom-panel-link">

                    View All

                    <i class=" ti-arrow-right"></i>

                </a>

            </div>

            <div class="custom-panel-body">

                @forelse($return_requests as $return)
                    <div class="return-item">

                        <div class="return-left">

                            <div class="return-avatar">

                                <i class="ti ti-package-off"></i>

                            </div>

                            <div>

                                <div class="return-title">

                                    Return #{{ $return->id }}

                                </div>

                                <div class="return-subtitle">

                                    Order #{{ $return->order_id }}

                                </div>

                                <div class="return-reason">

                                    {{ Str::limit($return->reason, 35) }}

                                </div>

                            </div>

                        </div>

                        <div>

                            <span class="status-pill status-warning">

                                {{ ucfirst($return->status) }}

                            </span>

                        </div>

                    </div>

                @empty

                    @include('dashboard.empty-returns')
                @endforelse

            </div>

        </div>

    </div>


</div>
