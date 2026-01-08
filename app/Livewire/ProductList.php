<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    public $products;
    
    public function mount()
    {
        $this->products = Product::all();
    }
    
    public function addToCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $product = Product::findOrFail($productId);
        
        //
        if ($product->stock_quantity <= 0) {
            session()->flash('error', 'Product out of stock!');
            return;
        }
        
        
          $userId = Auth::id(); 
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        
      
        $existingItem = $cart->products()->where('product_id', $productId)->first();
        
        if ($existingItem) {
           
            $cart->products()->updateExistingPivot($productId, [
                'quantity' => $existingItem->pivot->quantity + 1
            ]);
        } else {
            
            $cart->products()->attach($productId, ['quantity' => 1]);
        }
        
        
        $product->decrement('stock_quantity');
        
        
        $this->dispatch('cart-updated');
        
        session()->flash('success', 'Product added to cart!');
    }
    
    public function render()
    {
        return view('livewire.product-list');
    }
    ///ispravljene greske sve
}