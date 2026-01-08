@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <!-- Product Image -->
            <div class="md:w-1/2 p-8">
                <div class="h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             class="h-full w-full object-cover rounded-lg">
                    @else
                        <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    @endif
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="md:w-1/2 p-8">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                    
                    <!-- Wishlist Button -->
                    @auth
                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 {{ $isInWishlist ? 'text-red-600' : 'text-gray-400 hover:text-red-500' }}">
                            <i class="{{ $isInWishlist ? 'fas' : 'far' }} fa-heart text-2xl"></i>
                        </button>
                    </form>
                    @endauth
                </div>
                
                <div class="mb-6">
                    <span class="text-4xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                    @if($product->price < 500)
                        <span class="ml-2 text-lg text-gray-500 line-through">
                            ${{ number_format($product->price * 1.2, 2) }}
                        </span>
                    @endif
                </div>
                
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-700 mb-2">Description</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                </div>
                
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-gray-700">Availability</span>
                        @if($product->stock_quantity > 0)
                            <span class="text-green-600 font-bold">In Stock ({{ $product->stock_quantity }} available)</span>
                        @else
                            <span class="text-red-600 font-bold">Out of Stock</span>
                        @endif
                    </div>
                    
                    @if($product->stock_quantity > 0)
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" 
                             style="width: {{ min(($product->stock_quantity / 50) * 100, 100) }}%">
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Add to Cart Form -->
                @if($product->stock_quantity > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="flex items-center mb-4">
                        <span class="mr-4 font-semibold text-gray-700">Quantity:</span>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" 
                               class="w-20 border border-gray-300 rounded px-3 py-2 text-center">
                    </div>
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 
                                   transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                    </button>
                </form>
                @endif
                
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection