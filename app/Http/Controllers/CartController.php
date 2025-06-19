<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
public function index() {
    $items = Cart::with('product')->where('user_id', auth()->id())->get();
    $subtotal = $items->sum(fn($item) => $item->product->price * $item->quantity);
    return view('cart.index', compact('items', 'subtotal'));
}

public function add(Request $request, Product $product) {
    $item = Cart::firstOrNew(['user_id' => auth()->id(), 'product_id' => $product->id]);
    $item->quantity += $request->get('quantity', 1);
    $item->save();
    return back()->with('success', 'Produk ditambahkan ke keranjang.');
}

public function update(Request $request, Product $product) {
    Cart::where('user_id', auth()->id())->where('product_id', $product->id)
        ->update(['quantity' => $request->quantity]);
    return back();
}

public function remove(Product $product) {
    Cart::where('user_id', auth()->id())->where('product_id', $product->id)->delete();
    return back();
}
}