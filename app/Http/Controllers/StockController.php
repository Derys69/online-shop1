<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        return view('products.stock', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products._edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('stock.index')->with('success', 'Stok produk diperbarui.');
    }
}
