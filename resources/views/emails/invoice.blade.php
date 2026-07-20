<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        @page { size: A4; margin: 14mm 16mm; }
        * { box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #334155;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .invoice-box {
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
        }

        /* Letterhead stripe */
        .brand-bar-gold { height: 5px; background: linear-gradient(90deg, #7C3AED 0%, #EC4899 50%, #F59E0B 100%); }
        .brand-bar-navy { height: 1px; background: #E2E8F0; margin-bottom: 20px; }

        /* Header */
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .header-table td { vertical-align: top; }

        .logo-mark {
            display: inline-block;
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, #7C3AED 0%, #4C1D95 100%);
            color: #FFFFFF;
            text-align: center;
            font-weight: 800;
            font-size: 14px;
            line-height: 34px;
            border-radius: 6px;
            margin-right: 10px;
            letter-spacing: 0.5px;
        }

        .company-name-row td { padding: 0; }
        .company-info h2 { margin: 0 0 2px; color: #4C1D95; font-size: 18px; letter-spacing: 0.2px; font-weight: 800; }
        .company-info .tagline { margin: 0 0 6px; font-size: 9px; color: #EC4899; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; }
        .company-info p { margin: 1px 0; font-size: 10px; color: #64748B; }

        .invoice-meta-box {
            border: 1px solid #DDD6FE;
            border-radius: 8px;
            background: #F5F3FF;
            padding: 12px 16px;
        }
        .invoice-meta-box h1 {
            margin: 0 0 8px;
            color: #4C1D95;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            border-bottom: 1px solid #DDD6FE;
            padding-bottom: 8px;
        }
        .invoice-meta-box table { width: 100%; border-collapse: collapse; }
        .invoice-meta-box td { padding: 2px 0; font-size: 10.5px; }
        .invoice-meta-box .meta-label { color: #8B7FC7; text-transform: uppercase; font-size: 8.5px; letter-spacing: 0.4px; }
        .invoice-meta-box .meta-value { color: #312E81; font-weight: 700; text-align: right; }

        /* Section titles */
        .section-title {
            font-size: 10px;
            font-weight: 800;
            color: #4C1D95;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border-bottom: 1.5px solid #7C3AED;
            padding-bottom: 5px;
        }

        /* Billing / Shipping panels */
        .details-table { width: 100%; border-collapse: separate; border-spacing: 12px 0; margin: 0 -12px 18px; }
        .details-table td {
            width: 50%;
            vertical-align: top;
            font-size: 10.5px;
            padding: 12px 14px;
            border-radius: 8px;
        }
        .details-table .bill-to { background: #F5F3FF; border: 1px solid #DDD6FE; }
        .details-table .ship-to { background: #ECFEFF; border: 1px solid #A5F3FC; }
        .details-table .party-label { display: block; font-size: 8.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
        .details-table .bill-to .party-label { color: #7C3AED; }
        .details-table .ship-to .party-label { color: #0891B2; }
        .details-table .party-name { font-weight: 700; color: #312E81; font-size: 12px; }

        /* Items */
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 14px; }
        .items-table th {
            background: linear-gradient(90deg, #4C1D95 0%, #6D28D9 100%);
            color: #FFFFFF;
            padding: 9px 10px;
            text-align: left;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
        }
        .items-table th:first-child { border-radius: 6px 0 0 0; }
        .items-table th:last-child { border-radius: 0 6px 0 0; }
        .items-table td { padding: 9px 10px; border-bottom: 1px solid #F1F5F9; font-size: 11px; }
        .items-table tbody tr:nth-child(even) td { background: #FAFBFC; }
        .item-sku { font-size: 9px; color: #94A3B8; }

        /* Totals */
        .totals-wrap { width: 100%; overflow: hidden; margin-bottom: 4px; }
        .totals-container { float: right; width: 270px; }
        .totals-table { width: 100%; border-collapse: collapse; }
        .totals-table td { padding: 4px 4px; font-size: 11px; }
        .totals-table .label { color: #64748B; }
        .totals-table .value { text-align: right; font-weight: 600; color: #312E81; }
        .totals-table .grand-total td {
            background: linear-gradient(90deg, #4C1D95 0%, #7C3AED 100%);
            color: #FFFFFF;
            padding: 10px 12px;
            border-radius: 7px;
        }
        .totals-table .grand-total td:first-child { border-radius: 7px 0 0 7px; }
        .totals-table .grand-total td:last-child { border-radius: 0 7px 7px 0; }
        .totals-table .grand-total .label { font-weight: 700; color: #E2E8F0; font-size: 11px; text-transform: uppercase; letter-spacing: 0.4px; }
        .totals-table .grand-total .value { font-weight: 800; color: #FFFFFF; font-size: 16px; }

        /* Payment info */
        .payment-section { clear: both; padding-top: 20px; }
        .payment-table { width: 100%; border-collapse: collapse; }
        .payment-table td { padding: 4px 0; font-size: 11px; }
        .payment-table .p-label { color: #64748B; width: 130px; }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 10px;
            font-size: 9.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .status-paid, .status-completed, .status-delivered { background: #DCFCE7; color: #15803D; }
        .status-pending, .status-processing { background: #FEF3C7; color: #B45309; }
        .status-cod { background: #CFFAFE; color: #0E7490; }
        .status-cancelled, .status-failed { background: #FEE2E2; color: #B91C1C; }
        .status-default { background: #E2E8F0; color: #475569; }

        .notes-section {
            margin-top: 16px;
            padding: 10px 14px;
            background: #FAF5FF;
            border-left: 3px solid #7C3AED;
            font-size: 10.5px;
            color: #64748B;
            border-radius: 0 6px 6px 0;
        }
        .notes-section strong { color: #312E81; }

        .footer {
            margin-top: 26px;
            text-align: center;
            font-size: 9.5px;
            color: #94A3B8;
            border-top: 1px solid #F1F5F9;
            padding-top: 12px;
        }
        .footer p { margin: 2px 0; }
        .footer .thanks { color: #4C1D95; font-weight: 700; font-size: 11.5px; margin-bottom: 3px; letter-spacing: 0.2px; }
        .footer .rule-dot { color: #7C3AED; margin: 0 6px; }
    </style>
</head>
<body>

    <div class="invoice-box">
        <div class="brand-bar-gold"></div>
        <div class="brand-bar-navy"></div>

        <table class="header-table">
            <tr>
                <td style="width: 55%;">
                    <table class="company-name-row">
                        <tr>
                            <td style="width: 44px;"><span class="logo-mark">eSK</span></td>
                            <td>
                                <div class="company-info">
                                    <h2>eSchoolKart</h2>
                                    <p class="tagline">Premium School Uniforms &amp; Essentials</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="company-info" style="margin-top: 6px;">
                        <p>Sector 81, Noida, Uttar Pradesh<br>
                        support@eschoolkart.com &nbsp;|&nbsp; +91 98765 43210</p>
                    </div>
                </td>
                <td style="width: 45%;">
                    <div class="invoice-meta-box">
                        <h1>Tax Invoice</h1>
                        <table>
                            <tr>
                                <td class="meta-label">Invoice #</td>
                                <td class="meta-value">{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <td class="meta-label">Order #</td>
                                <td class="meta-value">{{ $order->order_number }}</td>
                            </tr>
                            <tr>
                                <td class="meta-label">Date</td>
                                <td class="meta-value">{{ \Carbon\Carbon::parse($order->placed_at)->format('d M Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <table class="details-table">
            <tr>
                <td class="bill-to">
                    <span class="party-label">Billed To</span>
                    <span class="party-name">{{ $order->user->name ?? 'Guest Customer' }}</span><br>
                    {{ $order->user->email ?? 'N/A' }}<br>
                    {{ $order->user->phone ?? 'N/A' }}
                </td>
                <td class="ship-to">
                    <span class="party-label">Shipping To</span>
                    @if($order->delivery_type->value === 'school' && $order->school)
                        <span class="party-name">{{ $order->school->school_name }}</span><br>
                        {{ $order->school->address ?? 'N/A' }}<br>
                        {{ $order->school->city ?? 'N/A' }}{{ ($order->school->city ?? null) && ($order->school->state ?? null) ? ', ' : '' }}{{ $order->school->state ?? 'N/A' }}<br>
                        {{ $order->school->pincode ?? 'N/A' }}
                    @elseif($order->delivery_type->value === 'home' && $order->shippingAddress)
                        <span class="party-name">{{ $order->shippingAddress->full_name ?? 'Guest Customer' }}</span><br>
                        {{ $order->shippingAddress->address_line1 ?? 'N/A' }}<br>
                        {{ $order->shippingAddress->city ?? 'N/A' }}{{ ($order->shippingAddress->city ?? null) && ($order->shippingAddress->state ?? null) ? ', ' : '' }}{{ $order->shippingAddress->state ?? 'N/A' }}<br>
                        {{ $order->shippingAddress->zip_code ?? 'N/A' }}
                    @else
                        <span class="party-name">{{ $order->user->name ?? 'Guest Customer' }}</span><br>
                        {{ $order->user->email ?? 'N/A' }}<br>
                        {{ $order->user->phone ?? 'N/A' }}<br>
                        <small style="color: #94A3B8;">(Same as billing address)</small>
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
                            <strong style="color: #312E81;">{{ $item->product_name }}</strong><br>
                            <span class="item-sku">
                                SKU: {{ $item->sku }} &middot;
                                {{ $item->variant->size->display_name ?? 'Standard' }} /
                                {{ $item->variant->color->color_name ?? 'N/A' }}
                            </span>
                        </td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right;">&#8377;{{ number_format($item->unit_price, 2) }}</td>
                        <td style="text-align: right;">&#8377;{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals-wrap">
            <div class="totals-container">
                <table class="totals-table">
                    <tr>
                        <td class="label">Subtotal</td>
                        <td class="value">&#8377;{{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Shipping Charge</td>
                        <td class="value">&#8377;{{ number_format($order->shipping_charge, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tax (GST)</td>
                        <td class="value">&#8377;{{ number_format($order->tax_amount ?? 0, 2) }}</td>
                    </tr>
                    <tr class="grand-total">
                        <td class="label">Grand Total</td>
                        <td class="value">&#8377;{{ number_format($order->grand_total, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="payment-section">
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

        @if($order->customer_note)
            <div class="notes-section">
                <strong>Order Notes:</strong> {{ $order->customer_note }}
            </div>
        @endif

        <div class="footer">
            <p class="thanks">Thank you for shopping with eSchoolKart</p>
            <p>This is a computer generated invoice and does not require a physical signature.</p>
            <p>eschoolkart.com <span class="rule-dot">&bull;</span> support@eschoolkart.com <span class="rule-dot">&bull;</span> +91 98765 43210</p>
        </div>
    </div>
</body>
</html>