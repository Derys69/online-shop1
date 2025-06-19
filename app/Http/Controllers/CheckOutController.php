<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

class CheckOutController extends Controller
{
    public function form()
    {
        return view('checkout.form');
    }

    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'payment_method' => 'required',
        ]);

        $items = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => auth()->id(),
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total' => $total
        ]);

        foreach ($items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('orders')->with('success', 'Pesanan berhasil!');
    }
}
