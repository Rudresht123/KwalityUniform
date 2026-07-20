<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Using a generic route since specific vendor order show route is not clearly identified
        $url = route('vendor.orders.dispatch'); // Assuming this provides access to order management

        return (new MailMessage)
            ->subject('New Order Received: ' . $this->order->order_number)
            ->line('You have received a new order.')
            ->line('Order Number: ' . $this->order->order_number)
            ->line('Total Amount: ₹' . number_format($this->order->grand_total, 2))
            ->action('View Order Details', $url)
            ->line('Thank you for processing this order.');
    }
}
