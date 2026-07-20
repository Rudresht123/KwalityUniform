<?php

namespace App\Notifications;

use App\Models\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShipmentCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $shipment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Shipment $shipment)
    {
        $this->shipment = $shipment;
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
        return (new MailMessage)
            ->subject('New Shipment Created: ' . $this->shipment->tracking_number)
            ->line('A new shipment has been created.')
            ->line('Tracking Number: ' . $this->shipment->tracking_number)
            ->line('Status: ' . $this->shipment->status->value)
            ->action('View Shipment', url('/vendor/fulfillment-hub'))
            ->line('Thank you for using our fulfillment service.');
    }
}
