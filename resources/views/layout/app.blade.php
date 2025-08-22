<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sigma - Susu Kambing Kesehatan Terpercaya')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('custom/img/logo-sigma.png') }}?{{ filemtime(public_path('custom/img/logo-sigma.png')) }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Custom Styles --}}
    <link rel="stylesheet" href="{{ asset('custom/style/style.css') }}?{{ filemtime(public_path('custom/style/style.css')) }}">

    @stack('styles')
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <small><i class="bi bi-truck"></i> Gratis Ongkir untuk pembelian di atas Rp 300.000</small>
                </div>
                <div class="col-md-6 text-md-end">
                    <small>
                        <a href="#" class="text-white text-decoration-none me-3">Bantuan</a>
                        <a href="#" class="text-white text-decoration-none">Lacak Pesanan</a>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') ?? '/' }}">
                <img src="{{ asset('custom/img/logo-text-sigma.png') }}" alt="Sigma Logo" height="40" class="me-2">
                {{-- <span class="fw-bold">SIGMA</span> --}}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'etawalin') }}">ETAWALIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'etawaku') }}">ETAWAKU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'susu-kambing') }}">SUSU KAMBING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'suplemen') }}">SUPLEMEN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'vitamin') }}">VITAMIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'herbal') }}">HERBAL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger fw-bold" href="{{ route('category', 'promo') }}">PROMO</a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <div class="search-container me-3">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Cari produk kesehatan, susu kambing...">
                </div>

                <!-- User Actions -->
                <div class="d-flex align-items-center">
                    <a href="#" class="text-dark me-3"><i class="bi bi-person fs-5"></i></a>
                    <a href="#" class="text-dark me-3"><i class="bi bi-heart fs-5"></i></a>
                    <a href="#" class="text-dark position-relative">
                        <i class="bi bi-bag fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            2
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">Layanan Pelanggan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Bantuan</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Hubungi Kami</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Panduan Ukuran</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Cara Pemesanan</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Lacak Pesanan</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">Tentang Sigma</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Karir</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Blog Kesehatan</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">Produk Kami</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Etawalin</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Etawaku</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Susu Kambing</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Suplemen</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Vitamin & Herbal</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">Ikuti Kami</h5>
                    <div class="social-icons mb-3">
                        <a href="#" class="me-3"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-youtube fs-4"></i></a>
                    </div>

                    <h6 class="fw-bold mb-2">PT SIGMA DIGITAL NUSANTARA</h6>
                    <div class="d-flex flex-column">
                        <a href="#" class="mb-2">
                            <img src="{{ asset('custom/img/logo-text-sigma.png') }}?{{ filemtime(public_path('custom/img/logo-text-sigma.png')) }}" alt="Google Play" class="img-fluid bg-white rounded p-1" style="max-width: 150px; height: 45px; object-fit: contain;">
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-white-50">&copy; 2025 Sigma. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <img src="{{ asset('custom/img/payments/visa.png') }}?{{ filemtime(public_path('custom/img/payments/visa.png')) }}" alt="Visa" class="me-2 bg-white rounded p-1" style="width:50px;height:30px;object-fit:contain;">
                    <img src="{{ asset('custom/img/payments/mastercard.png') }}?{{ filemtime(public_path('custom/img/payments/mastercard.png')) }}" alt="Mastercard" class="me-2 bg-white rounded p-1" style="width:50px;height:30px;object-fit:contain;">
                    <img src="{{ asset('custom/img/payments/ovo.png') }}?{{ filemtime(public_path('custom/img/payments/ovo.png')) }}" alt="OVO" class="me-2 bg-white rounded p-1" style="width:50px;height:30px;object-fit:contain;">
                    <img src="{{ asset('custom/img/payments/dana.png') }}?{{ filemtime(public_path('custom/img/payments/dana.png')) }}" alt="DANA" class="bg-white rounded p-1" style="width:50px;height:30px;object-fit:contain;">
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
