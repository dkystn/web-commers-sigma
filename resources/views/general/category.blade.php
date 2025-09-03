@extends('layout.app')

@section('title', 'Produk Kesehatan - Sigma')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') ?? '/' }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">Produk Kesehatan</li>
            </ol>
        </div>
    </nav>

    <!-- Category Header -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="h3 fw-bold mb-2">Produk Kesehatan</h1>
                    <p class="text-muted mb-0">Koleksi susu kambing dan suplemen kesehatan berkualitas tinggi</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="text-muted">Menampilkan 86 produk</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter & Products -->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filter -->
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h6 class="fw-bold mb-0">Filter Produk</h6>
                        </div>
                        <div class="card-body">
                            <!-- Price Filter -->
                            <div class="mb-4">
                                <h6 class="fw-bold">Harga</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="price1">
                                    <label class="form-check-label" for="price1">
                                        Di bawah Rp 100.000
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="price2">
                                    <label class="form-check-label" for="price2">
                                        Rp 100.000 - Rp 300.000
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="price3">
                                    <label class="form-check-label" for="price3">
                                        Rp 300.000 - Rp 500.000
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="price4">
                                    <label class="form-check-label" for="price4">
                                        Di atas Rp 500.000
                                    </label>
                                </div>
                            </div>

                            <!-- Brand Filter -->
                            <div class="mb-4">
                                <h6 class="fw-bold">Produk</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brand1">
                                    <label class="form-check-label" for="brand1">Etawalin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brand2">
                                    <label class="form-check-label" for="brand2">Etawaku</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brand3">
                                    <label class="form-check-label" for="brand3">Suplemen</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brand4">
                                    <label class="form-check-label" for="brand4">Vitamin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brand5">
                                    <label class="form-check-label" for="brand5">Herbal</label>
                                </div>
                            </div>

                            <!-- Size Filter -->
                            <div class="mb-4">
                                <h6 class="fw-bold">Kemasan</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="btn btn-outline-secondary btn-sm">Box</button>
                                    <button class="btn btn-outline-secondary btn-sm">Botol</button>
                                    <button class="btn btn-outline-secondary btn-sm">Sachet</button>
                                    <button class="btn btn-outline-secondary btn-sm">Kapsul</button>
                                    <button class="btn btn-outline-secondary btn-sm">Tablet</button>
                                </div>
                            </div>

                            <!-- Color Filter -->
                            <div class="mb-4">
                                <h6 class="fw-bold">Manfaat</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="benefit1">
                                    <label class="form-check-label" for="benefit1">Imunitas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="benefit2">
                                    <label class="form-check-label" for="benefit2">Tulang Sehat</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="benefit3">
                                    <label class="form-check-label" for="benefit3">Pencernaan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="benefit4">
                                    <label class="form-check-label" for="benefit4">Antioksidan</label>
                                </div>
                            </div>

                            <!-- Rating Filter -->
                            <div class="mb-4">
                                <h6 class="fw-bold">Rating</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rating5">
                                    <label class="form-check-label d-flex align-items-center" for="rating5">
                                        <div class="d-flex gap-1 me-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star-fill text-warning small"></i>
                                            @endfor
                                        </div>
                                        5 bintang
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rating4">
                                    <label class="form-check-label d-flex align-items-center" for="rating4">
                                        <div class="d-flex gap-1 me-2">
                                            @for ($i = 1; $i <= 4; $i++)
                                                <i class="bi bi-star-fill text-warning small"></i>
                                            @endfor
                                            <i class="bi bi-star text-warning small"></i>
                                        </div>
                                        4+ bintang
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rating3">
                                    <label class="form-check-label d-flex align-items-center" for="rating3">
                                        <div class="d-flex gap-1 me-2">
                                            @for ($i = 1; $i <= 3; $i++)
                                                <i class="bi bi-star-fill text-warning small"></i>
                                            @endfor
                                            @for ($i = 1; $i <= 2; $i++)
                                                <i class="bi bi-star text-warning small"></i>
                                            @endfor
                                        </div>
                                        3+ bintang
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-outline-secondary w-100">Reset Filter</button>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-md-9">
                    <!-- Sort Options -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-muted">Urutkan:</span>
                            <select class="form-select form-select-sm" style="width: auto;">
                                <option>Terpopuler</option>
                                <option>Harga Terendah</option>
                                <option>Harga Tertinggi</option>
                                <option>Terbaru</option>
                                <option>Rating Tertinggi</option>
                            </select>
                        </div>

                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary active">
                                <i class="bi bi-grid"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary">
                                <i class="bi bi-list"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="row" id="productsGrid">
                        @for ($i = 1; $i <= 24; $i++)
                            <div class="col-6 col-lg-4 mb-4 product-item">
                                <div class="card product-card h-100">
                                    <div class="position-relative">
                                        @php
                                            $colors = [
                                                '28a745',
                                                '007bff',
                                                'fd7e14',
                                                '6f42c1',
                                                '20c997',
                                                'e83e8c',
                                                '17a2b8',
                                                'ffc107',
                                            ];
                                            $categories = [
                                                'Etawalin',
                                                'Etawaku',
                                                'Suplemen',
                                                'Vitamin',
                                                'Herbal',
                                                'Probiotik',
                                                'Antioksidan',
                                                'Mineral',
                                            ];
                                            $brands = [
                                                'Premium',
                                                'Gold',
                                                'Plus',
                                                'Extra',
                                                'Original',
                                                'Advanced',
                                                'Complete',
                                                'Forte',
                                            ];
                                        @endphp
                                        <img src="https://picsum.photos/300/400?random={{ $i + 50 }}"
                                            class="card-img-top" alt="Product {{ $i }}"
                                            style="height: 280px; object-fit: cover;">
                                        @if ($i % 4 === 0)
                                            <span
                                                class="badge discount-badge position-absolute top-0 start-0 m-2">-{{ random_int(20, 50) }}%</span>
                                        @endif

                                        @if ($i % 5 === 0)
                                            <span class="badge bg-success position-absolute top-0 start-0 m-2">New</span>
                                        @endif

                                        <button class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2">
                                            <i class="bi bi-heart"></i>
                                        </button>

                                        <!-- Quick View on Hover -->
                                        <div class="position-absolute bottom-0 start-0 end-0 p-2 product-hover-actions"
                                            style="background: linear-gradient(transparent, rgba(0,0,0,0.7)); opacity: 0; transition: opacity 0.3s;">
                                            <button class="btn btn-light btn-sm w-100">Quick View</button>
                                        </div>
                                    </div>

                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">{{ $categories[($i - 1) % 8] }}
                                            {{ $brands[($i - 1) % 8] }}
                                        </h6>
                                        <p class="card-text text-muted small">Sigma</p>

                                        <div class="mt-auto">
                                            @if ($i % 4 === 0)
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <span class="price-sale fw-bold">Rp
                                                        {{ number_format(random_int(200, 600) * 1000) }}</span>
                                                    <span class="price-original small">Rp
                                                        {{ number_format(random_int(400, 800) * 1000) }}</span>
                                                </div>
                                            @else
                                                <div class="mb-2">
                                                    <span class="fw-bold">Rp
                                                        {{ number_format(random_int(200, 800) * 1000) }}</span>
                                                </div>
                                            @endif

                                            <div class="d-flex align-items-center gap-1 mb-2">
                                                <div class="d-flex gap-1">
                                                    @for ($j = 1; $j <= 5; $j++)
                                                        <i
                                                            class="bi bi-star{{ $j <= random_int(3, 5) ? '-fill' : '' }} text-warning small"></i>
                                                    @endfor
                                                </div>
                                                <span class="small text-muted">({{ random_int(10, 200) }})</span>
                                            </div>

                                            <button class="btn btn-primary w-100 btn-sm">Tambah ke Keranjang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Product pagination" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            <li class="page-item active">
                                <span class="page-link">1</span>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <span class="page-link">...</span>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">15</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Recently Viewed -->
    <section class="py-5 bg-light">
        <div class="container">
            <h4 class="fw-bold mb-4">Produk yang Baru Dilihat</h4>
            <div class="row">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-6 col-md-3 mb-4">
                        <div class="card product-card h-100">
                            <img src="https://picsum.photos/300/400?random={{ $i + 50 }}" class="card-img-top"
                                alt="Recently Viewed {{ $i }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title">
                                    {{ ['Etawalin Premium', 'Etawaku Gold', 'Suplemen Plus', 'Vitamin Complete'][$i - 1] }}
                                </h6>
                                <p class="card-text text-muted small">Sigma
                                </p>
                                <div class="fw-bold">Rp {{ number_format([185000, 225000, 145000, 165000][$i - 1]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .product-card:hover .product-hover-actions {
            opacity: 1 !important;
        }

        .form-check-input:checked {
            background-color: var(--zalora-primary);
            border-color: var(--zalora-primary);
        }

        .btn-outline-secondary.active {
            background-color: var(--zalora-primary);
            border-color: var(--zalora-primary);
            color: white;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Size filter toggle
        document.querySelectorAll('.btn-outline-secondary').forEach(btn => {
            if (btn.textContent.trim().match(/^(XS|S|M|L|XL|XXL)$/)) {
                btn.addEventListener('click', function() {
                    this.classList.toggle('btn-primary');
                    this.classList.toggle('btn-outline-secondary');
                });
            }
        });

        // Color filter toggle
        document.querySelectorAll('[style*="background-color"]').forEach(btn => {
            if (btn.classList.contains('btn') && btn.style.width === '30px') {
                btn.addEventListener('click', function() {
                    this.classList.toggle('border-primary');
                    this.classList.toggle('border-2');
                });
            }
        });

        // Grid/List view toggle
        document.querySelectorAll('.btn-group .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active from all buttons
                this.parentElement.querySelectorAll('.btn').forEach(b => b.classList.remove('active'));
                // Add active to clicked button
                this.classList.add('active');

                const isGridView = this.querySelector('.bi-grid');
                const productsGrid = document.getElementById('productsGrid');

                if (isGridView) {
                    // Grid view
                    productsGrid.className = 'row';
                    productsGrid.querySelectorAll('.product-item').forEach(item => {
                        item.className = 'col-6 col-lg-4 mb-4 product-item';
                    });
                } else {
                    // List view
                    productsGrid.className = 'row';
                    productsGrid.querySelectorAll('.product-item').forEach(item => {
                        item.className = 'col-12 mb-3 product-item';
                    });
                }
            });
        });
    </script>
@endpush
