<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $order->id }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; line-height: 1.5; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
        .header { display: flex; justify-content: space-between; margin-bottom: 40px; border-bottom: 3px solid #1E3A8A; padding-bottom: 20px; }
        .company-info { text-align: left; }
        .company-name { font-size: 24px; font-weight: bold; color: #1E3A8A; text-transform: uppercase; }
        .invoice-details { text-align: right; }
        .invoice-title { font-size: 28px; font-weight: bold; color: #999; margin-bottom: 5px; }
        .details-table { width: 100%; margin-bottom: 30px; border-collapse: collapse; }
        .details-table td { padding: 5px 0; font-size: 14px; }
        .label { font-weight: bold; color: #666; width: 150px; }
        .product-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .product-table th { background: #f8f9fa; border-bottom: 2px solid #dee2e6; padding: 12px; text-align: left; font-size: 14px; color: #1E3A8A; }
        .product-table td { padding: 12px; border-bottom: 1px solid #eee; font-size: 13px; }
        .text-right { text-align: right; }
        .totals-section { float: right; width: 300px; }
        .total-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 14px; }
        .grand-total { border-top: 2px solid #1E3A8A; margin-top: 10px; padding-top: 10px; font-weight: bold; font-size: 18px; color: #1E3A8A; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #eee; padding-top: 20px; }
        .status-badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .status-confirmed { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef9c3; color: #854d0e; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div class="company-info">
                <div class="company-name">eSchool Cart</div>
                <p>Premium Institutional Wear<br>
                123 Education Hub, New Delhi, India<br>
                Email: support@eschoolcart.com | Web: www.eschoolcart.com<br>
                GSTIN: 07AAAAA0000A1Z5</p>
            </div>
            <div class="invoice-details">
                <div class="invoice-title">INVOICE</div>
                <p>Invoice #: <strong>{{ $order->id }}</strong><br>
                Date: {{ $order->created_at->format('d M, Y') }}</p>
            </div>
        </div>

        <table class="details-table">
            <tr>
                <td class="label">Bill To:</td>
                <td>
                    <strong>{{ $order->user->name }}</strong><br>
                    {{ $order->user->email }}<br>
                    {{ $order->user->phone ?? 'N/A' }}
                </td>
                <td class="label" style="text-align: right;">Order Status:</td>
                <td style="text-align: right;">
                    <span class="status-badge status-{{ strtolower($order->status->value) }}">
                        {{ strtoupper($order->status->value) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">Shipping Address:</td>
                <td colspan="3">
                    {{ $order->shipping_address ?? 'No address provided' }}
                </td>
            </tr>
        </table>

        <table class="product-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th class="text-right">SKU</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product->product_name }}</strong><br>
                        <small style="color: #666;">{{ $item->variant->display_name ?? 'Standard' }}</small>
                    </td>
                    <td class="text-right">{{ $item->variant->sku ?? 'N/A' }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                    <td class="text-right">₹{{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals-section">
            <div class="total-row">
                <span>Subtotal:</span>
                <span>₹{{ number_format($order->total_amount - ($order->shipping_fee ?? 0), 2) }}</span>
            </div>
            <div class="total-row">
                <span>Shipping:</span>
                <span>₹{{ number_format($order->shipping_fee ?? 0, 2) }}</span>
            </div>
            <div class="total-row grand-total">
                <span>Grand Total:</span>
                <span>₹{{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>

        <div style="clear: both;"></div>

        <div class="footer">
            <p>Thank you for choosing eSchool Cart for your institutional wear!</p>
            <p>This is a computer-generated invoice and does not require a physical signature.</p>
        </div>
    </div>
</body>
</html>
