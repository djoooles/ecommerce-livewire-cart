<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\DailySalesReport;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        
        $schedule->job(new DailySalesReport)->dailyAt('18:00');
        
      //tional)
        $schedule->command('auth:clear-resets')->hourly();
        
        
        $schedule->command('queue:restart')->hourly();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
        
    }
    protected $commands = [
    \App\Console\Commands\TestLowStockNotification::class,
    \App\Console\Commands\TestDailySalesReport::class,
];
}