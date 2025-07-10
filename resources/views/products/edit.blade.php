@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Produk: {{ $product->name }}</h2>
    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @include('products._form', ['product' => $product, 'categories' => $categories, 'isEdit' => true])
    </form>
</div>
@endsection
