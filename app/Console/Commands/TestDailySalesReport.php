<?php

namespace App\Console\Commands;

use App\Jobs\DailySalesReport;
use Illuminate\Console\Command;

class TestDailySalesReport extends Command
{
    protected $signature = 'email:test-daily-report';
    protected $description = 'Manually trigger daily sales report email';

    public function handle()
    {
        DailySalesReport::dispatch();
        
        $this->info('✅ Daily sales report job dispatched!');
        
        return Command::SUCCESS;
    }
}