<div align="center">
  <img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&height=250&section=header&text=Portal%20Aspirasi%20DPRD&fontSize=50&fontAlignY=35" alt="Header Banner">

  # 🏛️ Sistem Informasi Aspirasi Masyarakat - DPRD Tapanuli Selatan
  
  **Membangun Jembatan Digital antara Masyarakat dan Wakil Rakyat** 🌉

  [![Laravel 12](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
  [![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
</div>

---

## 📖 Tentang Proyek
Sistem Informasi ini merupakan inisiatif *E-Government* yang dirancang khusus untuk Dewan Perwakilan Rakyat Daerah (DPRD) Tapanuli Selatan. Platform ini memfasilitasi transparansi dan komunikasi dua arah, memungkinkan masyarakat untuk mengajukan aspirasi, keluhan, atau saran secara digital, sekaligus memantau sejauh mana aspirasi tersebut diproses oleh dewan.

## ✨ Fitur Unggulan

- 📢 **Submission Aspirasi Publik**: Antarmuka responsif bagi masyarakat untuk mengirimkan aspirasi dengan cepat.
- ⏳ **Timeline Perkembangan Terperinci**: Pelacakan status aspirasi yang sangat transparan. Masyarakat dapat melihat log pembaruan secara *real-time* (Contoh: *"11 May 2026 - Aspirasi diterima dan sedang menunggu peninjauan oleh tim sekretariat"*).
- 🔐 **Sistem Keamanan Berlapis**: Dilengkapi dengan arsitektur *Role-Based Access Control* (RBAC), *Least Privilege*, serta Autentikasi Dua Faktor (2FA) untuk mengamankan data pengguna dan dashboard administrator.
- 📊 **Dashboard Analitik (Admin)**: Ringkasan data sentimen dan kategori aspirasi untuk membantu dewan mengambil keputusan berbasis data.

## 🛠️ Tech Stack & Infrastruktur

Sistem ini dibangun dengan arsitektur modern untuk memastikan skalabilitas dan keamanan tingkat tinggi:

- **Backend**: PHP 8.x, Laravel 12
- **Database**: MySQL
- **Frontend**: Blade Templating (dengan integrasi responsif)
- **Deployment/DevOps**: Mendukung kontainerisasi menggunakan Docker / Podman.

## 🚀 Panduan Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal menggunakan Laragon atau *local server* pilihanmu.

```bash
# 1. Clone repositori ini
git clone [https://github.com/username/repo-aspirasi-dprd.git](https://github.com/username/repo-aspirasi-dprd.git)

# 2. Masuk ke direktori proyek
cd repo-aspirasi-dprd

# 3. Instal semua dependensi PHP via Composer
composer install

# 4. Salin file environment dan generate application key
cp .env.example .env
php artisan key:generate

# 5. Konfigurasi Database di file .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=nama_database_kamu
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan Migrasi dan Seeder (jika ada)
php artisan migrate --seed

# 7. Jalankan local development server
php artisan serve
