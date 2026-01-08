<?php

namespace App\Jobs;

use App\Models\CartItem;
use App\Mail\DailySalesReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DailySalesReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $today = now()->startOfDay();
        $tomorrow = now()->addDay()->startOfDay();
        
        
        $salesToday = CartItem::whereBetween('created_at', [$today, $tomorrow])
            ->with('product')
            ->get();
            
        $totalSales = $salesToday->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        
        $adminEmail = config('mail.admin_email', 'admin@example.com');
        
        Mail::to($adminEmail)->send(new DailySalesReportMail($salesToday, $totalSales));
    }
}