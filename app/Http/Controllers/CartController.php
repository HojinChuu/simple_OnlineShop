<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Services\CartService;

class CartController extends Controller
{
    public $cartService;

    // 의존성 주입
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getFromCookie();

        return view('carts.index')->with([
            'cart' => $cart
        ]);
    }
}
