<?php

namespace App\Http\Controllers;

  use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Prikazi about stranicu
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Vracamo about view sa podacima o aplikaciji
        $appInfo = [
            'name' => 'E-commerce Shopping Cart',
            'version' => '1.0.0',
              'description' => 'Jednostavna e-commerce aplikacija za praksu u Laravel-u.',
            'features' => [
                'Korisnicka autentifikacija',
                'Listanje produkata',
                 'Dodavanje u korpu',
                'Azuriranje kolicine',
                'Low stock notifikacije',
                'Daily sales report'
            ],
            'tech' => [
                 'Laravel 10',
                'Livewire',
                'Tailwind CSS',
                 'SQLite'
            ]
        ];
        
    
        return view('about', compact('appInfo'));
    }
}