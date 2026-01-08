<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-6">Welcome to E-commerce Cart</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="font-bold text-lg mb-2">Browse Products</h3>
                            <p class="text-gray-600 mb-4">View all available products and add them to your cart.</p>
                            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                View Products →
                            </a>
                        </div>
                        
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="font-bold text-lg mb-2">Your Cart</h3>
                            <p class="text-gray-600 mb-4">Manage items in your shopping cart.</p>
                            <a href="{{ route('cart.index') }}" class="text-green-600 hover:text-green-800 font-medium">
                                View Cart →
                            </a>
                        </div>
                        
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <h3 class="font-bold text-lg mb-2">About</h3>
                            <p class="text-gray-600 mb-4">Learn more about this application.</p>
                            <a href="/about" class="text-purple-600 hover:text-purple-800 font-medium">
                                About Page →
                            </a>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="font-bold text-xl mb-4">Recent Activity</h3>
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="text-gray-600">You're logged in! Start shopping by browsing products.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>