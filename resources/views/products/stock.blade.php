@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Pengaturan Stok Produk</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('stock.edit', $product->id) }}" class="btn btn-sm btn-primary">
                        Edit Stok
                    </a>
                </td>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
