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
            ->subject('Product Review Update - ' . $this->product->product_name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your product has been reviewed by our administration team.')
            ->line('**Product:** ' . $this->product->product_name)
            ->line('**Current Status:** ' . ucfirst($status))
            ->line('**Admin Remarks:** ' . ($this->adminMessage ?: 'No additional remarks were provided.'))
            ->action('View Products', route('product.index'))
            ->line('If you have any questions regarding this review, please contact our support team.')
            ->salutation('Regards,' . PHP_EOL . 'eSchoolKart Uniform Software Team');
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
