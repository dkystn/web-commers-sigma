@extends('layout.app')

@section('title', 'Detail Produk - Zalora Style')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') ?? '/' }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Wanita</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dress</a></li>
            <li class="breadcrumb-item active">Dress Elegant Premium</li>
        </ol>
    </div>
</nav>

<!-- Product Detail -->
<section class="py-4">
    <div class="container">
        <div class="row">
            <!-- Product Images -->
            <div class="col-md-6 mb-4">
                <div class="row">
                    <div class="col-2">
                        <div class="d-flex flex-column gap-2">
                            <img src="https://picsum.photos/100/130?random=21" class="img-fluid border rounded" alt="Product 1" style="cursor: pointer;">
                            <img src="https://picsum.photos/100/130?random=22" class="img-fluid border rounded" alt="Product 2" style="cursor: pointer;">
                            <img src="https://picsum.photos/100/130?random=23" class="img-fluid border rounded" alt="Product 3" style="cursor: pointer;">
                            <img src="https://picsum.photos/100/130?random=24" class="img-fluid border rounded" alt="Product 4" style="cursor: pointer;">
                        </div>
                    </div>
                    <div class="col-10">
                        <img src="https://picsum.photos/500/650?random=20" class="img-fluid rounded" alt="Main Product" id="mainImage">
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-6">
                <div class="mb-3">
                    <span class="badge bg-success mb-2">✓ Ready Stock</span>
                    <h1 class="h3 fw-bold">Dress Elegant Premium</h1>
                    <p class="text-muted">Brand: <strong>Mango</strong></p>
                </div>

                <!-- Rating -->
                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex gap-1 me-2">
                        @for ($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= 4 ? '-fill' : '' }} text-warning"></i>
                        @endfor
                    </div>
                    <span class="text-muted">(4.5) • 128 ulasan</span>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <span class="h4 price-sale fw-bold mb-0">Rp 450.000</span>
                        <span class="price-original text-muted">Rp 650.000</span>
                        <span class="badge discount-badge">-31%</span>
                    </div>
                    <small class="text-success">✓ Hemat Rp 200.000</small>
                </div>

                <!-- Color Selection -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Warna: <span id="selectedColor">Pink</span></h6>
                    <div class="d-flex gap-2">
                        <button class="btn p-1 border border-2 border-primary" style="width: 40px; height: 40px; background-color: #f136a0;" onclick="selectColor('Pink', this)"></button>
                        <button class="btn p-1 border" style="width: 40px; height: 40px; background-color: #000000;" onclick="selectColor('Black', this)"></button>
                        <button class="btn p-1 border" style="width: 40px; height: 40px; background-color: #6c5ce7;" onclick="selectColor('Navy', this)"></button>
                        <button class="btn p-1 border" style="width: 40px; height: 40px; background-color: #ffffff;" onclick="selectColor('White', this)"></button>
                    </div>
                </div>

                <!-- Size Selection -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Ukuran: <span id="selectedSize">Pilih ukuran</span></h6>
                    <div class="d-flex gap-2 mb-2">
                        <button class="btn btn-outline-secondary size-btn" onclick="selectSize('S', this)">S</button>
                        <button class="btn btn-outline-secondary size-btn" onclick="selectSize('M', this)">M</button>
                        <button class="btn btn-outline-secondary size-btn" onclick="selectSize('L', this)">L</button>
                        <button class="btn btn-outline-secondary size-btn" onclick="selectSize('XL', this)">XL</button>
                    </div>
                    <a href="#" class="text-decoration-none small">Panduan Ukuran</a>
                </div>

                <!-- Quantity -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Jumlah:</h6>
                    <div class="input-group" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(-1)">-</button>
                        <input type="number" class="form-control text-center" value="1" min="1" id="quantity">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(1)">+</button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2 mb-4">
                    <button class="btn btn-primary btn-lg">
                        <i class="bi bi-bag-plus me-2"></i>Tambah ke Keranjang
                    </button>
                    <button class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-lightning me-2"></i>Beli Sekarang
                    </button>
                </div>

                <!-- Wishlist & Share -->
                <div class="d-flex gap-3 mb-4">
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-heart me-1"></i>Favorit
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-share me-1"></i>Bagikan
                    </button>
                </div>

                <!-- Features -->
                <div class="row text-center">
                    <div class="col-4">
                        <i class="bi bi-truck text-success mb-1 d-block"></i>
                        <small>Gratis Ongkir</small>
                    </div>
                    <div class="col-4">
                        <i class="bi bi-arrow-clockwise text-success mb-1 d-block"></i>
                        <small>30 Hari Return</small>
                    </div>
                    <div class="col-4">
                        <i class="bi bi-shield-check text-success mb-1 d-block"></i>
                        <small>100% Original</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Details Tabs -->
<section class="py-4 bg-light">
    <div class="container">
        <ul class="nav nav-tabs" id="productTabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">Deskripsi</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#details">Detail Produk</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">Ulasan (128)</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping">Info Pengiriman</button>
            </li>
        </ul>

        <div class="tab-content bg-white p-4 rounded-bottom">
            <div class="tab-pane fade show active" id="description">
                <h5>Deskripsi Produk</h5>
                <p>Dress elegant premium dengan desain modern dan material berkualitas tinggi. Cocok untuk acara formal maupun semi-formal. Dibuat dari bahan premium yang nyaman dipakai seharian.</p>

                <h6>Fitur:</h6>
                <ul>
                    <li>Material premium berkualitas tinggi</li>
                    <li>Desain elegant dan modern</li>
                    <li>Nyaman dipakai seharian</li>
                    <li>Mudah dirawat dan tahan lama</li>
                </ul>
            </div>

            <div class="tab-pane fade" id="details">
                <h5>Detail Produk</h5>
                <table class="table">
                    <tr>
                        <td><strong>Brand</strong></td>
                        <td>Mango</td>
                    </tr>
                    <tr>
                        <td><strong>Material</strong></td>
                        <td>95% Polyester, 5% Elastane</td>
                    </tr>
                    <tr>
                        <td><strong>Panjang</strong></td>
                        <td>Mini (95cm)</td>
                    </tr>
                    <tr>
                        <td><strong>Pattern</strong></td>
                        <td>Solid</td>
                    </tr>
                    <tr>
                        <td><strong>Care Instructions</strong></td>
                        <td>Machine wash cold, hang dry</td>
                    </tr>
                </table>
            </div>

            <div class="tab-pane fade" id="reviews">
                <h5>Ulasan Pelanggan</h5>

                <!-- Review Summary -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-2">
                            <span class="h4 me-2">4.5</span>
                            <div class="d-flex gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= 4 ? '-fill' : '' }} text-warning"></i>
                                @endfor
                            </div>
                        </div>
                        <small class="text-muted">Berdasarkan 128 ulasan</small>
                    </div>
                </div>

                <!-- Individual Reviews -->
                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <strong class="me-2">Sarah K.</strong>
                        <div class="d-flex gap-1 me-2">
                            @for ($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star-fill text-warning small"></i>
                            @endfor
                        </div>
                        <small class="text-muted">2 hari yang lalu</small>
                    </div>
                    <p class="mb-0">Sangat suka dengan dress ini! Bahannya adem dan modelnya elegant. Sesuai dengan foto.</p>
                </div>

                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <strong class="me-2">Maya R.</strong>
                        <div class="d-flex gap-1 me-2">
                            @for ($i = 1; $i <= 4; $i++)
                            <i class="bi bi-star-fill text-warning small"></i>
                            @endfor
                            <i class="bi bi-star text-warning small"></i>
                        </div>
                        <small class="text-muted">1 minggu yang lalu</small>
                    </div>
                    <p class="mb-0">Bagus tapi agak kekecilan. Mungkin next order size yang lebih besar.</p>
                </div>
            </div>

            <div class="tab-pane fade" id="shipping">
                <h5>Informasi Pengiriman</h5>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Gratis Ongkir</h6>
                        <p>Untuk pembelian minimal Rp 300.000 ke seluruh Indonesia</p>

                        <h6>Estimasi Pengiriman</h6>
                        <ul>
                            <li>Jakarta & sekitarnya: 1-2 hari kerja</li>
                            <li>Pulau Jawa: 2-4 hari kerja</li>
                            <li>Luar Pulau Jawa: 3-7 hari kerja</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Kurir Pengiriman</h6>
                        <ul>
                            <li>JNE</li>
                            <li>J&T Express</li>
                            <li>Shopee Express</li>
                            <li>GoSend (Jakarta)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4">Produk Serupa</h3>
        <div class="row">
            @for ($i = 1; $i <= 4; $i++)
            <div class="col-6 col-md-3 mb-4">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="https://picsum.photos/300/400?random={{ $i + 30 }}" class="card-img-top" alt="Related Product {{ $i }}" style="height: 250px; object-fit: cover;">
                        <button class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">Dress {{ ['Casual', 'Formal', 'Party', 'Office'][$i-1] }}</h6>
                        <p class="card-text text-muted small">{{ ['Zara', 'H&M', 'Mango', 'Uniqlo'][$i-1] }}</p>

                        <div class="mt-auto">
                            <div class="mb-2">
                                <span class="fw-bold">Rp {{ number_format(random_int(300, 700) * 1000) }}</span>
                            </div>
                            <button class="btn btn-primary w-100 btn-sm">Tambah ke Keranjang</button>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function selectColor(colorName, element) {
        // Remove border from all color buttons
        document.querySelectorAll('[onclick^="selectColor"]').forEach(btn => {
            btn.classList.remove('border-primary', 'border-2');
            btn.classList.add('border');
        });

        // Add border to selected color
        element.classList.add('border-primary', 'border-2');
        element.classList.remove('border');

        // Update selected color text
        document.getElementById('selectedColor').textContent = colorName;
    }

    function selectSize(size, element) {
        // Remove active class from all size buttons
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-outline-secondary');
        });

        // Add active class to selected size
        element.classList.remove('btn-outline-secondary');
        element.classList.add('btn-primary');

        // Update selected size text
        document.getElementById('selectedSize').textContent = size;
    }

    function changeQuantity(change) {
        const quantityInput = document.getElementById('quantity');
        let currentValue = parseInt(quantityInput.value);
        let newValue = currentValue + change;

        if (newValue >= 1) {
            quantityInput.value = newValue;
        }
    }

    // Thumbnail image click handler
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('[alt^="Product"]');
        const mainImage = document.getElementById('mainImage');

        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', function() {
                // Remove active border from all thumbnails
                thumbnails.forEach(t => t.classList.remove('border-primary', 'border-2'));

                // Add active border to clicked thumbnail
                this.classList.add('border-primary', 'border-2');

                // Update main image
                mainImage.src = this.src.replace('100x130', '500x650');
            });
        });

        // Set first thumbnail as active
        if (thumbnails.length > 0) {
            thumbnails[0].classList.add('border-primary', 'border-2');
        }
    });
</script>
@endpush
