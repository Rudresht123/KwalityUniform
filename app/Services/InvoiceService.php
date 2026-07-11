<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class InvoiceService
{
    /**
     * Generate a PDF invoice for a given order.
     *
     * @param Order $order
     * @return string Path to the generated PDF
     * @throws Exception
     */
    public function generateInvoice(Order $order): string
    {
        $order->load(['items.variant.size', 'items.variant.color', 'user', 'shippingAddress']);

        // Render the PDF using the unified 'emails.invoice' view
        return Pdf::loadView('emails.invoice', compact('order'))->output();
    }

    /**
     * Download the PDF invoice for a given order.
     *
     * @param Order $order
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws Exception
     */
    public function downloadPdf(Order $order)
    {
        $order->load(['items.variant.size', 'items.variant.color', 'user', 'shippingAddress']);

        // Directly return the PDF as a download response using the unified 'emails.invoice' view
        return Pdf::loadView('emails.invoice', compact('order'))
            ->download('Invoice_' . $order->order_number . '.pdf');
    }

    /**
     * Get the URL for a specific invoice.
     *
     * @param string $filePath
     * @return string
     */
    public function getInvoiceUrl(string $filePath): string
    {
        return Storage::url($filePath);
    }
}
