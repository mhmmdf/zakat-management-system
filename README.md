# Zakat Management System

Digital Zakat Fitrah Management System for Mosques.

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.1%2B-777BB4?style=flat&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Laravel-10-FF2D20?style=flat&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/MySQL-SQLite-4479A1?style=flat&logo=mysql" alt="Database">
  <img src="https://img.shields.io/badge/license-MIT-green" alt="License">
</p>

---

## Why This App?

Managing zakat fitrah with spreadsheets is painful. This app was built for real mosque needs:

- Manage muzakki (zakat payers) and mustahik (zakat recipients) data
- Record zakat collection (rice & money) with automatic stock updates
- Distribute zakat to recipients with real-time stock validation
- Generate collection & distribution reports

---

## Features

| Feature | Description |
|---------|-------------|
| Master Data | Manage Muzakki, Mustahik, & Mustahik Categories |
| Zakat Collection | Record rice/money payments, auto-update stock |
| Zakat Distribution | Distribute to recipients, real-time stock validation |
| Reports | Collection & distribution recap ready to print |
| Articles & Gallery | Manage mosque website content |
| Auth System | Multi-user login with session management |

---

## Tech Stack

| Stack | Tech |
|-------|------|
| Backend | PHP 8.1+, Laravel 10 |
| Frontend | Tailwind CSS, Alpine.js, Vite |
| Database | MySQL / MariaDB / SQLite |
| UI Kit | Cuba Admin Template |

---

## Installation

### Prerequisites

```bash
php --version    # min 8.1
composer --version
node --version   # 16+
npm --version
```

### Quick Start (SQLite)

```bash
git clone https://github.com/mhmmdf/zakat-management-system.git
cd zakat-management-system

composer install
npm install && npm run build

cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan storage:link

php artisan serve
```

### MySQL Setup

```bash
git clone https://github.com/mhmmdf/zakat-management-system.git
cd zakat-management-system
composer install
npm install && npm run build

cp .env.example .env
php artisan key:generate
```

Edit `.env` to set your database credentials, create the database, then:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

### Default Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@admin.com` | `admin` |

Change the password after first login.

---

## Project Structure

```
├── app/
│   ├── Http/Controllers/Backend/
│   ├── Models/
│   └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── pages/backend/
│   ├── layouts/
│   ├── includes/backend/
│   └── auth/
├── routes/
│   ├── web.php
│   └── auth.php
└── public/
```

---

## Testing

```bash
php artisan test
```

CI is configured with GitHub Actions -- runs automatically on every push to `main`.

---

## Contributing

Pull requests are welcome. For major changes, please open an issue first.

1. Fork the project
2. Create your feature branch (`git checkout -b feat/amazing-feature`)
3. Commit (`git commit -m 'feat: add amazing feature'`)
4. Push (`git push origin feat/amazing-feature`)
5. Open a Pull Request

---

## License

MIT License -- see [LICENSE](LICENSE).

---

<p align="center">
  Built with love by <a href="https://github.com/mhmmdf">Muhammad Fikri Arzyah</a>
</p>
