@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Produk Baru</h2>
    <form method="POST" action="{{ route('products.store') }}">
        @include('products._form', ['product' => new \App\Models\Product(), 'categories' => $categories])
    </form>
</div>
@endsection
