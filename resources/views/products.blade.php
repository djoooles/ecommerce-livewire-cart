@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Products</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    <!-- Search and Sort Controls -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Search Form -->
            <form action="{{ route('products.index') }}" method="GET" class="flex-grow">
                <div class="flex">
                    <input type="text" name="q" value="{{ request('q') }}" 
                           placeholder="Search products by name or description..." 
                           class="w-full border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-r-lg hover:bg-blue-700 transition-colors">
                        Search
                    </button>
                    @if(request('q'))
                        <a href="{{ route('products.index') }}" 
                           class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition-colors">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
            
            <!-- Sort Dropdown -->
            <div class="flex items-center space-x-2">
                <span class="text-gray-600 font-medium">Sort by:</span>
                <form action="{{ route('products.index') }}" method="GET" class="inline">
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif
                    <select name="sort" onchange="this.form.submit()" 
                            class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>
                            Newest First
                        </option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                            Price: Low to High
                        </option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                            Price: High to Low
                        </option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>
                            Name A-Z
                        </option>
                        <option value="stock_high" {{ request('sort') == 'stock_high' ? 'selected' : '' }}>
                            Stock: High to Low
                        </option>
                        <option value="stock_low" {{ request('sort') == 'stock_low' ? 'selected' : '' }}>
                            Stock: Low to High
                        </option>
                    </select>
                </form>
            </div>
        </div>
        
        <!-- Search Results Info -->
        @if(request('q'))
            <div class="mt-3">
                <p class="text-gray-600">
                    Search results for: "<span class="font-semibold">{{ request('q') }}</span>"
                    @if(isset($products) && $products->count() > 0)
                        <span class="ml-2 text-green-600">
                            ({{ $products->count() }} {{ Str::plural('product', $products->count()) }} found)
                        </span>
                    @endif
                </p>
            </div>
        @endif
    </div>
    
    <!-- Products Grid -->
    @if(isset($products) && $products->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <!-- Product Badges -->
                    <div class="flex justify-between items-start mb-3">
                        @if($product->isOutOfStock())
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                Out of Stock
                            </span>
                        @elseif($product->isLowStock())
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                Low Stock ({{ $product->stock_quantity }} left)
                            </span>
                        @else
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                In Stock
                            </span>
                        @endif
                        
                        <!-- Sale Badge Example -->
                        @if($product->price < 500)
                            <span class="bg-red-600 text-white text-xs font-bold px-2.5 py-0.5 rounded">
                                SALE
                            </span>
                        @endif
                    </div>
                    
                    <!-- Product Name -->
                    <h3 class="font-bold text-xl text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                        {{ $product->name }}
                    </h3>
                    
                    <!-- Product Description -->
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        {{ $product->description }}
                    </p>
                    
                    <!-- Price and Stock Info -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <span class="font-bold text-2xl text-gray-900">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            @if($product->price < 500)
                                <span class="ml-2 text-sm text-gray-500 line-through">
                                    ${{ number_format($product->price * 1.2, 2) }}
                                </span>
                            @endif
                        </div>
                        
                        <!-- Stock Progress Bar -->
                        <div class="text-right">
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                @if($product->isInStock())
                                    <div class="bg-{{ $product->isLowStock() ? 'yellow' : 'green' }}-500 h-2 rounded-full" 
                                         style="width: {{ min(($product->stock_quantity / 30) * 100, 100) }}%">
                                    </div>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $product->stock_quantity }} in stock
                            </p>
                        </div>
                    </div>
                    
                    <!-- Add to Cart Form -->
                    <form method="POST" action="{{ route('cart.add', $product) }}">
                        @csrf
                        <button type="submit" 
                                class="w-full px-4 py-3 text-white rounded-lg font-medium transition-all duration-200
                                       {{ $product->isInStock() 
                                          ? 'bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2' 
                                          : 'bg-gray-400 cursor-not-allowed' }}"
                                {{ $product->isOutOfStock() ? 'disabled' : '' }}>
                            @if($product->isInStock())
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add to Cart
                                </span>
                            @else
                                Out of Stock
                            @endif
                        </button>
                    </form>
                    
                   <!-- Quick Actions -->
<div class="mt-4 flex justify-between text-sm">
    <button onclick="openQuickView({{ $product->id }})" 
            class="text-blue-600 hover:text-blue-800 font-medium">
        Quick View
    </button>
    <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="text-gray-400 hover:text-red-500">
            <span class="text-xl">♡</span> Wishlist
        </button>
    </form>
</div>
                </div>
            @endforeach
        </div>
        
        <!-- No Results Message -->
    @else
        <div class="text-center py-16 bg-white rounded-lg shadow">
            <div class="mx-auto w-24 h-24 text-gray-400 mb-4">
                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No products found</h3>
            <p class="text-gray-500 mb-6">
                @if(request('q'))
                    No products match your search "{{ request('q') }}"
                @else
                    No products available at the moment.
                @endif
            </p>
            @if(request('q'))
                <a href="{{ route('products.index') }}" 
                   class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    View All Products
                </a>
            @endif
        </div>
    @endif
</div>

<!-- Quick View Modal -->
<div id="quickViewModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-96 shadow-lg rounded-md bg-white">
        <div id="quickViewContent" class="py-4">
            <!-- Content will be loaded here -->
        </div>
        <div class="flex justify-end mt-6">
            <button onclick="closeQuickView()" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded transition-colors">
                Close
            </button>
        </div>
    </div>
</div>

<script>
// Quick View Modal Functions
function openQuickView(productId) {
    fetch(`/api/products/${productId}`)
        .then(response => response.json())
        .then(product => {
            document.getElementById('quickViewContent').innerHTML = `
                <h3 class="text-2xl font-bold text-gray-900 mb-3">${product.name}</h3>
                <p class="text-gray-600 mb-4">${product.description}</p>
                <div class="mb-4">
                    <span class="text-3xl font-bold text-gray-900">$${parseFloat(product.price).toFixed(2)}</span>
                </div>
                <div class="mb-4">
                    <span class="font-medium text-gray-700">Stock:</span>
                    <span class="ml-2 ${product.stock_quantity <= 5 ? 'text-red-600 font-bold' : 'text-green-600'}">
                        ${product.stock_quantity} available
                    </span>
                </div>
                <form method="POST" action="/cart/add/${product.id}" class="mt-6">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors
                                   ${product.stock_quantity <= 0 ? 'opacity-50 cursor-not-allowed' : ''}"
                            ${product.stock_quantity <= 0 ? 'disabled' : ''}>
                        ${product.stock_quantity <= 0 ? 'Out of Stock' : 'Add to Cart'}
                    </button>
                </form>
            `;
            document.getElementById('quickViewModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('quickViewContent').innerHTML = `
                <p class="text-red-600">Error loading product details.</p>
            `;
        });
}

function closeQuickView() {
    document.getElementById('quickViewModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('quickViewModal').addEventListener('click', function(e) {
    if (e.target.id === 'quickViewModal') {
        closeQuickView();
    }
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection