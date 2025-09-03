@extends('layout.app')

@section('title', 'Keranjang Belanja - Sigma')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">Keranjang Belanja</li>
            </ol>
        </div>
    </nav>

    <!-- Cart Section -->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">Keranjang Belanja (2 items)</h5>
                        </div>
                        <div class="card-body">
                            <!-- Cart Item 1 -->
                            <div class="cart-item d-flex align-items-center mb-4 pb-4 border-bottom">
                                <div class="cart-item-image me-3">
                                    <img src="https://picsum.photos/80/80?random=1" alt="Product" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                                <div class="cart-item-details flex-grow-1">
                                    <h6 class="mb-1">Etawalin Premium</h6>
                                    <p class="text-muted small mb-2">Box 200gr</p>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold text-primary me-3">Rp 185.000</span>
                                        <div class="quantity-controls d-flex align-items-center">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQuantity(1, -1)">-</button>
                                            <input type="number" class="form-control form-control-sm text-center mx-2" value="1" min="1" style="width: 60px;" id="quantity1">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQuantity(1, 1)">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-item-actions">
                                    <button class="btn btn-sm btn-outline-danger" onclick="removeItem(1)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Cart Item 2 -->
                            <div class="cart-item d-flex align-items-center">
                                <div class="cart-item-image me-3">
                                    <img src="https://picsum.photos/80/80?random=2" alt="Product" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                                <div class="cart-item-details flex-grow-1">
                                    <h6 class="mb-1">Vitamin Complete</h6>
                                    <p class="text-muted small mb-2">Botol 250ml</p>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold text-primary me-3">Rp 165.000</span>
                                        <div class="quantity-controls d-flex align-items-center">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQuantity(2, -1)">-</button>
                                            <input type="number" class="form-control form-control-sm text-center mx-2" value="1" min="1" style="width: 60px;" id="quantity2">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQuantity(2, 1)">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-item-actions">
                                    <button class="btn btn-sm btn-outline-danger" onclick="removeItem(2)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Continue Shopping -->
                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i>Lanjutkan Belanja
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">Ringkasan Belanja</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal (2 items)</span>
                                <span>Rp 350.000</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Ongkir</span>
                                <span class="text-success">Gratis</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Diskon</span>
                                <span class="text-success">-Rp 35.000</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold mb-3">
                                <span>Total</span>
                                <span>Rp 315.000</span>
                            </div>

                            <a href="{{ route('payment') }}" class="btn btn-primary w-100 mb-2">
                                <i class="bi bi-credit-card me-2"></i>Checkout
                            </a>

                            <div class="text-center">
                                <small class="text-muted">Aman & Terpercaya</small>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Code -->
                    <div class="card mt-3">
                        <div class="card-header bg-white">
                            <h6 class="fw-bold mb-0">Kode Promo</h6>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Masukkan kode promo" id="promoCode">
                                <button class="btn btn-outline-primary" type="button" onclick="applyPromo()">Terapkan</button>
                            </div>
                            <small class="text-muted mt-2 d-block">Contoh: SIGMA10 untuk diskon 10%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recently Viewed -->
    <section class="py-5 bg-light">
        <div class="container">
            <h4 class="fw-bold mb-4">Produk yang Mungkin Anda Sukai</h4>
            <div class="row">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-6 col-md-3 mb-4">
                        <div class="card product-card h-100">
                            <div class="position-relative">
                                <img src="https://picsum.photos/300/400?random={{ $i + 20 }}" class="card-img-top" alt="Related Product {{ $i }}" style="height: 200px; object-fit: cover;">
                                <button class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">Produk Kesehatan {{ $i }}</h6>
                                <p class="card-text text-muted small">Sigma</p>
                                <div class="fw-bold text-primary">Rp {{ number_format(150000 + ($i * 15000)) }}</div>
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
        function changeQuantity(itemId, change) {
            const quantityInput = document.getElementById('quantity' + itemId);
            let currentValue = parseInt(quantityInput.value);
            let newValue = currentValue + change;

            if (newValue >= 1) {
                quantityInput.value = newValue;
                updateCartTotal();
            }
        }

        function removeItem(itemId) {
            if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
                // Remove item from cart
                const cartItem = document.querySelector('.cart-item:nth-child(' + itemId + ')');
                if (cartItem) {
                    cartItem.remove();
                    updateCartTotal();
                }
            }
        }

        function updateCartTotal() {
            // This would typically recalculate totals
            // For demo purposes, we'll keep it simple
            console.log('Cart total updated');
        }

        function applyPromo() {
            const promoCode = document.getElementById('promoCode').value.toUpperCase();
            if (promoCode === 'SIGMA10') {
                alert('Kode promo berhasil diterapkan! Diskon 10%');
            } else {
                alert('Kode promo tidak valid');
            }
        }

        // Initialize cart
        document.addEventListener('DOMContentLoaded', function() {
            updateCartTotal();
        });
    </script>
@endpush
