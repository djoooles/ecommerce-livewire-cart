<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class ShoppingCart extends Component
{
    public $cart;
    public $total = 0;
    
    protected $listeners = ['cart-updated' => 'updateCart'];
    
    public function mount()
    {
        $this->updateCart();
    }
    
    public function updateCart()
    {
         $userId = Auth::id(); // OVO JE DOBRO
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        
        if ($this->cart) {
            $this->cart->load('products');
            $this->total = $this->calculateTotal();
        }
    }
    
    public function calculateTotal()
    {
        $total = 0;
        if ($this->cart && $this->cart->products) {
            foreach ($this->cart->products as $product) {
                $total += $product->price * $product->pivot->quantity;
            }
        }
        return $total;
    }
    
    public function removeItem($productId)
    {
        if (!$this->cart) return;
        
        $product = Product::findOrFail($productId);
        
        // Get quantity before removing
        $quantity = $this->cart->products()
            ->where('product_id', $productId)
            ->first()
            ->pivot
            ->quantity;
        
        // Remove from cart
        $this->cart->products()->detach($productId);
        
        // Restore stock
        $product->increment('stock_quantity', $quantity);
        
        $this->updateCart();
        session()->flash('success', 'Product removed from cart!');
    }
    
    public function updateQuantity($productId, $quantity)
    {
        if (!$this->cart || $quantity < 1) return;
        
        $product = Product::findOrFail($productId);
        $currentItem = $this->cart->products()
            ->where('product_id', $productId)
            ->first();
        
        if (!$currentItem) return;
        
        $currentQuantity = $currentItem->pivot->quantity;
        $difference = $quantity - $currentQuantity;
        
        // Check stock if increasing quantity
        if ($difference > 0 && $product->stock_quantity < $difference) {
            session()->flash('error', 'Not enough stock available!');
            return;
        }
        
        // Update cart quantity
        $this->cart->products()->updateExistingPivot($productId, [
            'quantity' => $quantity
        ]);
        
        // Update stock
        if ($difference != 0) {
            $product->decrement('stock_quantity', $difference);
        }
        
        $this->updateCart();
        session()->flash('success', 'Quantity updated!');
    }
    
    public function render()
    {
        return view('livewire.shopping-cart');
    }
}