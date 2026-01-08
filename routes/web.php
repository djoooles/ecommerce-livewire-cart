<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;



// Public routes
Route::view('/', 'welcome');
Route::get('/about', function() {
    return view('about');
})->name('about');

// API Routes (za quick view)
Route::get('/api/products/{product}', function(\App\Models\Product $product) {
    return response()->json($product);
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::view('dashboard', 'dashboard')
        ->name('dashboard');
    
    // Profile
    Route::view('profile', 'profile')
        ->name('profile');
    
    // Products - sada sa search i sort
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
    // Wishlist rute (ako implementirate)
    Route::post('/wishlist/toggle/{product}', [ProductController::class, 'toggleWishlist'])->name('wishlist.toggle');
    
    // Cart rute
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');


// Wishlist rute
Route::middleware(['auth'])->group(function () {
    Route::post('/wishlist/toggle/{product}', [ProductController::class, 'toggleWishlist'])
        ->name('wishlist.toggle');
    Route::get('/wishlist', [ProductController::class, 'wishlist'])
        ->name('wishlist.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
});
// Breeze auth routes
require __DIR__.'/auth.php';