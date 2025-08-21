<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Commers Sigma Style E-commerce')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --zalora-primary: #24a2dc;
            --zalora-secondary: #000000;
            --zalora-light: #f8f9fa;
            --zalora-dark: #212529;
            --zalora-border: #dee2e6;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--zalora-primary) !important;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--zalora-secondary) !important;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--zalora-primary) !important;
        }

        .btn-primary {
            background-color: var(--zalora-primary);
            border-color: var(--zalora-primary);
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #f4a53b;
            border-color: #f4a53b;
        }

        .btn-outline-primary {
            color: var(--zalora-primary);
            border-color: var(--zalora-primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--zalora-primary);
            border-color: var(--zalora-primary);
        }

        .hero-section {
            background: linear-gradient(135deg, #f4a53b 0%, #f4a53b 100%);
            color: white;
            padding: 80px 0;
        }

        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--zalora-border);
            border-radius: 10px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .product-card img {
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .price-original {
            text-decoration: line-through;
            color: #6c757d;
        }

        .price-sale {
            color: var(--zalora-primary);
            font-weight: 600;
        }

        .discount-badge {
            background-color: var(--zalora-primary);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .top-bar {
            background-color: var(--zalora-secondary);
            color: white;
            font-size: 0.875rem;
        }

        .search-container {
            position: relative;
        }

        .search-input {
            border-radius: 25px;
            padding-left: 2.5rem;
            border: 2px solid #e9ecef;
        }

        .search-input:focus {
            border-color: var(--zalora-primary);
            box-shadow: none;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .footer {
            background-color: var(--zalora-secondary);
            color: white;
        }

        .social-icons a {
            color: white;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--zalora-primary);
        }

        .carousel-item img {
            height: 500px;
            object-fit: cover;
        }

        .bg-purple {
            background-color: #f4a53b !important;
        }

        .bg-blue {
            background-color: #3498db !important;
        }

        @media (max-width: 768px) {
            .carousel-item img {
                height: 300px;
            }

            .hero-section {
                padding: 50px 0;
            }
        }
    </style>

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
            <a class="navbar-brand" href="{{ route('home') ?? '/' }}">Commers Sigma</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'wanita') }}">WANITA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'pria') }}">PRIA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'anak') }}">ANAK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'sepatu') }}">SEPATU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'tas') }}">TAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'beauty') }}">BEAUTY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger fw-bold" href="{{ route('category', 'sale') }}">SALE</a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <div class="search-container me-3">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Cari produk, brand, atau kategori">
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
                    <h5 class="text-uppercase fw-bold mb-3">Tentang Commers Sigma</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Karir</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Blog</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">Jelajahi</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Fashion Wanita</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Fashion Pria</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Sepatu</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Tas</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Beauty</a></li>
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

                    <h6 class="fw-bold mb-2">Download App</h6>
                    <div class="d-flex flex-column">
                        <a href="#" class="mb-2">
                            <img src="https://logoeps.com/wp-content/uploads/2013/03/google-play-vector-logo.png" alt="Google Play" class="img-fluid bg-white rounded p-1" style="max-width: 150px; height: 45px; object-fit: contain;">
                        </a>
                        <a href="#">
                            <img src="https://logoeps.com/wp-content/uploads/2013/03/app-store-vector-logo.png" alt="App Store" class="img-fluid bg-white rounded p-1" style="max-width: 150px; height: 45px; object-fit: contain;">
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-white-50">&copy; 2025 Commers Sigma Style. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <img src="https://logoeps.com/wp-content/uploads/2013/03/visa-vector-logo.png" alt="Visa" class="me-2 bg-white rounded p-1" style="width: 50px; height: 30px; object-fit: contain;">
                    <img src="https://logoeps.com/wp-content/uploads/2013/03/mastercard-vector-logo.png" alt="Mastercard" class="me-2 bg-white rounded p-1" style="width: 50px; height: 30px; object-fit: contain;">
                    <span class="badge bg-purple me-2">OVO</span>
                    <span class="badge bg-blue">DANA</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
