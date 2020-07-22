<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome')->with([
            'products' => Product::all(),
        ]);
    }
}
