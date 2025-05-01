# KASIR APP LARAVEL

Aplikasi Laravel ini menyediakan fitur XYZ. Dokumen ini menjelaskan cara menjalankan aplikasi secara lokal.

---

## 🛠️ Persyaratan

Pastikan sistem Anda memenuhi persyaratan berikut:
- **PHP** (minimal versi yang didukung Laravel)
- **Composer** (manajer dependensi PHP)
- **Node.js & npm** (opsional, jika menggunakan frontend seperti Vue/React)
- **Database** (MySQL, PostgreSQL, SQLite, dll.)

---

## 🚀 Cara Instalasi

### 1. Clone Repositori
```bash
git clone https://github.com/MR-Munggaran/service-printe.git
cd service-printe
```
### 2. Instal Dependensi
```bash
composer install
```
### 3. Konfigurasi ENV
```bash
cp .env.example .env
php artisan key:generate
```
Buka file .env dan sesuaikan konfigurasi database (sesuai kebutuhan):
```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=services_printer
DB_USERNAME=root
DB_PASSWORD=
```
### 4. Migrasi Database
```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### 5. Running Webisite
```bash
php artisan serve
```
