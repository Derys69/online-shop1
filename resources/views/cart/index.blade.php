@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🛒 Keranjang Belanja</h2>

    @if($items->isEmpty())
        <div class="alert alert-info">Keranjang Anda masih kosong.</div>
        <a href="{{ route('products') }}" class="btn btn-primary">Kembali Belanja</a>
    @else
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-dark table-bordered align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->product->name }}</strong>
                                <br>
                                <small>Rp {{ number_format($item->product->price, 0, ',', '.') }}</small>
                            </td>
                            <td style="width: 150px">
                                <form method="POST" action="{{ route('cart.update', $item->product) }}" class="d-flex">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm me-2">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Ubah</button>
                                </form>
                            </td>
                            <td>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', $item->product) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-light border-secondary">
                <div class="card-header bg-secondary">
                    <h5 class="mb-0">Info Pembelian</h5>
                </div>
                <div class="card-body">
                    <p>Total Produk: <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong></p>
                    <a href="{{ route('checkout.form') }}" class="btn btn-success w-100">
                        <i class="bi bi-credit-card"></i> Checkout Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
