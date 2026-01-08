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
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="border rounded-lg p-4 shadow hover:shadow-lg transition-shadow">
                <h3 class="font-bold text-xl mb-2">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-3">{{ $product->description }}</p>
                <div class="flex justify-between items-center mb-4">
                    <span class="font-bold text-lg">${{ number_format($product->price, 2) }}</span>
                    <span class="text-sm {{ $product->stock_quantity < 5 ? 'text-red-600 font-bold' : 'text-green-600' }}">
                        Stock: {{ $product->stock_quantity }}
                    </span>
                </div>
                <button 
                    wire:click="addToCart({{ $product->id }})"
                    class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 {{ $product->stock_quantity <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}
                >
                    {{ $product->stock_quantity <= 0 ? 'Out of Stock' : 'Add to Cart' }}
                </button>
            </div>
        @endforeach
    </div>
    
    @if($products->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500">No products available.</p>
        </div>
    @endif
</div>