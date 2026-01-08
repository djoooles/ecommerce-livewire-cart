<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js with navigate plugin -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/navigate@3.13.8/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.8/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
        @auth
<li class="relative">
    <a href="{{ route('wishlist.index') }}" class="px-3 py-2 text-gray-700 hover:text-gray-900 flex items-center">
        <i class="fas fa-heart mr-1"></i>
        Wishlist
        @if(auth()->user()->wishlists()->count() > 0)
        <span class="ml-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
            {{ auth()->user()->wishlists()->count() }}
        </span>
        @endif
    </a>
</li>
@endauth
        <script>
            // Inicijalizujte Alpine.js
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Alpine) {
                    window.Alpine.start();
                }
            });
        </script>
    </body>
</html>