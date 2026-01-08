<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
  use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
 use Illuminate\Queue\SerializesModels;

class DailySalesReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sales;
    public $totalSales;

    public function __construct($sales, $totalSales)
    {
        $this->sales = $sales;
        $this->totalSales = $totalSales;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Sales Report - ' . date('Y-m-d'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.daily-sales-report',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}