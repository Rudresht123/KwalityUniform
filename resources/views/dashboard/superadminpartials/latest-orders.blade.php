{{-- ===========================================
    OPERATIONS
=========================================== --}}

<div class="section-label">
    Operations
</div>

<div class="row g-4">

    {{-- ==========================
        Recent Orders
    ========================== --}}

    <div class="col-lg-6">

        <div class="custom-panel h-100">

            <div class="custom-panel-header">

                <div class="custom-panel-title">

                    <div class="custom-panel-icon">
                        <i class="ti-shopping-cart"></i>
                    </div>

                    <div>

                        <h5>Recent Orders</h5>

                        <small>
                            Latest customer orders
                        </small>

                    </div>

                </div>

                <a href="{{ route("reports.recent-orders.index") }}" class="custom-panel-link">

                    View All

                    <i class="ti-arrow-right"></i>

                </a>

            </div>


            <div class="custom-panel-body">

                @forelse($latest_orders as $order)

                    @php

                        $statusClass = match($order->status->value){

                            'pending' => 'warning',

                            'confirmed' => 'primary',

                            'processing' => 'info',

                            'packed' => 'secondary',

                            'shipped' => 'dark',

                            'delivered' => 'success',

                            'cancelled' => 'danger',

                            default => 'light'

                        };

                    @endphp

                    <div class="order-item">

                        <div class="order-left">

                            <div class="order-avatar">

                                <i class="ti-package"></i>

                            </div>

                            <div>

                                <div class="order-title">

                                    Order #{{ $order->id }}

                                </div>

                                <div class="order-subtitle">

                                    {{ $order->user->name ?? 'Guest User' }}

                                </div>

                            </div>

                        </div>

                        <div class="order-right">

                            <div class="order-price">

                                ₹{{ number_format($order->grand_total) }}

                            </div>

                            <span class="status-pill status-{{ $statusClass }}">

                                {{ ucfirst($order->status->value) }}

                            </span>

                        </div>

                    </div>

                @empty

                    <div class="empty-state">

                        <div class="empty-icon">

                            <i class="ti ti-shopping-cart-off"></i>

                        </div>

                        <h6>

                            No Orders Found

                        </h6>

                        <p>

                            New orders will appear here.

                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>





    {{-- ==========================
        Pending Approvals
    ========================== --}}

    <div class="col-lg-6">

        <div class="custom-panel h-100">

            <div class="custom-panel-header">

                <div class="custom-panel-title">

                    <div class="custom-panel-icon">

                        <i class="ti ti-clock"></i>

                    </div>

                    <div>

                        <h5>

                            Pending Approvals

                        </h5>

                        <small>

                            Products waiting for approval

                        </small>

                    </div>

                </div>

                <a href="#" class="custom-panel-link">

                    View All

                    <i class="ti ti-arrow-right"></i>

                </a>

            </div>


            <div class="custom-panel-body">

                @forelse($pending_approvals as $product)

                    <div class="approval-item">

                        <div class="approval-left">

                            <div class="approval-avatar">

                                <i class="ti ti-shirt"></i>

                            </div>

                            <div>

                                <div class="approval-title">

                                    {{ Str::limit($product->product_name,25) }}

                                </div>

                                <div class="approval-subtitle">

                                    {{ $product->vendor->business_name }}

                                </div>

                            </div>

                        </div>

                        <div class="approval-right">

                            <div class="approval-price">

                                ₹{{ number_format($product->price) }}

                            </div>

                            <a href="#"

                               class="btn-review">

                                Review

                            </a>

                        </div>

                    </div>

                @empty

                    <div class="empty-state">

                        <div class="empty-icon">

                            <i class="ti ti-circle-check"></i>

                        </div>

                        <h6>

                            Everything Looks Good

                        </h6>

                        <p>

                            No pending approvals available.

                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>