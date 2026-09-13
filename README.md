# Khalil & Sons Jewellers — Bespoke High-Jewellery & Bullion Platform

A bespoke, full-stack Laravel digital atelier built for Khalil & Sons Jewellers (Saddar, Karachi). Featuring a real-time Sarafa bullion pricing engine, AI CAD generation & 3D WebGL viewer, dynamic custom jewellery atelier, and an obsidian administrative suite.

---

## Turnkey Installation & Quick Start

This repository is fully packaged with pre-configured `.env`, pre-compiled Vite production assets, and an instantaneous database dump.

### Prerequisites
- PHP >= 8.2 with PDO MySQL & cURL extensions
- MySQL / MariaDB (e.g. XAMPP, MySQL Server)
- Composer

---

### Step-by-Step Setup

#### 1. Clone the Repository
```bash
git clone https://github.com/Konete326/khalil_and_sons.git
cd "khalil_and_sons"
```

#### 2. Install Dependencies
```bash
composer install
```

#### 3. Database Setup
Create the MySQL database:
```sql
CREATE DATABASE khalil_and_sons CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Import the turnkey database dump:
```bash
mysql -u root khalil_and_sons < database/khalil_and_sons.sql
```
*(Alternative: You can also run `php artisan migrate --seed`)*

#### 4. Pre-configured Environment
The repository includes `.env` ready to run out-of-the-box with default credentials:
- `DB_DATABASE=khalil_and_sons`
- `DB_USERNAME=root`
- `DB_PASSWORD=`
- Live API integrations (Google Gemini, Tripo3D, GoldAPI.io)

#### 5. Storage Symlink
```bash
php artisan storage:link
```

#### 6. Start the Server
```bash
php artisan serve
```
Visit the application at: `http://127.0.0.1:8000`

---

## Default Access Credentials

### Store Administrator Portal (`/login` or `/admin`)
- **Email:** `admin@gmail.com`
- **Password:** `admin123`
- **Access Level:** Master Administrator (Live Sarafa Override, Custom Orders & Slips, Atelier Inquiries, System Settings)

### Registered Patron Account (`/login`)
- **Email:** `patron.test@example.com`
- **Password:** `PatronSecret123!`

---

## Key Features

1. **Dynamic Sarafa Valuation Engine:**
   - Real-time bullion rates (24K, 22K, 21K, 18K, and Silver) per tola and per gram.
   - Client-verified pricing logic: Rs. 1,000/g plain making charges, Rs. 1,500/g stone-studded charges, stone deduction (> 1.5mm).
   - Dedicated Bullion Sheet (`/gold-rates`) with CSV export and print view.

2. **Custom Atelier & AI CAD Studio (`/custom-atelier`):**
   - Natural language jewellery prompt analysis powered by Google Gemini AI.
   - 3D model generation powered by Tripo3D with interactive Three.js/WebGL inspection.
   - Quotation request pipeline with slip upload.

3. **Collections & Showcase (`/collections`):**
   - Luxury Oxblood (`#460C0C`) and Antique Gold (`#D4AF37`) luxury design aesthetic.
   - Real-time multi-currency conversion (PKR, USD, AED, SAR, GBP).
   - Instant quotation modal and WhatsApp concierge integration.

4. **Obsidian Black Admin Suite (`/admin`):**
   - Interactive collapsible sidebar (desktop rail & mobile off-canvas drawer).
   - 1-click Sarafa rate override.
   - Order & payment verification pipeline with stage management.

---

## Pre-compiled Assets
Frontend assets (Tailwind CSS, Alpine.js, Lucide Icons, Three.js) are pre-compiled in `public/build/`. Running `npm run build` is not strictly required to run the project.

If you wish to make frontend modifications:
```bash
npm install
npm run dev
# or for production build
npm run build
```
