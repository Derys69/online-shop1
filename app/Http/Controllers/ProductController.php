<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = collect(range(1, 20))->map(function ($i) {
            return [
                'id' => $i,
                'name' => "Product $i",
                'description' => "Deskripsi untuk produk $i",
                'price' => rand(10000, 100000),
            ];
        });

        return view('products.list', compact('products'));
    }

    public function create()
    {
        return view('products.form');
        
    }

public function store(Request $request)
    {
        return redirect()->route('products');
    }

    public function edit($id)
    {
        $product = (object)[
            'id' => $id,
            'name' => "Product $id",
            'description' => "Edit description for product $id",
            'price' => rand(1000, 10000),
        ];

        return view('products.form', compact('product'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('products')->with('success', 'Product updated!');
    }

    public function show($id)
    {   
        return (object) [
            'id' => $id,
            'name' => "Product $id",
            'description' => "Detail of product $id",
            'price' => rand(1000, 10000),
     ];
    }
}

