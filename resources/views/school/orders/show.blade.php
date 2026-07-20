@extends('layouts.common')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h5 class="card-title">Order Details: #{{ $order->order_number }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Order Summary</h6>
                    <p>Status: <span class="badge bg-primary">{{ ucfirst($order->status->value ?? $order->status) }}</span></p>
                    <p>Total: ₹{{ number_format($order->grand_total, 2) }}</p>
                </div>
            </div>
            
            <h6 class="mt-4">Products</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
