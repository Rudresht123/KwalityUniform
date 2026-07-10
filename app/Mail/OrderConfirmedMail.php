<?php

namespace App\Mail;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmed - ' . $this->order->order_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.orders.confirmed',
            with: [
                'order' => $this->order,
                'invoiceNumber' => 'INV-' . strtoupper($this->order->order_number),
            ],
        );
    }

    public function attachments(): array
    {
        // Generate PDF as a binary string
        $pdf = Pdf::loadView('website.orders.pdf-invoice', [
            'order' => $this->order,
            'invoiceNumber' => 'INV-' . strtoupper($this->order->order_number),
            'date' => now()->format('d M Y'),
        ])->output();

        return [
            Attachment::fromData(fn () => $pdf, 'invoice-' . $this->order->order_number . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
