

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Your Shopping Cart</h1>
    
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
    
    @if($cart && $cart->products->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cart->products as $product)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500">{{ $product->description }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">${{ number_format($product->price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <button 
                                        wire:click="updateQuantity({{ $product->id }}, {{ $product->pivot->quantity - 1 }})"
                                        class="bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-300"
                                        {{ $product->pivot->quantity <= 1 ? 'disabled' : '' }}
                                    >-</button>
                                    <span class="text-sm font-medium w-8 text-center">{{ $product->pivot->quantity }}</span>
                                    <button 
                                        wire:click="updateQuantity({{ $product->id }}, {{ $product->pivot->quantity + 1 }})"
                                        class="bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-300"
                                    >+</button>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    ${{ number_format($product->price * $product->pivot->quantity, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <button 
                                    wire:click="removeItem({{ $product->id }})"
                                    class="text-red-600 hover:text-red-900 text-sm font-medium"
                                >
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="px-6 py-4 bg-gray-50 border-t">
                <div class="flex justify-between items-center">
                    <div class="text-lg font-bold">Total: ${{ number_format($total, 2) }}</div>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
        
        <div class="mt-6">
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                ← Continue Shopping
            </a>
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 text-6xl mb-4">🛒</div>
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-6">Add some products to your cart!</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium">
                Browse Products
            </a>
        </div>
    @endif
</div>