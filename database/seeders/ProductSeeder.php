<?php
namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    public function run(): void {
        $products = [
            ['name' => 'MacBook Pro 16"', 'price' => 2499.99, 'stock_quantity' => 5, 'description' => 'Apple MacBook Pro'],
            ['name' => 'iPhone 15 Pro', 'price' => 999.99, 'stock_quantity' => 15, 'description' => 'Apple iPhone'],
            ['name' => 'Samsung Galaxy S24', 'price' => 799.99, 'stock_quantity' => 20, 'description' => 'Samsung phone'],
            ['name' => 'Sony WH-1000XM5', 'price' => 349.99, 'stock_quantity' => 3, 'description' => 'Noise canceling headphones'],
            ['name' => 'iPad Air', 'price' => 599.99, 'stock_quantity' => 12, 'description' => 'Apple iPad'],
            ['name' => 'Logitech MX Master 3S','price' => 99.99,'stock_quantity' => 25,'description' => 'Wireless mouse for productivity',],
            ['name' => 'Dell XPS 13','price' => 1299.99,'stock_quantity' => 7,'description' => 'Dell premium laptop with Intel i7'],
            [
    'name' => 'PlayStation 5 Pro',
    'price' => 699.99,
    'stock_quantity' => 0, // Nema na stanju!
    'description' => 'Sony PlayStation 5 Pro - Coming Soon',
],
        ];
        
        foreach ($products as $product) {
            Product::create($product);
        }
    }
    
}