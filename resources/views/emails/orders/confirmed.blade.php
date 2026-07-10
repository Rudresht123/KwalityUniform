<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; border: 1px solid #eee; border-radius: 10px; overflow: hidden; }
        .header { background: #1E3A8A; color: #fff; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .order-details { background: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .footer { background: #f1f5f9; padding: 20px; text-align: center; font-size: 12px; color: #64748b; }
        .btn { display: inline-block; padding: 12px 24px; background: #1E3A8A; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank You for Your Order!</h1>
        </div>
        <div class="content">
            <p>Hello {{ $order->user->name }},</p>
            <p>We are excited to let you know that we have received your order. Our team is already working on getting your school uniforms ready for delivery.</p>
            
            <div class="order-details">
                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                <p><strong>Invoice Number:</strong> {{ $invoiceNumber }}</p>
                <p><strong>Total Amount:</strong> ₹{{ number_format($order->grand_total, 2) }}</p>
                <p><strong>Order Status:</strong> {{ ucfirst($order->status->value) }}</p>
            </div>

            <p>We have attached your <strong>PDF Invoice</strong> to this email for your records.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('website.orders.index') }}" class="btn">Track My Order</a>
            </div>
            
            <p style="margin-top: 30px;">If you have any questions, feel free to reply to this email or contact our support team.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Quality Uniform. All rights reserved.</p>
            <p>Premium Quality School Uniforms</p>
        </div>
    </div>
</body>
</html>
