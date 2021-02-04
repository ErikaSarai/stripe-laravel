<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    public function index()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51IF2tuHGNaMt5HmwgPYIKTGA3FttMFzSAkKd1y5osEzFKPHe3yDoUgagSZnjSrBNLXGlgVb3CL6I6JVtFbw61pa6004YjnhcDT'
          );
          $stripe->skus->all();

          dd($stripe);

        return view('dashboard');
    }

}
