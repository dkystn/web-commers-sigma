# Payment Images Setup

## Missing Images (CRITICAL - Required for Payment Page)
The following payment method images are missing from `public/custom/img/payments/`:
- `bca.png` - BCA Virtual Account
- `mandiri.png` - Mandiri Virtual Account
- `bni.png` - BNI Virtual Account
- `bri.png` - BRI Virtual Account
- `gopay.png` - GoPay e-wallet
- `shopeepay.png` - ShopeePay e-wallet
- `qris.png` - QRIS payment method

## Current Images Available:
- ✅ dana.png
- ✅ mastercard.png
- ✅ ovo.png
- ✅ visa.png

## How to Add Missing Images:
1. Download official payment method logos from their respective websites
2. Resize images to consistent dimensions (e.g., 100x50px)
3. Save as PNG with transparent background
4. Place in `public/custom/img/payments/` directory

## QRIS Image Note:
For QRIS, you can:
- Use the official QRIS logo from Bank Indonesia website
- Create a simple QR code icon
- Download from: https://www.qris.id/

## Impact of Missing Images:
- Payment page will show broken image icons
- Users won't see payment method logos
- Professional appearance is compromised

## Alternative Solution:
If you can't find official logos, you can temporarily:
1. Create placeholder images with text labels
2. Use generic icons for each payment method
3. Comment out image references in the code until proper logos are available
