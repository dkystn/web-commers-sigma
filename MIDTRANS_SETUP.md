# Midtrans Payment Integration Setup

## Overview
Integrasi pembayaran Midtrans telah berhasil diimplementasikan dengan fitur:
- COD (Cash on Delivery)
- Midtrans Online Payment Gateway
- Multiple payment methods (Bank Transfer, E-Wallet, Credit Card)

## Files Created/Modified

### Controllers
- `app/Http/Controllers/PaymentController.php` - Handle COD and Midtrans payments
- `app/Http/Controllers/MidtransController.php` - Handle Midtrans notifications and redirects

### Views
- `resources/views/general/payment.blade.php` - Updated with Midtrans integration
- `resources/views/general/cart.blade.php` - Shopping cart page
- `resources/views/general/index.blade.php` - Homepage (already existed)

### Configuration
- `config/midtrans.php` - Midtrans configuration file
- `routes/api.php` - API routes for payment processing
- `routes/web.php` - Web routes including Midtrans callbacks

### Layout
- `resources/views/layout/app.blade.php` - Added Midtrans Snap.js SDK

## Environment Variables
Pastikan file `.env` memiliki konfigurasi Midtrans berikut:

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-SJTZU6a8k_ZQvhCA__xetwmb
MIDTRANS_CLIENT_KEY=SB-Mid-client-ydoeRccRG1sKnOeu
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

## QRIS Payment Integration
QRIS (Quick Response Code Indonesian Standard) memungkinkan pelanggan membayar menggunakan berbagai aplikasi e-wallet dan bank yang mendukung QRIS.

### Cara Kerja QRIS:
1. Sistem akan menghasilkan QR Code unik untuk setiap transaksi
2. Pelanggan memindai QR Code menggunakan aplikasi e-wallet/bank mereka
3. Pembayaran diproses secara real-time
4. Status pembayaran diperbarui otomatis

### Konfigurasi QRIS:
- QRIS sudah terintegrasi dengan Midtrans SDK
- Tidak memerlukan konfigurasi tambahan
- Akan muncul sebagai opsi pembayaran di Snap popup
- **QRIS**: Pembayaran menggunakan QR Code Indonesia Standard

## API Endpoints

### Payment Processing
- `POST /api/orders/cod` - Process COD orders
- `POST /api/orders/midtrans` - Create Midtrans transaction

### Midtrans Callbacks
- `POST /midtrans/notification` - Handle payment notifications
- `GET /midtrans/finish` - Success redirect
- `GET /midtrans/unfinish` - Unfinished payment redirect
- `GET /midtrans/error` - Error redirect

## Usage

### For COD Orders
1. User selects COD on payment page
2. Form data is sent to `/api/orders/cod`
3. Order is created and user gets success message

### For Midtrans Payments
1. User selects Midtrans payment method
2. Form data is sent to `/api/orders/midtrans`
3. Midtrans Snap popup opens for payment
4. Payment status is handled via notifications

## Required Images
Place these images in `public/custom/img/payments/`:
- `bca.png`
- `mandiri.png`
- `bni.png`
- `bri.png`
- `ovo.png`
- `dana.png`
- `gopay.png`
- `shopeepay.png`
- `qris.png` (untuk QRIS)
- `visa.png`
- `mastercard.png`

## Testing
1. Use sandbox credentials (already configured)
2. Test COD flow
3. Test Midtrans payment flow with various methods
4. Verify notification handling

## Troubleshooting
### Common Issues:
- **Snap popup tidak muncul**: Pastikan Snap.js ter-load dengan benar. Cek console untuk error JavaScript
- **midtransMethod is not defined**: Error ini sudah diperbaiki dengan variable scoping yang benar
- **QRIS tidak muncul**: Pastikan merchant mendukung QRIS di dashboard Midtrans
- **Payment failed**: Cek konfigurasi API key dan environment (sandbox/production)

### QRIS Specific Issues:
- **QR Code tidak muncul**: Pastikan merchant aktif dan mendukung QRIS
- **Pembayaran tidak terdeteksi**: Cek notification URL configuration
- **Aplikasi tidak mendukung QRIS**: Gunakan aplikasi yang terdaftar di QRIS

## Production Deployment
1. Change `MIDTRANS_IS_PRODUCTION=true`
2. Update server and client keys with production credentials
3. Configure notification URL in Midtrans dashboard
4. Test thoroughly before going live

## Security Notes
- All payment data is handled securely by Midtrans
- CSRF protection is enabled for forms
- Server-side validation is implemented
- Sensitive data is not stored locally

## Recent Updates
- ✅ Added QRIS payment method support
- ✅ Fixed JavaScript error "midtransMethod is not defined"
- ✅ Improved Snap.js loading with fallback mechanism
- ✅ Enhanced error handling for payment processing
- ✅ Added QRIS image requirement to documentation
- ✅ Updated troubleshooting section with QRIS-specific issues
