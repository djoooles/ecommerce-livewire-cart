<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'stock_quantity',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];

    
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * nastavljam posle posla ovde
     *
     * @return bool
     */
    public function isLowStock(): bool
     {
        return $this->stock_quantity <= 5;
    }

    
    public function carts()
     {
        return $this->belongsToMany(Cart::class, 'cart_items')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
    public function isInStock(): bool
     {
         return $this->stock_quantity > 0;
    }

     public function isOutOfStock(): bool
    {
        return $this->stock_quantity <= 0;
     }
     public function wishlistedBy()
{
    return $this->belongsToMany(User::class, 'wishlists')
                ->withTimestamps();
}

public function isWishlistedByUser($userId = null)
{
    if (Auth::check()) {
    $userId = Auth::id();
}
    
    return $this->wishlistedBy()->where('user_id', $userId)->exists();
}
public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}

//zavrsen 
}