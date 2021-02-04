<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    public function index()
    {
        \Stripe\Stripe::setApiKey('sk_test_51IF2tuHGNaMt5HmwgPYIKTGA3FttMFzSAkKd1y5osEzFKPHe3yDoUgagSZnjSrBNLXGlgVb3CL6I6JVtFbw61pa6004YjnhcDT');
        
        $product = \Stripe\Product::all();

        $price = \Stripe\Price::all();

        
        dd($price, $product);

        return view('home', [
            'product' => $product,
            'price' => $price,
        ]);

    }

}
