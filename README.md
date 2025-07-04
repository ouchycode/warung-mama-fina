# 🌾 Warung Mama Fina

*Warung Mama Fina* adalah website toko kelontong online sederhana yang dibangun menggunakan *Laravel* dan *Tailwind CSS*. Website ini memungkinkan pelanggan untuk menjelajahi produk kebutuhan harian dan memesan secara online dengan tampilan yang bersih, modern, dan mobile-friendly.

🔗 Live Demo: [https://kevin-ardiansyah.my.id](https://kevin-ardiansyah.my.id)

---

## 🛠 Teknologi yang Digunakan

- ⚙ [Laravel 11.x](https://laravel.com/) — PHP Framework Modern
- 🎨 [Tailwind CSS](https://tailwindcss.com/) — Utility-first CSS framework
- 🧩 Blade Templating Engine
- 🗃 MySQL / MariaDB
- 🌐 Responsive Web Design

---

## ✨ Fitur Utama

- Halaman Beranda yang menarik
- Katalog Produk
- Detail Produk
- Form Kontak
- Panel Admin
- Autentikasi Pengguna
- Desain ringan & responsif

---

## ⚙ Cara Menjalankan Proyek Secara Lokal

### 1. Clone repository & masuk folder project

```bash
git clone https://github.com/kevin-ardiansyah/warung-mama-fina.git
cd warung-mama-fina
```


### 2. Install dependency Laravel dan Tailwind

```bash
composer install
npm install
npm run dev
```

### 3. Setup environment dan generate key
```bash
cp .env.example .env
php artisan key:generate
```


### 4. Konfigurasi database (di file .env)
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=warung_mamafina
DB_USERNAME=root
DB_PASSWORD=
```


### 5. (Opsional) Jalankan migrasi database
```bash
php artisan migrate
```


### 6. Jalankan server lokal
```bash
php artisan serve
```
