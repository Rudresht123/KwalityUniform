<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
class SystemNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected array $data, protected array $channels = []) {}

    public function via($notifiable): array
    {
        return $this->channels;
    }

    public function toArray($notifiable): array
    {
        return $this->data;
    }

    public function toMail($notifiable): MailMessage
    {
        return new MailMessage()
            ->subject($this->data['title'])
            ->line($this->data['message'])
            ->action('View Details', $this->data['url'] ?? url('/'));
    }
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->data);
    }
}
