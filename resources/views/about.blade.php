@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">E-commerce Shopping Cart Application</h1>
            <p class="text-xl text-gray-600">A full-featured e-commerce platform built with Laravel following best practices</p>
        </div>

        <!-- Project Overview -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8 border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 pb-4 border-b">📋 Project Overview</h2>
            <p class="text-gray-700 text-lg mb-6">
                This application is a complete e-commerce solution built as a practical task demonstration. 
                It implements all core e-commerce functionalities with special attention to Laravel best practices, 
                clean architecture, and modern development workflows.
            </p>
            
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">🎯 Project Requirements Met</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 me-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">User authentication with Laravel Breeze starter kit</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 me-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Complete shopping cart system with user association</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 me-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Low stock email notifications via Laravel Jobs</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 me-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Daily sales reports via scheduled tasks (cron)</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">🚀 Additional Features</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 me-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Wishlist functionality for authenticated users</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 me-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Advanced product search and sorting</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 me-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Responsive design with Tailwind CSS</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 me-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Real-time stock management</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Technical Implementation -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8 border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 pb-4 border-b">⚙️ Technical Implementation</h2>
            
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Backend</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full me-2"></span>
                            Laravel 10.x Framework
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full me-2"></span>
                            Eloquent ORM with Relationships
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full me-2"></span>
                            Queue Jobs for Email Notifications
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full me-2"></span>
                            Scheduled Tasks (Cron Jobs)
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full me-2"></span>
                            Laravel Breeze Authentication
                        </li>
                    </ul>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Database</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full me-2"></span>
                            SQLite for Development
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full me-2"></span>
                            MySQL/PostgreSQL Ready
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full me-2"></span>
                            Database Migrations
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full me-2"></span>
                            Seeders with Sample Data
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full me-2"></span>
                            Foreign Key Constraints
                        </li>
                    </ul>
                </div>
                
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Frontend</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-purple-500 rounded-full me-2"></span>
                            Blade Templating Engine
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-purple-500 rounded-full me-2"></span>
                            Tailwind CSS Framework
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-purple-500 rounded-full me-2"></span>
                            Responsive Design
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-purple-500 rounded-full me-2"></span>
                            FontAwesome Icons
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-purple-500 rounded-full me-2"></span>
                            Alpine.js for Interactivity
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Core Features Details -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8 border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 pb-4 border-b">🔧 Core Features Detailed</h2>
            
            <div class="space-y-8">
                <div class="flex items-start">
                    <div class="bg-red-100 p-3 rounded-lg me-4">
                        <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7-1.274 7-5.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Low Stock Notifications</h3>
                        <p class="text-gray-700 mb-2">
                            When product stock falls below threshold (5 units), an automated email notification 
                            is sent to admin via Laravel Jobs. This ensures timely restocking without manual monitoring.
                        </p>
                        <span class="inline-block bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full">Job/Queue Implementation</span>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-green-100 p-3 rounded-lg me-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Daily Sales Reports</h3>
                        <p class="text-gray-700 mb-2">
                            Automated scheduled task that runs daily at 6 PM, generating and sending comprehensive 
                            sales reports via email. Tracks all transactions, revenue, and top-selling products.
                        </p>
                        <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">Scheduled Tasks (Cron)</span>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-blue-100 p-3 rounded-lg me-4">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Shopping Cart System</h3>
                        <p class="text-gray-700 mb-2">
                            Persistent cart associated with authenticated users (not session-based). 
                            Users can add, update quantities, and remove items. Real-time stock validation 
                            prevents overselling.
                        </p>
                        <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">Database Persistence</span>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-purple-100 p-3 rounded-lg me-4">
                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Wishlist Functionality</h3>
                        <p class="text-gray-700 mb-2">
                            Extra feature allowing users to save favorite products for later. 
                            Wishlist items persist across sessions and can be easily moved to cart.
                        </p>
                        <span class="inline-block bg-purple-100 text-purple-800 text-sm px-3 py-1 rounded-full">Bonus Feature</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database Schema -->
        <div class="bg-gray-800 text-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-3xl font-bold mb-6 pb-4 border-b border-gray-700">🗃️ Database Schema</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-gray-300">
                    <thead class="border-b border-gray-700">
                        <tr>
                            <th class="pb-3 font-semibold">Table</th>
                            <th class="pb-3 font-semibold">Purpose</th>
                            <th class="pb-3 font-semibold">Relationships</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        <tr>
                            <td class="py-3 font-mono">users</td>
                            <td class="py-3">User authentication and profiles</td>
                            <td class="py-3">hasOne Cart, hasMany Wishlists</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono">products</td>
                            <td class="py-3">Product catalog with inventory</td>
                            <td class="py-3">belongsToMany Carts, hasMany Wishlists</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono">carts</td>
                            <td class="py-3">Shopping cart for each user</td>
                            <td class="py-3">belongsTo User, belongsToMany Products</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono">cart_product</td>
                            <td class="py-3">Pivot table for cart items with quantity</td>
                            <td class="py-3">belongsTo Cart, belongsTo Product</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono">wishlists</td>
                            <td class="py-3">User wishlist storage</td>
                            <td class="py-3">belongsTo User, belongsTo Product</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono">orders</td>
                            <td class="py-3">Purchase history (if implemented)</td>
                            <td class="py-3">belongsTo User, hasMany OrderItems</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Installation & Setup -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">🚀 Installation & Setup</h2>
            <div class="bg-gray-900 text-gray-100 p-6 rounded-lg mb-6 font-mono text-sm overflow-x-auto">
                <div class="mb-2">
                    <span class="text-green-400"># Clone the repository</span><br>
                    git clone https://github.com/yourusername/ecommerce-cart.git<br>
                    cd ecommerce-cart
                </div>
                <div class="mb-2">
                    <span class="text-green-400"># Install dependencies</span><br>
                    composer install<br>
                    npm install
                </div>
                <div class="mb-2">
                    <span class="text-green-400"># Configure environment</span><br>
                    cp .env.example .env<br>
                    php artisan key:generate
                </div>
                <div class="mb-2">
                    <span class="text-green-400"># Setup database</span><br>
                    php artisan migrate --seed
                </div>
                <div class="mb-2">
                    <span class="text-green-400"># Run queue worker (for notifications)</span><br>
                    php artisan queue:work
                </div>
                <div class="mb-2">
                    <span class="text-green-400"># Run scheduler (for daily reports)</span><br>
                    php artisan schedule:work
                </div>
                <div class="mb-2">
                    <span class="text-green-400"># Start development server</span><br>
                    php artisan serve
                </div>
            </div>
            
            <div class="text-center">
                <a href="{{ route('products.index') }}" 
                   class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    🛍️ Start Shopping
                </a>
                <a href="{{ route('dashboard') }}" 
                   class="ml-4 inline-block bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    📊 Go to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection