<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        @page { size: A4; margin: 12mm 14mm; }
        * { box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #334155;
            line-height: 1.45;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .invoice-box { max-width: 100%; margin: auto; padding: 0; }

        /* Top brand bar */
        .brand-bar { height: 4px; background: #1E3A8A; margin-bottom: 16px; }

        /* Header */
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 18px; }
        .header-table td { vertical-align: top; }

        .logo-mark {
            display: inline-block;
            width: 32px;
            height: 32px;
            background: #1E3A8A;
            color: #fff;
            text-align: center;
            font-weight: 800;
            font-size: 14px;
            line-height: 32px;
            border-radius: 7px;
            margin-right: 8px;
        }
        .company-name-row td { padding: 0; }
        .company-info h2 { margin: 0 0 1px; color: #0F172A; font-size: 17px; letter-spacing: 0.2px; }
        .company-info .tagline { margin: 0 0 6px; font-size: 9.5px; color: #1E3A8A; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .company-info p { margin: 1px 0; font-size: 10.5px; color: #64748B; }

        .invoice-meta { text-align: right; }
        .invoice-meta h1 { margin: 0 0 6px; color: #0F172A; font-size: 21px; font-weight: 800; letter-spacing: 0.5px; }
        .invoice-meta table { margin-left: auto; border-collapse: collapse; }
        .invoice-meta td { padding: 1px 0 1px 12px; font-size: 11px; text-align: right; }
        .invoice-meta .meta-label { color: #94A3B8; text-transform: uppercase; font-size: 9px; letter-spacing: 0.3px; }
        .invoice-meta .meta-value { color: #1E293B; font-weight: 700; }

        /* Section titles */
        .section-title {
            font-size: 10px;
            font-weight: 700;
            color: #1E3A8A;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* Billing / Shipping — flat, no background block */
        .details-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0; }
        .details-table td { padding: 10px 0; vertical-align: top; font-size: 11px; }
        .details-table td:last-child { padding-left: 20px; border-left: 1px solid #EDF2F7; }
        .details-table .party-label { display: block; font-size: 9px; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 3px; }
        .details-table .party-name { font-weight: 700; color: #1E293B; font-size: 12px; }

        /* Items */
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        .items-table th {
            border-bottom: 1.5px solid #1E3A8A;
            color: #1E3A8A;
            padding: 6px 8px;
            text-align: left;
            font-size: 9.5px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .items-table td { padding: 7px 8px; border-bottom: 1px solid #F1F5F9; font-size: 11px; }
        .item-sku { font-size: 9px; color: #94A3B8; }

        /* Totals */
        .totals-container { float: right; width: 260px; margin-top: 2px; }
        .totals-table { width: 100%; border-collapse: collapse; }
        .totals-table td { padding: 3px 0; font-size: 11px; }
        .totals-table .label { color: #64748B; }
        .totals-table .value { text-align: right; font-weight: 600; color: #1E293B; }
        .totals-table .grand-total td { border-top: 1.5px solid #1E3A8A; padding-top: 6px; }
        .totals-table .grand-total .label { font-weight: 800; color: #1E3A8A; font-size: 12.5px; }
        .totals-table .grand-total .value { font-weight: 800; color: #1E3A8A; font-size: 15px; }

        /* Payment info */
        .payment-table { width: 100%; border-collapse: collapse; }
        .payment-table td { padding: 2px 0; font-size: 11px; }
        .payment-table .p-label { color: #64748B; width: 120px; }

        .status-badge {
            display: inline-block;
            padding: 2px 9px;
            border-radius: 10px;
            font-size: 9.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2px;
        }
        .status-paid, .status-completed, .status-delivered { background: #DCFCE7; color: #15803D; }
        .status-pending, .status-processing { background: #FEF3C7; color: #B45309; }
        .status-cod { background: #DBEAFE; color: #1D4ED8; }
        .status-cancelled, .status-failed { background: #FEE2E2; color: #B91C1C; }
        .status-default { background: #E2E8F0; color: #475569; }

        .notes-section {
            margin-top: 14px;
            padding: 8px 12px;
            border-left: 3px solid #1E3A8A;
            font-size: 10.5px;
            color: #64748B;
        }
        .notes-section strong { color: #1E293B; }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9.5px;
            color: #94A3B8;
            border-top: 1px solid #F1F5F9;
            padding-top: 10px;
        }
        .footer p { margin: 2px 0; }
        .footer .thanks { color: #1E3A8A; font-weight: 700; font-size: 11px; margin-bottom: 2px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="brand-bar"></div>

        <table class="header-table">
            <tr>
                <td style="width: 55%;">
                    <table class="company-name-row">
                        <tr>
                            <td style="width: 40px;"><span class="logo-mark">eS</span></td>
                            <td>
                                <div class="company-info">
                                    <h2>eSchoolKart</h2>
                                    <p class="tagline">School Uniforms &amp; Essentials</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="company-info" style="margin-top: 4px;">
                        <p>123 Apparel Street, Fashion Hub, Mumbai, MH - 400001<br>
                        support@eschoolkart.com &nbsp;|&nbsp; +91 98765 43210</p>
                    </div>
                </td>
                <td class="invoice-meta" style="width: 45%;">
                    <h1>INVOICE</h1>
                    <table>
                        <tr>
                            <td class="meta-label">Invoice #</td>
                            <td class="meta-value">{{ $invoiceNumber }}</td>
                        </tr>
                        <tr>
                            <td class="meta-label">Order #</td>
                            <td class="meta-value">{{ $order->order_number }}</td>
                        </tr>
                        <tr>
                            <td class="meta-label">Date</td>
                            <td class="meta-value">{{ $date }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="details-table">
            <tr>
                <td style="width: 50%;">
                    <span class="party-label">Billed To</span>
                    <span class="party-name">{{ $order->user->name }}</span><br>
                    {{ $order->user->email }}<br>
                    {{ $order->user->webUser->alternate_phone ?? $order->user->phone ?? 'N/A' }}
                </td>
                <td style="width: 50%;">
                    <span class="party-label">Shipping To</span>
                    <span class="party-name">{{ $order->user->name }}</span><br>
                    @if($order->shippingAddress ?? null)
                        {{ $order->shippingAddress->address_line1 ?? 'N/A' }}<br>
                        {{ $order->shippingAddress->city ?? '' }}{{ ($order->shippingAddress->city ?? null) && ($order->shippingAddress->state ?? null) ? ', ' : '' }}{{ $order->shippingAddress->state ?? '' }}
                        {{ $order->shippingAddress->zip_code ?? '' }}
                    @else
                        Same as billing address
                    @endif
                </td>
            </tr>
        </table>

        <div class="section-title">Order Items</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Product Details</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Unit Price</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <strong style="color: #1E293B;">{{ $item->variant?->product?->product_name ?? $item->product_name ?? 'Unknown Product' }}</strong><br>
                            <span class="item-sku">
                                SKU: {{ $item->variant?->product?->sku ?? $item->sku ?? 'N/A' }} &middot;
                                {{ $item->variant->display_name ?? 'Standard' }}
                            </span>
                        </td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->unit_price, 2) }}</td>
                        <td style="text-align: right;">₹{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>

        <div class="totals-container">
            <table class="totals-table">
                <tr>
                    <td class="label">Subtotal</td>
                    <td class="value">₹{{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Shipping Charge</td>
                    <td class="value">₹{{ number_format($order->shipping_charge, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Tax (GST)</td>
                    <td class="value">₹{{ number_format($order->tax_amount ?? 0, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td class="label">Grand Total</td>
                    <td class="value">₹{{ number_format($order->grand_total, 2) }}</td>
                </tr>
            </table>
        </div>

        <div style="clear: both; padding-top: 16px;">
            <div class="section-title">Payment</div>
            <table class="payment-table">
                <tr>
                    <td class="p-label">Payment Method</td>
                    <td>{{ $order->payment_status == 'paid' ? 'Online' : 'Cash on Delivery' }}</td>
                </tr>
                <tr>
                    <td class="p-label">Payment Status</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($order->payment_status) }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="p-label">Order Status</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($order->status->value) }}">
                            {{ ucfirst($order->status->value) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        @if($order->notes)
            <div class="notes-section">
                <strong>Order Notes:</strong> {{ $order->notes }}
            </div>
        @endif

        <div class="footer">
            <p class="thanks">Thank you for shopping with eSchoolKart!</p>
            <p>This is a computer generated invoice and does not require a physical signature.</p>
        </div>
    </div>
</body>
</html>