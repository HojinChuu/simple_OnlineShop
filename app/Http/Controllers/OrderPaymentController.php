<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Services\CartService;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public $cartService;

    // 의존성 주입
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

    public function create(Order $order)
    {
        return view('payments.create')->with([
            'order' => $order
        ]);
    }

    public function store(Request $request, Order $order)
    {
        //PaymentService::handlePayment();

        // 장바구니 초기화
        $this->cartService->getFromCookie()->products()->detach();

        $order->payment()->create([
            'amount' => $order->total,
            'payed_at' => now()
        ]);

        $order->status = 'payed';
        $order->save();

        return redirect()->route('main')->withSuccess("Thank! We received your {$order->total} payment !");
    }
}
