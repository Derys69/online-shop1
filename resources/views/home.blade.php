@extends('layouts.app')

@section('content')

<h1 class="mb-4">Selamat datang di Toko Kami</h1>

<style>
  .carousel-item img {
    max-height: 400px;
    object-fit: cover;
  }
</style>

<div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('images/banner1.png') }}" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner2.png') }}" class="d-block w-100" alt="Banner 2">
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Sebelumnya</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Berikutnya</span>
  </button>
</div>
<style>
  .carousel-item img {
    max-height: 400px;
    width: 100%;
    object-fit: contain;
  }
</style>
@endsection
