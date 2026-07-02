<h1 align="center">Sistem Manajemen Zakat Fitrah Masjid</h1>

<p align="center">
  Aplikasi manajemen zakat fitrah berbasis web untuk pengelolaan data muzakki, mustahik, pengumpulan, dan distribusi zakat.
</p>

<p align="center">
  Dibuat dengan ❤️ oleh <a href="https://github.com/mhmmdf">Muhammad Fikri Arzyah</a>
</p>

## ✨ Fitur

- **Manajemen Muzakki** — Kelola data wajib zakat (muzakki)
- **Manajemen Mustahik** — Kelola data penerima zakat beserta kategorinya
- **Pengumpulan Zakat** — Catat pengumpulan zakat fitrah (beras/uang)
- **Distribusi Zakat** — Distribusikan zakat kepada mustahik dengan validasi stok
- **Laporan Pengumpulan** — Lihat rekap pengumpulan zakat
- **Laporan Distribusi** — Lihat rekap distribusi zakat
- **Artikel & Galeri** — Kelola konten website masjid

## 🛠️ Prasyarat

- PHP 8.1+
- Composer
- MySQL / MariaDB (atau SQLite untuk development)
- Node.js & NPM (untuk asset build)

## 🚀 Instalasi

```bash
# Clone repository
git clone https://github.com/mhmmdf/zakat-management-system.git
cd zakat-management-system

# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Buat database, lalu sesuaikan konfigurasi di .env

# Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# Install & build frontend assets
npm install && npm run build

# Buat storage link
php artisan storage:link

# Jalankan aplikasi
php artisan serve
```

### 📦 Opsional: Setup dengan SQLite (tanpa MySQL)

```bash
cp .env.example .env
sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env
sed -i 's/DB_HOST=/# DB_HOST=/' .env
sed -i 's/DB_PORT=/# DB_PORT=/' .env
sed -i 's/DB_DATABASE=/# DB_DATABASE=/' .env
sed -i 's/DB_USERNAME=/# DB_USERNAME=/' .env
sed -i 's/DB_PASSWORD=/# DB_PASSWORD=/' .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```

### 👤 Akun Default

Setelah menjalankan seeder, login dengan:
- **Email:** `ichsan@demo.dev`
- **Password:** `ucok`

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
