@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">🧾 Checkout Pembelian</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card bg-dark text-light border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">📦 Alamat Pengiriman</h5>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address" class="form-control" rows="4" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="COD">COD (Bayar di Tempat)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-dark text-light border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">🛒Keranjang Belanja</h5>
                        @php
                            $items = \App\Models\Cart::with('product')->where('user_id', auth()->id())->get();
                            $total = $items->sum(fn($item) => $item->product->price * $item->quantity);
                        @endphp

                        <ul class="list-group mb-3">
                            @foreach ($items as $item)
                                <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                                    <div>
                                        {{ $item->product->name }} <small>x{{ $item->quantity }}</small>
                                    </div>
                                    <div>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</div>
                                </li>
                            @endforeach
                        </ul>

                        <h5 class="text-end">Total: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></h5>

                        <button type="submit" class="btn btn-success w-100 mt-3">
                            💳 Proses Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
