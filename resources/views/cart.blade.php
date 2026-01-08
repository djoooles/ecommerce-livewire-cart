@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Shopping Cart</h1>
    
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
    
    @if($cartItems->count())
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cartItems as $cartItem)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $cartItem->product->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">${{ number_format($cartItem->product->price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('cart.update', $cartItem) }}" method="POST" class="inline">
                                @csrf
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="w-16 text-center border rounded py-1">
                                <button type="submit" class="ml-2 text-blue-600 hover:text-blue-800">Update</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">${{ number_format($cartItem->quantity * $cartItem->product->price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                           <form action="{{ route('cart.remove', $cartItem) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')  <!-- DODAJTE OVO jer je ruta DELETE -->
    <button type="submit" class="text-red-600 hover:text-red-800">Remove</button>
</form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50">
                        <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900">Total:</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">${{ number_format($total, 2) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="mt-6">
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 mr-4">Continue Shopping</a>
            <button class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Checkout
            </button>
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Your cart is empty.</p>
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 mt-4 inline-block">
                Browse Products
            </a>
        </div>
    @endif
</div>

 <!-- DODATAK: Wishlist sekcija -->
    @if(auth()->check() && auth()->user()->wishlists()->count())
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">My Wishlist</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                @foreach(auth()->user()->wishlistProducts as $wishlistProduct)
                <div class="bg-white rounded-lg shadow p-4 flex justify-between items-center">
                    <div>
                        <h3 class="font-medium">{{ $wishlistProduct->name }}</h3>
                        <p class="text-gray-600">${{ number_format($wishlistProduct->price, 2) }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <form action="{{ route('wishlist.toggle', $wishlistProduct) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Remove from wishlist">
                                <i class="fas fa-heart"></i>
                            </button>
                        </form>
                        <form action="{{ route('cart.add', $wishlistProduct) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="text-blue-600 hover:text-blue-800" title="Add to cart">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif
    
@endsection