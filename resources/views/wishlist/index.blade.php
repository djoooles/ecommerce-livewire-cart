@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Wishlist</h1>
        <div class="flex items-center space-x-4">
            @if($wishlistProducts->count() > 0)
                <span class="text-gray-600">
                    {{ $wishlistProducts->count() }} {{ Str::plural('item', $wishlistProducts->count()) }}
                </span>
            @endif
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-1"></i> Continue Shopping
            </a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif
    
    @if($wishlistProducts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($wishlistProducts as $product)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                    <!-- Wishlist remove button - top right -->
                    <div class="absolute top-3 right-3 z-10">
                        <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 bg-white rounded-full shadow-md hover:shadow-lg 
                                    text-red-600 hover:text-red-700 transition-all duration-200">
                                <i class="fas fa-heart text-lg"></i>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Product Image Placeholder -->
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="h-full w-full object-cover">
                        @else
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        @endif
                    </div>
                    
                    <!-- Product Details -->
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-900 mb-2 line-clamp-1">
                            {{ $product->name }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            {{ $product->description }}
                        </p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xl font-bold text-gray-900">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            
                            @if($product->stock_quantity > 0)
                                <span class="text-sm px-2 py-1 bg-green-100 text-green-800 rounded">
                                    In Stock
                                </span>
                            @else
                                <span class="text-sm px-2 py-1 bg-red-100 text-red-800 rounded">
                                    Out of Stock
                                </span>
                            @endif
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            @if($product->stock_quantity > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" 
                                        class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 
                                               transition-colors duration-200 flex items-center justify-center">
                                    <i class="fas fa-cart-plus mr-2"></i>
                                    Add to Cart
                                </button>
                            </form>
                            @endif
                            
                            <a href="{{ route('products.show', $product) }}" 
                               class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200 
                                      transition-colors duration-200 flex items-center">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $wishlistProducts->links() }}
        </div>
        
        <!-- Empty Wishlist Message -->
        @else
        <div class="text-center py-16 bg-white rounded-lg shadow">
            <div class="mx-auto w-24 h-24 text-gray-400 mb-4">
                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-semibold text-gray-700 mb-3">Your wishlist is empty</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">
                Start adding products you love to your wishlist. They'll be saved here for you to view or purchase later.
            </p>
            <div class="space-x-4">
                <a href="{{ route('products.index') }}" 
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 
                          transition-colors duration-200 font-medium">
                    <i class="fas fa-shopping-bag mr-2"></i> Browse Products
                </a>
                <a href="{{ route('cart.index') }}" 
                   class="inline-block bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 
                          transition-colors duration-200 font-medium">
                    <i class="fas fa-shopping-cart mr-2"></i> View Cart
                </a>
            </div>
        </div>
        @endif
</div>

<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.absolute {
    position: absolute;
}
</style>
@endsection