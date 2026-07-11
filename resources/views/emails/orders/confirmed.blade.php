<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; }
        .header { text-align: center; padding-bottom: 20px; border-bottom: 2px solid #6B62DD; }
        .header h1 { color: #6B62DD; margin: 0; }
        .content { padding: 20px 0; }
        .section-title { font-size: 14px; font-weight: bold; color: #6B62DD; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px; text-transform: uppercase; }
        .order-summary { background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .summary-item { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 14px; }
        .total { font-weight: bold; border-top: 1px solid #ddd; padding-top: 10px; margin-top: 10px; }
        .details-grid { display: table; width: 100%; margin-bottom: 20px; }
        .details-col { display: table-cell; width: 50%; vertical-align: top; font-size: 13px; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 13px; }
        .items-table th { text-align: left; background: #f4f4f4; padding: 8px; border-bottom: 2px solid #6B62DD; }
        .items-table td { padding: 8px; border-bottom: 1px solid #eee; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 30px; }
        .btn { display: inline-block; padding: 10px 20px; background: #6B62DD; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmed!</h1>
        </div>
        <div class="content">
            <p>Hello {{ $order->user->name ?? 'Customer' }},</p>
            <p>Thank you for your purchase! Your order has been placed successfully. We are now preparing your items for shipment.</p>
            
            <div class="section-title">Order Summary</div>
            <div class="order-summary">
                <div class="summary-item">
                    <span>Order Number:</span>
                    <strong>{{ $order->order_number }}</strong>
                </div>
                <div class="summary-item">
                    <span>Date:</span>
                    <strong>{{ \Carbon\Carbon::parse($order->placed_at)->format('d M Y') }}</strong>
                </div>
                <div class="summary-item">
                    <span>Grand Total:</span>
                    <strong>₹{{ number_format($order->grand_total, 2) }}</strong>
                </div>
                <div class="total">
                    <div class="summary-item">
                        <span>Payment Status:</span>
                        <strong>{{ strtoupper($order->payment_status) }}</strong>
                    </div>
                </div>
            </div>

            <div class="section-title">Order Items</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->product_name }}</strong><br>
                                <small>{{ $item->variant->size->display_name ?? 'Std' }} / {{ $item->variant->color->color_name ?? 'N/A' }}</small>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td style="text-align: right;">₹{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="details-grid">
                <div class="details-col">
                    <div class="section-title">Shipping Address</div>
                    <strong>{{ $order->shippingAddress->full_name ?? 'N/A' }}</strong><br>
                    {{ $order->shippingAddress->address_line1 ?? 'N/A' }}<br>
                    {{ $order->shippingAddress->city ?? 'N/A' }}, {{ $order->shippingAddress->state ?? 'N/A' }}<br>
                    {{ $order->shippingAddress->zip_code ?? 'N/A' }}
                </div>
                <div class="details-col" style="padding-left: 20px;">
                    <div class="section-title">Vendor Details</div>
                    @php
                        $vendor = \App\Models\SuperAdmin\Vendor::find($order->items->first()->vendor_id ?? null);
                    @endphp
                    <strong>{{ $vendor->vendor_name ?? 'Quality Uniform Partner' }}</strong><br>
                    {{ $vendor->email ?? 'support@qualityuniform.com' }}<br>
                    {{ $vendor->phone ?? 'N/A' }}
                </div>
            </div>

            <p style="margin-top: 20px;">We have attached your professional invoice to this email for your records.</p>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/my-orders/' . $order->id) }}" class="btn">View Order Status</a>
            </div>

            <p>If you have any questions, please contact our support team at support@qualityuniform.com.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Quality Uniform. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
