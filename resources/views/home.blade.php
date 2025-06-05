@extends('layouts.app')

@section('content')
<h1>Selamat datang di Toko Kami</h1>
<div class="d-flex gap-3 mt-4">
    <a href="{{ route('products') }}" class="btn btn-primary">Product</a>
    <a href="{{ route('contact') }}" class="btn btn-primary">About Us</a>
</div>


@endsection
