<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OrderReceiptMail extends Mailable
{
    public $pdf;

    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Struk Pembelian')
            ->view('emails.order_receipt')
            ->attachData($this->pdf->output(), 'struk.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
