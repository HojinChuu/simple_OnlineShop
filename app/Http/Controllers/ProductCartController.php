<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductCartController extends Controller
{
    public $cartService;

    // 의존성 주입
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    
    public function store(Request $request, Product $product)
    {
        $cart = $this->cartService->getFromCookieOrCreate();

        $quantity = $cart->products()
            ->find($product->id)->pivot->quantity ?? 0;

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity + 1]
        ]);

        $cookie = $this->cartService->makeCookie($cart);

        return redirect()->back()->cookie($cookie);
    }

    public function destroy(Product $product, Cart $cart)
    {
        $cart->products()->detach($product->id);

        $cookie = $this->cartService->makeCookie($cart);

        return redirect()->back()->cookie($cookie);
    }
}
