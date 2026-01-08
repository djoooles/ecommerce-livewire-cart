<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Jobs\LowStockNotification;
use Illuminate\Console\Command;

class TestLowStockNotification extends Command
{
    protected $signature = 'email:test-low-stock';
    protected $description = 'Manually trigger low stock notifications';

    public function handle()
    {
        // / / Get produc
        $lowStockProducts = Product::where('stock_quantity', '<=', 5)
            ->where('stock_quantity', '>', 0)
            ->get();
        
        if ($lowStockProducts->count() > 0) {
            foreach ($lowStockProducts as $product) {
                LowStockNotification::dispatch($product);
                $this->info("⚠️ Low stock notification dispatched for: {$product->name}");
            }
            $this->info('✅ Low stock notifications dispatched!');
        } else {
            $this->info('No products with low stock found.');
        }
        
        return Command::SUCCESS;
    }
}