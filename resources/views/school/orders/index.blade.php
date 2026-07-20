@extends('layouts.common')

@section('content')
<div class="container-fluid">
    <div class="row">
        @forelse($orders as $order)
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm border-0 hover-shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <strong>{{ $order->order_number }}</strong>
                            <p class="small text-muted mb-0">{{ $order->created_at->format('d M, Y') }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : 'warning' }}">{{ ucfirst($order->status->value ?? $order->status) }}</span>
                        </div>
                        <div class="col-md-3">
                            <strong>₹{{ number_format($order->grand_total, 2) }}</strong>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('school.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            @component('components.empty-state', ['message' => 'No orders found for this school.']) @endcomponent
        </div>
        @endforelse
    </div>
    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>
@endsection
