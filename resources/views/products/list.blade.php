@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Produk</h2>
        <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterForm">
    🔍 Filter / Cari Produk
        </button>
        <a class="btn btn-primary" href="{{ route('products.create') }}" role="button">Add new product</a>
    </div>

<!-- tombol search nanti di pindah ke widget -->
<div class="collapse mb-4" id="filterForm">
    <form method="GET" action="{{ route('products') }}">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari produk...">
            </div>
            <div class="col-md-2">
                <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control" placeholder="Harga min">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control" placeholder="Harga max">
            </div>
            <div class="col-md-2">
                <select name="sort_by" class="form-select">
                    <option value="">Urutkan</option>
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nama</option>
                    <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="sort_order" class="form-select">
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Naik</option>
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Turun</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-secondary w-100">Cari</button>
            </div>
        </div>
    </form>
</div>
</form>
    <!--ProdukWidget -->            
<div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse ($products as $product)
            <div class="col">
                <div class="card h-100 bg-dark text-light border-secondary">
                    <img src="{{ asset('images/product_default.png') }}" class="card-img-top" alt="Gambar Produk">
                    <div class="card-body">
                        <p><strong>Product:</strong> {{ $product->name }}</p>
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                        <small>Kategori: {{ $product->category->name ?? '-' }}</small>
                        <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-warning">Tidak ada produk ditemukan.</div>
            </div>
        @endforelse
    </div>
</div>
        </tbody>
    </table>
</div>
@endsection
