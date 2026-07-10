@if($orders->total() > 0)
    <p class="orders-count text-muted mb-3">
        Showing {{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ $orders->total() }} order{{ $orders->total() == 1 ? '' : 's' }}
    </p>
@endif

<div class="card border-0 shadow-sm rounded-4 overflow-hidden orders-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 orders-table">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3">Order ID</th>
                    <th class="py-3">Date</th>
                    <th class="py-3 text-center">Items</th>
                    <th class="py-3 text-end">Total</th>
                    <th class="py-3 text-center">Status</th>
                    <th class="py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="px-4" data-label="Order ID">
                            <span class="orders-id-wrap">
                                <span class="fw-bold text-dark">{{ $order->order_number }}</span>
                                <button type="button" class="orders-id-copy" data-copy="{{ $order->order_number }}" title="Copy order ID">
                                    <i class="ti ti-copy"></i>
                                </button>
                            </span>
                        </td>
                        <td data-label="Date">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        <td class="text-center" data-label="Items">{{ $order->items_count ?? $order->items->count() }}</td>
                        <td class="text-end fw-bold" data-label="Total">₹{{ number_format($order->grand_total, 2) }}</td>
                        <td class="text-center" data-label="Status">
                            @php
                                $statusMap = [
                                    'delivered'  => 'success',
                                    'shipped'    => 'info',
                                    'packed'     => 'info',
                                    'processing' => 'info',
                                    'confirmed'  => 'amber',
                                    'pending'    => 'amber',
                                    'cancelled'  => 'danger',
                                    'returned'   => 'danger',
                                    'refunded'   => 'danger',
                                ];
                                $statusTone = $statusMap[$order->status->value] ?? 'neutral';
                            @endphp
                            <span class="order-status order-status-{{ $statusTone }}">
                                <span class="order-status-dot"></span>{{ ucfirst($order->status->value) }}
                            </span>
                        </td>
                        <td class="text-center" data-label="Actions">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('website.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Details</a>
                                <button type="button"
                                        class="btn btn-sm btn-outline-dark orders-invoice-btn"
                                        data-url="{{ route('website.orders.pdf', $order->id) }}"
                                        data-order="{{ $order->order_number }}">
                                    <i class="ti ti-download me-1"></i> <span class="orders-invoice-label">Invoice</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border-0">
                            <div class="orders-empty">
                                <div class="orders-empty-icon">
                                    <i class="ti-bag"></i>
                                </div>
                                <h5>No orders found</h5>
                                <p>
                                    @if(request('search') || request('status'))
                                        No orders match your current filters. Try adjusting your search.
                                    @else
                                        When you place an order, it'll show up here — track status and grab invoices anytime.
                                    @endif
                                </p>
                                <div class="d-flex justify-content-center gap-2">
                                    @if(request('search') || request('status'))
                                        <a href="{{ route('website.orders.index') }}" class="btn btn-sm btn-outline-secondary">Clear filters</a>
                                    @endif
                                    <a href="{{ route('website.shop') }}" class="btn btn-orders-primary btn-sm">Continue Shopping</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-4 py-3 bg-light border-top orders-pagination">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
