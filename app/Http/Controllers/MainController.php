<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // $products = Product::available()->get();
        $products = Product::all();
        
        return view('welcome')->with([
            'products' => $products
        ]);
    }
}
