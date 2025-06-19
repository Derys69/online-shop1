@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">🛒 Keranjang Belanja</h2>

    @if ($items->isEmpty())
        <div class="alert alert-warning">
            Keranjang Anda kosong. Yuk mulai belanja!
        </div>
        <a href="{{ route('products') }}" class="btn btn-primary">Lihat Produk</a>
    @else
        <div class="row">
            <div class="col-md-8">
                <table class="table table-dark table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Subtotal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('cart.update', $item->product) }}" class="d-flex justify-content-center align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control form-control-sm w-50" min="1">
                                        <button type="submit" class="btn btn-sm btn-outline-light ms-2">Ubah</button>
                                    </form>
                                </td>
                                <td class="text-end">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('cart.remove', $item->product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark text-light border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">💰 Ringkasan Pembayaran</h5>
                        <p>Total Produk: <strong>Rp {{ number_format($items->sum(fn($i) => $i->product->price * $i->quantity), 0, ',', '.') }}</strong></p>
                        <p>Ongkos Kirim: <strong>Rp 0</strong></p>
                        <hr>
                        <h4>Total: <strong class="text-success">Rp {{ number_format($items->sum(fn($i) => $i->product->price * $i->quantity), 0, ',', '.') }}</strong></h4>

                        <a href="{{ route('checkout') }}" class="btn btn-success w-100 mt-3">
                            🧾 Checkout Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
