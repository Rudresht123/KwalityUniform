<?php

namespace App\Notifications;

use App\Models\SuperAdmin\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductApprovalRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via($notifiable): array
    {
        return ['database', 'mail', 'broadcast'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Action Required: New Product Approval Request')
            ->greeting('Hello Admin,')
            ->line('A new product has been submitted for approval.')
            ->line('Product Name: ' . $this->product->product_name)
            ->line('Vendor: ' . $this->product->vendor->business_name)
            ->action('Review Product', route('product.show', $this->product->product_id))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [
            'product_id' => $this->product->product_id,
            'product_name' => $this->product->product_name,
            'vendor_name' => $this->product->vendor->business_name,
            'message' => 'New product approval request for ' . $this->product->product_name,
            'url' => route('product.show', $this->product->product_id)
        ];
    }
}
