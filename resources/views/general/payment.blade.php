@extends('layout.app')

@section('title', 'Pembayaran - Sigma')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') ?? '/' }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart') ?? '#' }}" class="text-decoration-none">Keranjang</a></li>
                <li class="breadcrumb-item active">Pembayaran</li>
            </ol>
        </div>
    </nav>

    <!-- Payment Section -->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <!-- Order Summary -->
                <div class="col-lg-4 order-lg-2 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">Ringkasan Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <!-- Order Items -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="https://picsum.photos/60/60?random=1" alt="Product" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 small">Etawalin Premium</h6>
                                        <small class="text-muted">Box 200gr</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold">Rp 185.000</div>
                                        <small class="text-muted">Qty: 1</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <img src="https://picsum.photos/60/60?random=2" alt="Product" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 small">Vitamin Complete</h6>
                                        <small class="text-muted">Botol 250ml</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold">Rp 165.000</div>
                                        <small class="text-muted">Qty: 1</small>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Order Totals -->
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
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
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span>Rp 315.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Summary -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="fw-bold mb-2">Metode Pembayaran</h6>
                            <div class="d-flex align-items-center" id="paymentSummary">
                                <i class="bi bi-cash-coin text-success me-2 fs-5"></i>
                                <span>Cash on Delivery (COD)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Form -->
                <div class="col-lg-8 order-lg-1">
                    <form id="paymentForm">
                        <!-- Shipping Information -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="fw-bold mb-0">Informasi Pengiriman</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName" class="form-label">Nama Depan</label>
                                        <input type="text" class="form-control" id="firstName" value="Ahmad" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName" class="form-label">Nama Belakang</label>
                                        <input type="text" class="form-control" id="lastName" value="Santoso" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="ahmad.santoso@email.com" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="phone" value="+62 812-3456-7890" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" id="address" rows="3" required>Jl. Banikan No.11E, Mejing Wetan, Ambarketawang, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55294</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="province" class="form-label">Provinsi</label>
                                        <select class="form-select" id="province" required>
                                            <option value="yogyakarta">Daerah Istimewa Yogyakarta</option>
                                            <option value="jakarta">DKI Jakarta</option>
                                            <option value="jabar">Jawa Barat</option>
                                            <option value="jateng">Jawa Tengah</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="city" class="form-label">Kota</label>
                                        <select class="form-select" id="city" required>
                                            <option value="sleman">Kabupaten Sleman</option>
                                            <option value="yogyakarta-kota">Kota Yogyakarta</option>
                                            <option value="jakarta-pusat">Jakarta Pusat</option>
                                            <option value="jakarta-utara">Jakarta Utara</option>
                                            <option value="jakarta-selatan">Jakarta Selatan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="postalCode" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="postalCode" value="55294" required>
                                    </div>
                                </div>

                                <!-- Hidden coordinate fields -->
                                <input type="hidden" id="latitude" value="-6.288941">
                                <input type="hidden" id="longitude" value="106.806473">
                                <!-- Hidden coordinates for Biteship API -->
                                <input type="hidden" id="latitude" value="-7.7956">
                                <input type="hidden" id="longitude" value="110.3695">
                            </div>
                        </div>

                        <!-- Shipping Method -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="fw-bold mb-0">Metode Pengiriman</h5>
                            </div>
                            <div class="card-body">
                                <!-- Regular Shipping -->
                                <div class="mb-3">
                                    <div class="form-check shipping-method">
                                        <input class="form-check-input" type="radio" name="shippingMethod" id="regular" value="regular" checked>
                                        <label class="form-check-label d-flex align-items-center" for="regular">
                                            <i class="bi bi-truck text-secondary me-3 fs-4"></i>
                                            <div>
                                                <div class="fw-bold">Pengiriman Reguler</div>
                                                <small class="text-muted">2-5 hari kerja</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Instant Shipping -->
                                <div class="mb-3">
                                    <div class="form-check shipping-method">
                                        <input class="form-check-input" type="radio" name="shippingMethod" id="instant" value="instant">
                                        <label class="form-check-label d-flex align-items-center" for="instant">
                                            <i class="bi bi-lightning-fill text-warning me-3 fs-4"></i>
                                            <div>
                                                <div class="fw-bold">Pengantaran Instan</div>
                                                <small class="text-muted">1-2 jam (Biteship)</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Instant Shipping Options (shown when instant is selected) -->
                                <div id="instantOptions" class="mt-3" style="display: none;">
                                    <div class="border rounded p-3 bg-light">
                                        <h6 class="fw-bold mb-3">Pilih Kurir Instan:</h6>
                                        <div id="instantCouriers" class="row">
                                            <!-- Couriers will be loaded here -->
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <small class="text-muted ms-2">Memuat kurir...</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="fw-bold mb-0">Metode Pembayaran</h5>
                            </div>
                            <div class="card-body">
                                <!-- COD Option -->
                                <div class="mb-3">
                                    <div class="form-check payment-method">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod" checked>
                                        <label class="form-check-label d-flex align-items-center" for="cod">
                                            <i class="bi bi-cash-coin text-success me-3 fs-4"></i>
                                            <div>
                                                <div class="fw-bold">Cash on Delivery (COD)</div>
                                                <small class="text-muted">Bayar saat barang diterima</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Midtrans Option -->
                                <div class="mb-3">
                                    <div class="form-check payment-method">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="midtrans" value="midtrans">
                                        <label class="form-check-label d-flex align-items-center" for="midtrans">
                                            <i class="bi bi-credit-card text-primary me-3 fs-4"></i>
                                            <div>
                                                <div class="fw-bold">Pembayaran Online (Midtrans)</div>
                                                <small class="text-muted">Transfer Bank, E-Wallet, Kartu Kredit</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Midtrans Payment Options (shown when midtrans is selected) -->
                                <div id="midtransOptions" class="mt-3" style="display: none;">
                                    <div class="border rounded p-3 bg-light">
                                        <h6 class="fw-bold mb-3">Pilih Metode Pembayaran Online:</h6>

                                        <!-- Bank Transfer -->
                                        <div class="mb-3">
                                            <h6 class="fw-bold mb-2 text-primary">Transfer Bank</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check payment-sub-method">
                                                        <input class="form-check-input" type="radio" name="midtransMethod" id="bca" value="bca">
                                                        <label class="form-check-label d-flex align-items-center" for="bca">
                                                            <img src="{{ asset('custom/img/payments/bca.png') }}" alt="BCA" class="me-2" style="width: 40px; height: 25px; object-fit: contain;">
                                                            BCA Virtual Account
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check payment-sub-method">
                                                        <input class="form-check-input" type="radio" name="midtransMethod" id="mandiri" value="mandiri">
                                                        <label class="form-check-label d-flex align-items-center" for="mandiri">
                                                            <img src="{{ asset('custom/img/payments/mandiri.png') }}" alt="Mandiri" class="me-2" style="width: 40px; height: 25px; object-fit: contain;">
                                                            Mandiri Virtual Account
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check payment-sub-method">
                                                        <input class="form-check-input" type="radio" name="midtransMethod" id="bni" value="bni">
                                                        <label class="form-check-label d-flex align-items-center" for="bni">
                                                            <img src="{{ asset('custom/img/payments/bni.png') }}" alt="BNI" class="me-2" style="width: 40px; height: 25px; object-fit: contain;">
                                                            BNI Virtual Account
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check payment-sub-method">
                                                        <input class="form-check-input" type="radio" name="midtransMethod" id="bri" value="bri">
                                                        <label class="form-check-label d-flex align-items-center" for="bri">
                                                            <img src="{{ asset('custom/img/payments/bri.png') }}" alt="BRI" class="me-2" style="width: 40px; height: 25px; object-fit: contain;">
                                                            BRI Virtual Account
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- E-Wallet -->
                                        <div class="mb-3">
                                            <h6 class="fw-bold mb-2 text-primary">E-Wallet</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check payment-sub-method">
                                                        <input class="form-check-input" type="radio" name="midtransMethod" id="ovo" value="ovo">
                                                        <label class="form-check-label d-flex align-items-center" for="ovo">
                                                            <img src="{{ asset('custom/img/payments/ovo.png') }}" alt="OVO" class="me-2" style="width: 40px; height: 25px; object-fit: contain;">
                                                            OVO
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check payment-sub-method">
                                                        <input class="form-check-input" type="radio" name="midtransMethod" id="dana" value="dana">
                                                        <label class="form-check-label d-flex align-items-center" for="dana">
                                                            <img src="{{ asset('custom/img/payments/dana.png') }}" alt="DANA" class="me-2" style="width: 40px; height: 25px; object-fit: contain;">
                                                            DANA
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check payment-sub-method">
                                                        <input class="form-check-input" type="radio" name="midtransMethod" id="gopay" value="gopay">
                                                        <label class="form-check-label d-flex align-items-center" for="gopay">
                                                            <img src="{{ asset('custom/img/payments/gopay.png') }}" alt="GoPay" class="me-2" style="width: 40px; height: 25px; object-fit: contain;">
                                                            GoPay
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check payment-sub-method">
                                                        <input class="form-check-input" type="radio" name="midtransMethod" id="shopeepay" value="shopeepay">
                                                        <label class="form-check-label d-flex align-items-center" for="shopeepay">
                                                            <img src="{{ asset('custom/img/payments/shopeepay.png') }}" alt="ShopeePay" class="me-2" style="width: 40px; height: 25px; object-fit: contain;">
                                                            ShopeePay
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- QRIS -->
                                        <div class="mb-3">
                                            <h6 class="fw-bold mb-2 text-primary">QRIS</h6>
                                            <div class="form-check payment-sub-method">
                                                <input class="form-check-input" type="radio" name="midtransMethod" id="qris" value="qris">
                                                <label class="form-check-label d-flex align-items-center" for="qris">
                                                    <i class="bi bi-qr-code text-success me-3 fs-4"></i>
                                                    <div>
                                                        <div class="fw-bold">QRIS</div>
                                                        <small class="text-muted">Scan QR untuk bayar</small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="fw-bold mb-0">Catatan Pesanan (Opsional)</h5>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" id="orderNotes" rows="3" placeholder="Tambahkan catatan khusus untuk pesanan Anda..."></textarea>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Saya setuju dengan <a href="#" class="text-decoration-none">Syarat & Ketentuan</a> dan <a href="#" class="text-decoration-none">Kebijakan Privasi</a>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="bi bi-cash-coin me-2"></i>Buat Pesanan COD - Rp 315.000
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .payment-method, .payment-sub-method {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .payment-method:hover, .payment-sub-method:hover {
            border-color: var(--bs-primary);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .payment-method .form-check-input:checked ~ .form-check-label,
        .payment-sub-method .form-check-input:checked ~ .form-check-label {
            color: var(--bs-primary);
            font-weight: 500;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card-header {
            border-bottom: 1px solid #f8f9fa;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
        }

        .shipping-method {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .shipping-method:hover {
            border-color: var(--bs-primary);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .shipping-method .form-check-input:checked ~ .form-check-label {
            color: var(--bs-primary);
            font-weight: 500;
        }

        .shipping-sub-method {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .shipping-sub-method:hover {
            border-color: var(--bs-primary);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .shipping-sub-method .form-check-input:checked ~ .form-check-label {
            color: var(--bs-primary);
            font-weight: 500;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Initialize current total
        window.currentTotal = 315000;
        // Payment method selection
        document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove active class from all payment methods
                document.querySelectorAll('.payment-method').forEach(method => {
                    method.classList.remove('border-primary', 'bg-light');
                });

                // Add active class to selected payment method
                if (this.checked) {
                    this.closest('.payment-method').classList.add('border-primary', 'bg-light');

                    // Update payment summary
                    const paymentSummary = document.getElementById('paymentSummary');
                    const midtransOptions = document.getElementById('midtransOptions');
                    const submitBtn = document.getElementById('submitBtn');

                    if (this.value === 'cod') {
                        paymentSummary.innerHTML = `
                            <i class="bi bi-cash-coin text-success me-2 fs-5"></i>
                            <span>Cash on Delivery (COD)</span>
                        `;
                        submitBtn.innerHTML = '<i class="bi bi-cash-coin me-2"></i>Buat Pesanan COD - Rp 315.000';
                        midtransOptions.style.display = 'none';
                    } else if (this.value === 'midtrans') {
                        paymentSummary.innerHTML = `
                            <i class="bi bi-credit-card text-primary me-2 fs-5"></i>
                            <span>Pembayaran Online (Midtrans)</span>
                        `;
                        submitBtn.innerHTML = '<i class="bi bi-credit-card me-2"></i>Bayar Sekarang - Rp 315.000';
                        midtransOptions.style.display = 'block';
                    }
                }
            });
        });

        // Midtrans sub-method selection
        document.querySelectorAll('input[name="midtransMethod"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove active class from all sub-methods
                document.querySelectorAll('.payment-sub-method').forEach(method => {
                    method.classList.remove('border-primary', 'bg-light');
                });

                // Add active class to selected sub-method
                if (this.checked) {
                    this.closest('.payment-sub-method').classList.add('border-primary', 'bg-light');
                }
            });
        });

        // Set initial active state
        document.querySelector('input[name="paymentMethod"]:checked').dispatchEvent(new Event('change'));

        // Shipping method selection
        document.querySelectorAll('input[name="shippingMethod"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove active class from all shipping methods
                document.querySelectorAll('.shipping-method').forEach(method => {
                    method.classList.remove('border-primary', 'bg-light');
                });

                // Add active class to selected shipping method
                if (this.checked) {
                    this.closest('.shipping-method').classList.add('border-primary', 'bg-light');

                    const instantOptions = document.getElementById('instantOptions');
                    const instantCouriers = document.getElementById('instantCouriers');

                    if (this.value === 'regular') {
                        instantOptions.style.display = 'none';
                        updateOrderSummary('regular', 0);
                    } else if (this.value === 'instant') {
                        instantOptions.style.display = 'block';
                        loadInstantCouriers();
                    }
                }
            });
        });

        // Load instant couriers from Biteship
        function loadInstantCouriers() {
            const instantCouriers = document.getElementById('instantCouriers');
            instantCouriers.innerHTML = `
                <div class="col-12">
                    <div class="text-center">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <small class="text-muted ms-2">Memuat kurir instan...</small>
                    </div>
                </div>
            `;

            // Get coordinates from hidden fields
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;

            if (!latitude || !longitude) {
                instantCouriers.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Koordinat lokasi tidak tersedia
                        </div>
                    </div>
                `;
                return;
            }

            // Call Biteship API with simplified coordinate format
            fetch('/api/biteship/instant-rates', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    latitude: parseFloat(latitude),
                    longitude: parseFloat(longitude)
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Biteship response:', data);

                if (data.success && data.couriers && Array.isArray(data.couriers)) {
                    displayInstantCouriers(data.couriers);
                } else if (data.success && data.pricing && Array.isArray(data.pricing)) {
                    // Handle direct pricing response
                    displayInstantCouriers(data.pricing);
                } else if (!data.success) {
                    // Handle API error
                    instantCouriers.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Gagal mendapatkan data dari API Biteship</strong><br>
                                ${data.message || 'Service temporarily unavailable'}<br>
                                <small class="text-muted">Pastikan koneksi internet Anda stabil dan API key valid.</small>
                            </div>
                        </div>
                    `;
                } else {
                    instantCouriers.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <i class="bi bi-info-circle me-2"></i>
                                Tidak dapat memuat opsi kurir instan - format response tidak valid
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading instant couriers:', error);
                instantCouriers.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Gagal memuat kurir instan. Silakan coba lagi.
                        </div>
                    </div>
                `;
            });
        }

        // Display instant couriers
        function displayInstantCouriers(couriers) {
            const instantCouriers = document.getElementById('instantCouriers');
            let html = '';

            console.log('Displaying couriers:', couriers);

            couriers.forEach((courier, index) => {
                const courierId = `courier-${index}`;
                let price = 0;
                let duration = '1-2 jam';
                let courierName = 'Kurir Instan';

                // Handle Biteship API response structure
                if (courier.price) {
                    price = courier.price;
                }

                if (courier.duration) {
                    duration = courier.duration;
                }

                if (courier.courier_name) {
                    courierName = courier.courier_name;
                } else if (courier.company) {
                    courierName = courier.company.toUpperCase();
                }

                // Handle service name
                let serviceName = 'Instant';
                if (courier.courier_service_name) {
                    serviceName = courier.courier_service_name;
                }

                if (price > 0) {
                    html += `
                        <div class="col-md-6 mb-2">
                            <div class="form-check shipping-sub-method">
                                <input class="form-check-input" type="radio" name="instantCourier" id="${courierId}" value="${courierId}" data-price="${price}" data-courier="${JSON.stringify(courier).replace(/"/g, '&quot;')}">
                                <label class="form-check-label d-flex align-items-center" for="${courierId}">
                                    <i class="bi bi-truck text-warning me-3 fs-4"></i>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">${courierName} ${serviceName}</div>
                                        <small class="text-muted">${duration}</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold text-primary">Rp ${price.toLocaleString()}</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    `;
                }
            });

            if (html === '') {
                instantCouriers.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Tidak ada kurir instan yang tersedia untuk alamat ini
                        </div>
                    </div>
                `;
            } else {
                instantCouriers.innerHTML = html;

                // Add event listeners for courier selection
                document.querySelectorAll('input[name="instantCourier"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        // Remove active class from all sub-methods
                        document.querySelectorAll('.shipping-sub-method').forEach(method => {
                            method.classList.remove('border-primary', 'bg-light');
                        });

                        // Add active class to selected sub-method
                        if (this.checked) {
                            this.closest('.shipping-sub-method').classList.add('border-primary', 'bg-light');
                            const price = parseInt(this.getAttribute('data-price'));
                            updateOrderSummary('instant', price);
                        }
                    });
                });
            }
        }

        // Update order summary with shipping cost
        function updateOrderSummary(shippingType, shippingCost) {
            const subtotal = 350000;
            const discount = 35000;
            const baseTotal = subtotal - discount;
            const total = baseTotal + shippingCost;

            // Update shipping display
            const shippingElement = document.querySelector('.d-flex.justify-content-between.mb-2:nth-child(3) span:nth-child(2)');
            if (shippingType === 'regular') {
                shippingElement.innerHTML = '<span class="text-success">Gratis</span>';
            } else {
                shippingElement.innerHTML = `Rp ${shippingCost.toLocaleString()}`;
            }

            // Update total
            const totalElement = document.querySelector('.d-flex.justify-content-between.fw-bold span:nth-child(2)');
            totalElement.textContent = `Rp ${total.toLocaleString()}`;

            // Update submit button
            const submitBtn = document.getElementById('submitBtn');
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
            if (paymentMethod) {
                if (paymentMethod.value === 'cod') {
                    submitBtn.innerHTML = `<i class="bi bi-cash-coin me-2"></i>Buat Pesanan COD - Rp ${total.toLocaleString()}`;
                } else if (paymentMethod.value === 'midtrans') {
                    submitBtn.innerHTML = `<i class="bi bi-credit-card me-2"></i>Bayar Sekarang - Rp ${total.toLocaleString()}`;
                }
            }

            // Store current total for later use
            window.currentTotal = total;
        }

        // Check if Snap.js is loaded
        window.addEventListener('load', function() {
            setTimeout(function() {
                if (typeof snap === 'undefined') {
                    console.warn('Snap.js is not loaded. Payment may not work properly.');
                    // Try to load Snap.js manually as fallback
                    loadSnapJS();
                } else {
                    console.log('Snap.js loaded successfully');
                }
            }, 2000);
        });

        // Fallback function to load Snap.js
        function loadSnapJS() {
            console.log('Attempting to load Snap.js as fallback...');
            const script = document.createElement('script');
            script.src = 'https://app.sandbox.midtrans.com/snap/snap.js';
            script.setAttribute('data-client-key', '{{ env("MIDTRANS_CLIENT_KEY", "SB-Mid-client-ydoeRccRG1sKnOeu") }}');
            script.onload = function() {
                console.log('Snap.js loaded successfully via fallback');
            };
            script.onerror = function() {
                console.error('Failed to load Snap.js via fallback');
            };
            document.head.appendChild(script);
        }

        // Form validation
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic validation
            const requiredFields = ['firstName', 'lastName', 'email', 'phone', 'address', 'province', 'city', 'postalCode'];
            let isValid = true;

            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (!element.value.trim()) {
                    element.classList.add('is-invalid');
                    isValid = false;
                } else {
                    element.classList.remove('is-invalid');
                }
            });

            // Check terms
            const terms = document.getElementById('terms');
            if (!terms.checked) {
                terms.classList.add('is-invalid');
                isValid = false;
            } else {
                terms.classList.remove('is-invalid');
            }

            // Check payment method selection
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
            if (!paymentMethod) {
                alert('Silakan pilih metode pembayaran');
                isValid = false;
            } else if (paymentMethod.value === 'midtrans') {
                const midtransMethod = document.querySelector('input[name="midtransMethod"]:checked');
                if (!midtransMethod) {
                    alert('Silakan pilih metode pembayaran online');
                    isValid = false;
                } else {
                    console.log('Selected Midtrans method:', midtransMethod.value);
                }
            }

            // Check shipping method selection
            const shippingMethod = document.querySelector('input[name="shippingMethod"]:checked');
            if (!shippingMethod) {
                alert('Silakan pilih metode pengiriman');
                isValid = false;
            } else if (shippingMethod.value === 'instant') {
                const instantCourier = document.querySelector('input[name="instantCourier"]:checked');
                if (!instantCourier) {
                    alert('Silakan pilih kurir instan');
                    isValid = false;
                } else {
                    console.log('Selected instant courier:', instantCourier.value);
                }
            }

            if (isValid) {
                const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

                if (paymentMethod.value === 'cod') {
                    // Handle COD - create order without payment
                    handleCODOrder();
                } else if (paymentMethod.value === 'midtrans') {
                    // Handle Midtrans payment
                    handleMidtransPayment();
                }
            }
        });

        // Remove invalid class on input
        document.querySelectorAll('input, select, textarea').forEach(element => {
            element.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });

        // Reload instant couriers when address changes
        document.getElementById('postalCode').addEventListener('change', function() {
            const instantSelected = document.querySelector('input[name="shippingMethod"]:checked');
            if (instantSelected && instantSelected.value === 'instant') {
                loadInstantCouriers();
            }
        });

        document.getElementById('address').addEventListener('input', function() {
            const instantSelected = document.querySelector('input[name="shippingMethod"]:checked');
            if (instantSelected && instantSelected.value === 'instant') {
                // Debounce the API call
                clearTimeout(this.debounceTimer);
                this.debounceTimer = setTimeout(() => {
                    loadInstantCouriers();
                }, 1000);
            }
        });

        // Get enabled payments based on selected method
        function getEnabledPayments(selectedMethod) {
            const allPayments = [
                'credit_card',
                'bca_va',
                'bni_va',
                'bri_va',
                'mandiri_va',
                'gopay',
                'shopeepay',
                'ovo',
                'dana',
                'qris'
            ];

            if (!selectedMethod) return allPayments;

            switch (selectedMethod) {
                case 'bca':
                    return ['bca_va'];
                case 'mandiri':
                    return ['mandiri_va'];
                case 'bni':
                    return ['bni_va'];
                case 'bri':
                    return ['bri_va'];
                case 'ovo':
                    return ['ovo'];
                case 'dana':
                    return ['dana'];
                case 'gopay':
                    return ['gopay'];
                case 'shopeepay':
                    return ['shopeepay'];
                case 'qris':
                    // QRIS: Kembalikan semua metode agar user bisa pilih
                    return allPayments;
                case 'creditcard':
                    return ['credit_card'];
                default:
                    return allPayments;
            }
        }

        // Handle COD Order
        function handleCODOrder() {
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Membuat Pesanan...';
            submitBtn.disabled = true;

            // Collect form data
            const formData = new FormData();
            formData.append('firstName', document.getElementById('firstName').value);
            formData.append('lastName', document.getElementById('lastName').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('province', document.getElementById('province').value);
            formData.append('city', document.getElementById('city').value);
            formData.append('postalCode', document.getElementById('postalCode').value);
            formData.append('orderNotes', document.getElementById('orderNotes').value);
            formData.append('paymentMethod', 'cod');

            // Add shipping method
            const shippingMethod = document.querySelector('input[name="shippingMethod"]:checked');
            if (shippingMethod) {
                formData.append('shippingMethod', shippingMethod.value);
                if (shippingMethod.value === 'instant') {
                    const instantCourier = document.querySelector('input[name="instantCourier"]:checked');
                    if (instantCourier) {
                        formData.append('instantCourier', instantCourier.getAttribute('data-courier'));
                        formData.append('shippingCost', instantCourier.getAttribute('data-price'));
                    }
                }
            }

            formData.append('_token', '{{ csrf_token() }}');

            // Send to server (you'll need to create this route)
            fetch('/api/orders/cod', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pesanan COD berhasil dibuat! Terima kasih atas pesanan Anda.');
                    window.location.href = '{{ route("home") ?? "/" }}';
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Gagal membuat pesanan'));
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        }

        // Handle Midtrans Payment
        function handleMidtransPayment() {
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mempersiapkan Pembayaran...';
            submitBtn.disabled = true;

            // Get selected Midtrans method
            const midtransMethodElement = document.querySelector('input[name="midtransMethod"]:checked');
            const midtransMethod = midtransMethodElement ? midtransMethodElement.value : null;

            // Prepare transaction data
            const transactionData = {
                transaction_details: {
                    order_id: 'SIGMA-' + Date.now() + '-' + Math.floor(Math.random() * 1000),
                    gross_amount: window.currentTotal || 315000
                },
                customer_details: {
                    first_name: document.getElementById('firstName').value,
                    last_name: document.getElementById('lastName').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value
                },
                item_details: [
                    {
                        id: 'ETAWALIN-001',
                        price: 185000,
                        quantity: 1,
                        name: 'Etawalin Premium Box 200gr'
                    },
                    {
                        id: 'VITAMIN-001',
                        price: 165000,
                        quantity: 1,
                        name: 'Vitamin Complete Botol 250ml'
                    }
                ],
                finish_redirect_url: '{{ url("/midtrans/finish") }}',
                unfinish_redirect_url: '{{ url("/midtrans/unfinish") }}',
                error_redirect_url: '{{ url("/midtrans/error") }}'
            };

            // Add shipping method
            const shippingMethod = document.querySelector('input[name="shippingMethod"]:checked');
            if (shippingMethod) {
                transactionData.shipping_method = shippingMethod.value;
                if (shippingMethod.value === 'instant') {
                    const instantCourier = document.querySelector('input[name="instantCourier"]:checked');
                    if (instantCourier) {
                        transactionData.instant_courier = JSON.parse(instantCourier.getAttribute('data-courier'));
                        transactionData.shipping_cost = parseInt(instantCourier.getAttribute('data-price'));
                        // Update gross amount with shipping cost
                        transactionData.transaction_details.gross_amount += transactionData.shipping_cost;
                    }
                }
            }

            // Jika ada metode yang dipilih, kirim hanya metode tersebut
            // Kecuali QRIS - biarkan semua metode muncul agar user bisa pilih
            if (midtransMethod) {
                if (midtransMethod === 'qris') {
                    // QRIS: Jangan set enabled_payments agar semua metode muncul
                    console.log('🚀 QRIS Payment Selected - All payment methods will be shown for user to choose');
                    console.log('💡 User can select QRIS or any other payment method in the popup');
                } else if (midtransMethod === 'bca') {
                    transactionData.enabled_payments = ['bca_va'];
                    console.log('🏦 BCA VA Payment Selected - Sending enabled_payments:', transactionData.enabled_payments);
                } else if (midtransMethod === 'mandiri') {
                    transactionData.enabled_payments = ['mandiri_va'];
                    console.log('🏦 Mandiri VA Payment Selected - Sending enabled_payments:', transactionData.enabled_payments);
                } else if (midtransMethod === 'bni') {
                    transactionData.enabled_payments = ['bni_va'];
                    console.log('🏦 BNI VA Payment Selected - Sending enabled_payments:', transactionData.enabled_payments);
                } else if (midtransMethod === 'bri') {
                    transactionData.enabled_payments = ['bri_va'];
                    console.log('🏦 BRI VA Payment Selected - Sending enabled_payments:', transactionData.enabled_payments);
                } else if (midtransMethod === 'ovo') {
                    transactionData.enabled_payments = ['ovo'];
                    console.log('📱 OVO Payment Selected - Sending enabled_payments:', transactionData.enabled_payments);
                } else if (midtransMethod === 'dana') {
                    transactionData.enabled_payments = ['dana'];
                    console.log('📱 DANA Payment Selected - Sending enabled_payments:', transactionData.enabled_payments);
                } else if (midtransMethod === 'gopay') {
                    transactionData.enabled_payments = ['gopay'];
                    console.log('📱 GoPay Payment Selected - Sending enabled_payments:', transactionData.enabled_payments);
                } else if (midtransMethod === 'shopeepay') {
                    transactionData.enabled_payments = ['shopeepay'];
                    console.log('🛒 ShopeePay Payment Selected - Sending enabled_payments:', transactionData.enabled_payments);
                } else if (midtransMethod === 'creditcard') {
                    transactionData.enabled_payments = ['credit_card'];
                    console.log('💳 Credit Card Payment Selected - Sending enabled_payments:', transactionData.enabled_payments);
                }
            } else {
                console.log('💳 All Payment Methods Selected - No specific method chosen');
            }

            // Send to server to create Midtrans transaction
            console.log('Sending transaction data:', transactionData);
            fetch('/api/orders/midtrans', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(transactionData)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Midtrans response:', data);
                if (data.selected_method === 'qris') {
                    console.log('🎯 QRIS Selected - All payment methods will be shown in popup');
                    console.log('💡 User can choose QRIS or any other payment method');
                    console.log('📝 Message:', data.message);
                } else if (data.selected_method && data.selected_method !== 'all') {
                    console.log('🎯 Payment Method Restricted to:', data.selected_method);
                    console.log('📝 Message:', data.message);
                } else {
                    console.log('💳 All available payment methods will be shown in Snap popup');
                }

                if (data.success && data.snap_token) {
                    console.log('Opening Snap popup with token:', data.snap_token);
                    if (data.selected_method === 'qris') {
                        console.log('🔗 Snap URL will show ALL methods (user can choose QRIS or others)');
                    } else {
                        console.log('🔗 Snap URL will show only:', data.selected_method || 'all methods');
                    }

                    // Check if snap is available
                    if (typeof snap !== 'undefined') {
                        // Open Midtrans payment popup
                        snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                console.log('Payment success:', result);
                                alert('Pembayaran berhasil! Terima kasih atas pesanan Anda.');
                                window.location.href = '{{ route("home") }}';
                            },
                            onPending: function(result) {
                                console.log('Payment pending:', result);
                                alert('Pembayaran sedang diproses. Silakan selesaikan pembayaran.');
                                window.location.href = '{{ route("home") }}';
                            },
                            onError: function(result) {
                                console.log('Payment error:', result);
                                alert('Pembayaran gagal. Silakan coba lagi.');
                                submitBtn.innerHTML = originalText;
                                submitBtn.disabled = false;
                            },
                            onClose: function() {
                                console.log('Payment popup closed');
                                alert('Pembayaran dibatalkan.');
                                submitBtn.innerHTML = originalText;
                                submitBtn.disabled = false;
                            }
                        });
                    } else {
                        console.error('Snap.js is not loaded');
                        alert('Terjadi kesalahan: Snap.js tidak dimuat. Silakan refresh halaman.');
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                } else {
                    console.error('Midtrans response error:', data);
                    alert('Terjadi kesalahan: ' + (data.message || 'Gagal mempersiapkan pembayaran'));
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Terjadi kesalahan saat mempersiapkan pembayaran. Silakan coba lagi.');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        }
    </script>
@endpush
