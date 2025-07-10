@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Stok Produk: {{ $product->name }}</h2>

    <form method="POST" action="{{ route('stock.update', $product->id) }}">
        @csrf
        <div class="mb-3">
            <label for="stock" class="form-label">Jumlah Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('stock.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
