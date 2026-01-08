<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_items')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    /**
     * Calculate the total price of the cart.
     *
     * @return float
     */
    public function getTotalAttribute(): float
    {
        return $this->cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });
    }
    public function add(Product $product)
{
    
    if ($product->stock_quantity <= 0) {
        return redirect()->back()->with('error', 'Product is out of stock!');
    }
    
    $user = Auth::user();
    
    // Get or create user's cart
    $cart = Cart::firstOrCreate(
        ['user_id' => $user->id],
        ['user_id' => $user->id]
    );
    
    // ... 
}
}