<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvoiceService
{
    /**
     * Generate a professional PDF invoice for an order.
     *
     * @param Order $order
     * @return string Path to the generated PDF file
     */
    public function generatePdf(Order $order): string
    {
        // Ensure order has items loaded to avoid N+1 in the view
        $order->loadMissing(['items.product', 'items.variant', 'user']);

        $pdf = Pdf::loadView('website.orders.pdf-invoice', [
            'order' => $order,
            'invoiceNumber' => $order->order_number,
            'date' => now()->format('d M Y'),
        ]);
        
        // Set paper size to A4
        $pdf->setPaper('a4', 'portrait');

        $fileName = 'invoice_' . $order->id . '_' . time() . '.pdf';
        $filePath = 'invoices/' . $fileName;

        Storage::disk('public')->put($filePath, $pdf->output());

        return $filePath;
    }

    /**
     * Stream the PDF invoice directly to the browser.
     *
     * @param Order $order
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function streamPdf(Order $order)
    {
        $order->loadMissing(['items.product', 'items.variant', 'user']);
        $pdf = Pdf::loadView('website.orders.pdf-invoice', [
            'order' => $order,
            'invoiceNumber' => $order->order_number,
            'date' => now()->format('d M Y'),
        ]);
        return $pdf->stream("Invoice-{$order->id}.pdf");
    }

    /**
     * Trigger a download of the PDF invoice.
     *
     * @param Order $order
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function downloadPdf(Order $order)
    {
        $order->loadMissing(['items.product', 'items.variant', 'user']);
        $pdf = Pdf::loadView('website.orders.pdf-invoice', [
            'order' => $order,
            'invoiceNumber' => $order->order_number,
            'date' => now()->format('d M Y'),
        ]);
        return $pdf->download("Invoice-{$order->id}.pdf");
    }
}
