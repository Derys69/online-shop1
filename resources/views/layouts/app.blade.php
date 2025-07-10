<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>

[data-bs-theme=dark] {
  color-scheme: dark;
  --bs-body-color: #dee2e6;
  --bs-body-color-rgb: 222, 226, 230;
  --bs-body-bg: #161D26;
  --bs-body-bg-rgb: 33, 37, 41;
  --bs-emphasis-color: #fff;
  --bs-emphasis-color-rgb: 255, 255, 255;
  --bs-secondary-color: rgba(222, 226, 230, 0.75);
  --bs-secondary-color-rgb: 222, 226, 230;
  --bs-secondary-bg: #343a40;
  --bs-secondary-bg-rgb: 52, 58, 64;
  --bs-tertiary-color: rgba(222, 226, 230, 0.5);
  --bs-tertiary-color-rgb: 222, 226, 230;
  --bs-tertiary-bg: #2b3035;
  --bs-tertiary-bg-rgb: 43, 48, 53;
  --bs-primary-text-emphasis: #6ea8fe;
  --bs-secondary-text-emphasis: #a7acb1;
  --bs-success-text-emphasis: #75b798;
  --bs-info-text-emphasis: #6edff6;
  --bs-warning-text-emphasis: #ffda6a;
  --bs-danger-text-emphasis: #ea868f;
  --bs-light-text-emphasis: #f8f9fa;
  --bs-dark-text-emphasis: #dee2e6;
  --bs-primary-bg-subtle: #031633;
  --bs-secondary-bg-subtle: #161719;
  --bs-success-bg-subtle: #051b11;
  --bs-info-bg-subtle: #032830;
  --bs-warning-bg-subtle: #332701;
  --bs-danger-bg-subtle: #2c0b0e;
  --bs-light-bg-subtle: #343a40;
  --bs-dark-bg-subtle: #1a1d20;
  --bs-primary-border-subtle: #084298;
  --bs-secondary-border-subtle: #41464b;
  --bs-success-border-subtle: #0f5132;
  --bs-info-border-subtle: #087990;
  --bs-warning-border-subtle: #997404;
  --bs-danger-border-subtle: #842029;
  --bs-light-border-subtle: #495057;
  --bs-dark-border-subtle: #343a40;
  --bs-heading-color: inherit;
  --bs-link-color: #6ea8fe;
  --bs-link-hover-color: #8bb9fe;
  --bs-link-color-rgb: 110, 168, 254;
  --bs-link-hover-color-rgb: 139, 185, 254;
  --bs-code-color: #e685b5;
  --bs-highlight-color: #dee2e6;
  --bs-highlight-bg: #664d03;
  --bs-border-color: #495057;
  --bs-border-color-translucent: rgba(255, 255, 255, 0.15);
  --bs-form-valid-color: #75b798;
  --bs-form-valid-border-color: #75b798;
  --bs-form-invalid-color: #ea868f;
  --bs-form-invalid-border-color: #ea868f;
} 
    </style>
</head>
<body data-bs-theme="dark">

   {{-- Navbar Atas: Logo + Cart + Auth --}}
<nav class="bg-dark py-2 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center text-light" href="{{ route('home') }}">
            <img src="{{ asset('images/toko_.png') }}" alt="Logo" height="50" class="me-2">
        </a>

        {{-- Bagian Kanan: Cart dan User --}}
        <div class="d-flex align-items-center">
            @auth
                @php
                    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                @endphp
                <a href="{{ route('cart') }}" class="btn btn-outline-light position-relative me-3">
                    🛒
                    @if ($cartCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            @endauth

            @auth
<div class="dropdown">
    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ auth()->user()->username ?? auth()->user()->name }}
    </button>

    <ul class="dropdown-menu dropdown-menu-end">
        @auth
            @if (in_array(auth()->user()->role, [
                \App\Enums\UserRoleEnum::Administrator,
                \App\Enums\UserRoleEnum::Author
            ]))
                <li>
                    <a class="dropdown-item" href="{{ route('stock.index') }}">
                        Pengaturan Stok
                    </a>
                </li>
            @endif

            @if(auth()->user()->role === \App\Enums\UserRoleEnum::Administrator)
                <li>
                    <a class="dropdown-item" href="{{ route('user.list') }}">
                        Manajemen Pengguna
                    </a>
                </li>
            @endif

            <li><hr class="dropdown-divider"></li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Keluar</button>
                </form>
            </li>
        @endauth
    </ul>
</div>


            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

{{-- Navbar Bawah: Navigasi --}}
<nav class="bg-secondary py-2">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('products') }}">Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('contact') }}">Tentang Kami</a>
            </li>
        </ul>
    </div>
</nav>

    {{-- Konten --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
