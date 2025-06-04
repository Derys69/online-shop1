@extends('layouts.app')

@section('content')
<h1>BangunanKu</h1>
<div class="card bg-dark text-light border-secondary mb-4">
    <div class="card-body">
        <p class="card-text">
            Bangunanku adalah toko bangunan terpercaya yang menyediakan berbagai kebutuhan konstruksi dan renovasi rumah,
            mulai dari bahan bangunan seperti semen, pasir, batu bata, hingga peralatan pertukangan dan kelistrikan.
            Dengan komitmen pada kualitas dan pelayanan, Bangunanku hadir sebagai solusi lengkap untuk para kontraktor,
            tukang, maupun pemilik rumah yang ingin membangun atau memperbaiki bangunan mereka. Tersedia juga layanan
            pemesanan online dan pengantaran cepat langsung ke lokasi proyek.  
            <br><br>
            <strong>Bangunanku – Bangun Lebih Mudah, Cepat, dan Terpercaya.</strong>
        </p>
    </div>
</div>
<h2>Hubungi Kami</h2>
<p>Email: admink@bangunanku.com</p>
<p>Telepon: 0812-3456-7890</p>
<a href="{{ route('products') }}" class="btn btn-success mt-3">Lihat Produk</a>
@endsection
