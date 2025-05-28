@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Produk</h2>
        <a class="btn btn-primary" href="{{ route('products.create') }}" role="button">Add new product</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>gi
            </tr>
        </thead>
        <tbody>               
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['id'] }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['description'] }}</td>
                        <td>Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                    </tr>  
                @endforeach
        </tbody>
    </table>
</div>
@endsection