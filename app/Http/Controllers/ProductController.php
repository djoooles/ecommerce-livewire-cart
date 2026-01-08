<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        
        if ($request->has('q') && $request->q) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }
        
        //pretraga i sort
        $sort = $request->get('sort', 'newest');
        
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price');
                break;
            case 'price_high':
                $query->orderByDesc('price');
                break;
            case 'name':
                $query->orderBy('name');
                break;
            case 'stock_high':
                $query->orderByDesc('stock_quantity');
                break;
            case 'stock_low':
                $query->orderBy('stock_quantity');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }
        
        $products = $query->get();
        
        return view('products', compact('products'));
    }
    
    public function toggleWishlist(Product $product)
    {
        //  ///nastavljam ovde\\\
        $user = Auth::user();
        
        $wishlisted = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlisted) {
            $wishlisted->delete();
            return back()->with('success', 'Removed from wishlist');
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            return back()->with('success', 'Added to wishlist');
        }
    }
    
    public function wishlist()
    {
        $user = Auth::user();
        
        $wishlistProducts = $user->wishlistProducts()
            ->orderBy('wishlists.created_at', 'desc')
            ->paginate(12);
        
        return view('wishlist.index', compact('wishlistProducts'));
    }
    
    public function show(Product $product)
    {
        // KORISTICU Auth
        $isInWishlist = false;
        if (Auth::check()) {
            $isInWishlist = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists();
        }
        
        return view('products.show', compact('product', 'isInWishlist'));
    }
}