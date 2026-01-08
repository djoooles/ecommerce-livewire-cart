<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\LowStockNotification;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $user = Auth::user();

        if ($product->isLowStock()) {
        LowStockNotification::dispatch($product);
}
        
        // Pronađi korisnikovu korpu ili kreiraj novu
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        
        // Proveri da li proizvod već postoji u korpi
        $cartItem = $cart->cartItems()->where('product_id', $product->id)->first();

        if ($product->stock_quantity <= 5 && $product->stock_quantity > 0) {
    LowStockNotification::dispatch($product);
}
        
        if ($cartItem) {
            // Ako postoji, povećaj količinu
            $cartItem->increment('quantity');
        } else {
            // Ako ne postoji, kreiraj novi
            $cart->cartItems()->create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

         if ($product->stock_quantity <= 0) {
        return redirect()->back()->with('error', 'Product is out of stock!');
    }
        $cart = Cart::firstOrCreate(
        ['user_id' => $user->id],
        ['user_id' => $user->id]
        );
        
        // Smanji količinu na stanju
        $product->decrement('stock_quantity');
        
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    
    
    
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('cartItems.product')->first();
        
        if (!$cart) {
            $cartItems = collect();
            $total = 0;
        } else {
            $cartItems = $cart->cartItems;
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
        }
        
        return view('cart', compact('cartItems', 'total'));
    }
    
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        

        
        $oldQuantity = $cartItem->quantity;
        $newQuantity = $request->quantity;
        
        // Ažuriranj količinu\\\\\
        $cartItem->update(['quantity' => $newQuantity]);
        
        
        $difference = $newQuantity - $oldQuantity;
        if ($difference != 0) {
            $cartItem->product->decrement('stock_quantity', $difference);
        }
        
        return redirect()->back()->with('success', 'Cart updated!');

        if ($product->stock_quantity <= 5 && $product->stock_quantity > 0) {
    LowStockNotification::dispatch($product);
}
    }
               //nastavljam ovde\\\
    public function remove(CartItem $cartItem)
    {
       
        $cartItem->product->increment('stock_quantity', $cartItem->quantity);
        
        
        $cartItem->delete();
        
        return redirect()->back()->with('success', 'Item removed from cart!');
    }
    
}