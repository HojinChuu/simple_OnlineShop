<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\CartService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function create()
    {
        $cart = $this->cartService->getFromCookie();
        
        if(!isset($cart) || $cart->products->isEmpty()) {
            return redirect()->back()->withErrors('Your Cart is Empty');
        }

        return view('orders.create')->with([
            'cart' => $cart
        ]);
    }

    public function store(Request $request)
    {
        
    }
}
