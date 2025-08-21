@extends('layout.app')

@section('title', 'Zalora Style - Fashion Online Terlengkap')

@section('content')
<!-- Hero Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://picsum.photos/1200/500?random=1" class="d-block w-100" alt="Fashion Sale">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-4 fw-bold">Fashion Sale</h1>
                <p class="lead">Diskon hingga 70% untuk semua koleksi fashion terbaru</p>
                <a href="#" class="btn btn-primary btn-lg">Belanja Sekarang</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://picsum.photos/1200/500?random=2" class="d-block w-100" alt="New Arrivals">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-4 fw-bold">New Arrivals</h1>
                <p class="lead">Koleksi terbaru dari brand fashion terkenal</p>
                <a href="#" class="btn btn-outline-light btn-lg">Lihat Koleksi</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://picsum.photos/1200/500?random=3" class="d-block w-100" alt="Beauty">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-4 fw-bold">Beauty Essentials</h1>
                <p class="lead">Lengkapi koleksi makeup dan skincare terbaik</p>
                <a href="#" class="btn btn-primary btn-lg">Shop Beauty</a>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Quick Categories -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-6 col-md-2 mb-4">
                <div class="category-card card h-100 text-center p-3">
                    <i class="bi bi-person-dress fs-1 text-primary mb-2"></i>
                    <h6 class="fw-bold">WANITA</h6>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-4">
                <div class="category-card card h-100 text-center p-3">
                    <i class="bi bi-person fs-1 text-primary mb-2"></i>
                    <h6 class="fw-bold">PRIA</h6>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-4">
                <div class="category-card card h-100 text-center p-3">
                    <i class="bi bi-emoji-smile fs-1 text-primary mb-2"></i>
                    <h6 class="fw-bold">ANAK</h6>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-4">
                <div class="category-card card h-100 text-center p-3">
                    <i class="bi bi-shoe fs-1 text-primary mb-2"></i>
                    <h6 class="fw-bold">SEPATU</h6>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-4">
                <div class="category-card card h-100 text-center p-3">
                    <i class="bi bi-bag fs-1 text-primary mb-2"></i>
                    <h6 class="fw-bold">TAS</h6>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-4">
                <div class="category-card card h-100 text-center p-3">
                    <i class="bi bi-palette fs-1 text-primary mb-2"></i>
                    <h6 class="fw-bold">BEAUTY</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Categories -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Kategori Pilihan</h2>
                <p class="text-muted">Temukan style terbaikmu</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card category-card h-100">
                    <img src="https://picsum.photos/600/400?random=4" class="card-img-top" alt="Fashion Wanita" style="height: 300px; object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-end">
                        <div class="w-100">
                            <h3 class="card-title text-white fw-bold">SHOP WANITA</h3>
                            <p class="card-text text-white">Koleksi fashion wanita terlengkap</p>
                            <a href="{{ route('category', 'wanita') }}" class="btn btn-light">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card category-card h-100">
                    <img src="https://picsum.photos/600/400?random=5" class="card-img-top" alt="Fashion Pria" style="height: 300px; object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-end">
                        <div class="w-100">
                            <h3 class="card-title text-white fw-bold">SHOP PRIA</h3>
                            <p class="card-text text-white">Style maskulin untuk pria modern</p>
                            <a href="{{ route('category', 'pria') }}" class="btn btn-light">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card category-card h-100">
                    <img src="https://picsum.photos/400/300?random=6" class="card-img-top" alt="Sepatu" style="height: 200px; object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-end">
                        <div class="w-100">
                            <h5 class="card-title text-white fw-bold">SEPATU</h5>
                            <a href="{{ route('category', 'sepatu') }}" class="btn btn-sm btn-light">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card category-card h-100">
                    <img src="https://picsum.photos/400/300?random=7" class="card-img-top" alt="Tas" style="height: 200px; object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-end">
                        <div class="w-100">
                            <h5 class="card-title text-white fw-bold">TAS & AKSESORIS</h5>
                            <a href="{{ route('category', 'tas') }}" class="btn btn-sm btn-light">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card category-card h-100">
                    <img src="https://picsum.photos/400/300?random=8" class="card-img-top" alt="Beauty" style="height: 200px; object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-end">
                        <div class="w-100">
                            <h5 class="card-title text-white fw-bold">BEAUTY</h5>
                            <a href="{{ route('category', 'beauty') }}" class="btn btn-sm btn-light">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Produk Unggulan</h2>
                <p class="text-muted">Pilihan terbaik untuk style-mu</p>
            </div>
        </div>

        <div class="row">
            @for ($i = 1; $i <= 8; $i++)
            <div class="col-6 col-md-3 mb-4">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <a href="{{ route('product', $i) }}">
                            <img src="https://picsum.photos/300/400?random={{ $i + 10 }}" class="card-img-top" alt="Product {{ $i }}" style="height: 250px; object-fit: cover;">
                        </a>
                        @if($i % 3 === 0)
                        <span class="badge discount-badge position-absolute top-0 start-0 m-2">-30%</span>
                        @endif
                        <button class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">
                            <a href="{{ route('product', $i) }}" class="text-decoration-none text-dark">
                                {{ ['Dress Elegant', 'Kemeja Casual', 'Sneakers Sport', 'Handbag Premium', 'Skincare Set', 'Watch Fashion', 'Jacket Denim', 'Sandal Heels'][$i-1] }}
                            </a>
                        </h6>
                        <p class="card-text text-muted small">{{ ['Mango', 'Zara', 'Nike', 'Charles & Keith', 'Wardah', 'Casio', 'Levi\'s', 'Pedro'][$i-1] }}</p>

                        <div class="mt-auto">
                            @if($i % 3 === 0)
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="price-sale fw-bold">Rp {{ number_format(random_int(200, 800) * 1000) }}</span>
                                <span class="price-original small">Rp {{ number_format(random_int(300, 1000) * 1000) }}</span>
                            </div>
                            @else
                            <div class="mb-2">
                                <span class="fw-bold">Rp {{ number_format(random_int(200, 800) * 1000) }}</span>
                            </div>
                            @endif

                            <div class="d-flex gap-1 mb-2">
                                @for ($j = 1; $j <= 5; $j++)
                                <i class="bi bi-star{{ $j <= 4 ? '-fill' : '' }} text-warning small"></i>
                                @endfor
                                <span class="small text-muted">({{ random_int(10, 200) }})</span>
                            </div>

                            <button class="btn btn-primary w-100 btn-sm">Tambah ke Keranjang</button>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-primary btn-lg">Lihat Semua Produk</a>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="py-5" style="background: linear-gradient(135deg, #f4a53b 0%, #f4a53b 100%);">
    <div class="container">
        <div class="row justify-content-center text-center text-white">
            <div class="col-md-8">
                <h2 class="fw-bold mb-3">Dapatkan Update Terbaru</h2>
                <p class="lead mb-4">Berlangganan newsletter kami untuk mendapatkan info promo dan koleksi terbaru</p>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Masukkan email anda">
                            <button class="btn btn-dark" type="button">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 text-center">
                    <div class="col-md-3 col-6 mb-3">
                        <i class="bi bi-truck fs-1 mb-2"></i>
                        <h6>Gratis Ongkir</h6>
                        <small>Min. pembelian Rp 300k</small>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <i class="bi bi-arrow-clockwise fs-1 mb-2"></i>
                        <h6>30 Hari Return</h6>
                        <small>Garansi pengembalian</small>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <i class="bi bi-shield-check fs-1 mb-2"></i>
                        <h6>Produk Original</h6>
                        <small>100% produk asli</small>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <i class="bi bi-headset fs-1 mb-2"></i>
                        <h6>Customer Support</h6>
                        <small>24/7 siap membantu</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Auto-play carousel
    document.addEventListener('DOMContentLoaded', function() {
        var carousel = new bootstrap.Carousel(document.getElementById('heroCarousel'), {
            interval: 5000,
            wrap: true
        });
    });
</script>
@endpush
