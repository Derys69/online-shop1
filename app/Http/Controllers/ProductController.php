<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Pencarian
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        // Filter harga
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Urutan
        if ($request->filled('sort_by')) {
            $sortOrder = $request->get('sort_order', 'asc');
            $query->orderBy($request->sort_by, $sortOrder);
        }

        $products = $query->get();
        return view('products.list', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $product = new Product();
        $isEdit = false;

        return view('products._form', compact('product', 'categories', 'isEdit'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'nullable|exists:categories,id',
        'new_category' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if (!empty($validated['new_category'])) {
        $category = Category::firstOrCreate(['name' => $validated['new_category']]);
        $validated['category_id'] = $category->id;
    }

    unset($validated['new_category']);

if ($request->hasFile('image')) {
    $filename = time() . '_' . $request->file('image')->getClientOriginalName();
    $request->file('image')->storeAs('public', $filename);
    $validated['image'] = $filename;
}


    $validated['stock'] = 0;

    Product::create($validated);

    return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan.');
}


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $isEdit = true;

        return view('products._form', compact('product', 'categories', 'isEdit'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Buat kategori baru jika diisi
        if (!empty($validated['new_category'])) {
            $category = Category::firstOrCreate(['name' => $validated['new_category']]);
            $validated['category_id'] = $category->id;
        }

        unset($validated['new_category']);

if ($request->hasFile('image')) {
    if ($product->image && Storage::exists('public/' . $product->image)) {
        Storage::delete('public/' . $product->image);
    }

    $filename = time() . '_' . $request->file('image')->getClientOriginalName();
    $request->file('image')->storeAs('public', $filename);
    $validated['image'] = $filename;
}


        $product->update($validated);

        return redirect()->route('products')->with('success', 'Produk berhasil diperbarui.');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }
}
