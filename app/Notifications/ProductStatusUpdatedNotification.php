<?php

namespace App\Notifications;

use App\Models\SuperAdmin\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductStatusUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $product;
    protected $adminMessage;

    public function __construct(Product $product, string $adminMessage = '')
    {
        $this->product = $product;
        $this->adminMessage = $adminMessage;
    }

    public function via($notifiable): array
    {
        return ['database', 'mail', 'broadcast'];
    }

    public function toMail($notifiable): MailMessage
    {
        $status = strtoupper($this->product->approval_status);

        return (new MailMessage)
            ->subject('Product Status Update: ' . $this->product->product_name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('The status of your product "' . $this->product->product_name '" has been updated to ' . $status . '.')
            ->line('Message from Admin: ' . ($this->adminMessage ?: 'No specific message.'))
            ->action('View Product', route('product.index'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [
            'product_id' => $this->product->product_id,
            'product_name' => $this->product->product_name,
            'status' => $this->product->approval_status,
            'message' => 'Your product ' . $this->product->product_name . ' has been ' . $this->product->approval_status,
            'url' => route('product.index')
        ];
    }
    }
