# KebumenGo

Frontend prototype berbasis PHP sederhana dengan routing minimal.

## Menjalankan di lokal

### Opsi 1: Dengan Docker (Recommended)
1. Pastikan Docker dan Docker Compose terpasang.
2. Buat file `.env` dari `.env.example`:
   ```bash
   cp .env.example .env
   ```
3. Jalankan setup:
   ```bash
   chmod +x docker-setup.sh
   ./docker-setup.sh
   ```
   Atau langsung dengan:
   ```bash
   docker-compose up -d
   ```
4. Buka aplikasi di `http://localhost:8000` dan phpMyAdmin di `http://localhost:8081`.

### Opsi 2: Tanpa Docker (Local PHP)
1. Pastikan PHP 8.1+ dan MySQL terpasang.
2. Jalankan server lokal:

```bash
php -S localhost:8000
```

3. Buka `http://localhost:8000`.

### Opsi 3: Dengan XAMPP (Local Apache & MySQL)
1. Salin seluruh folder proyek `KebumenGo` ke dalam direktori `htdocs` XAMPP Anda:
   - Windows: `C:\xampp\htdocs\KebumenGo`
   - macOS: `/Applications/XAMPP/xamppfiles/htdocs/KebumenGo`
2. Jalankan **Apache** dan **MySQL** melalui Control Panel XAMPP.
3. Impor database proyek:
   - Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`.
   - Buat database baru bernama `kebumengo`.
   - Pilih database tersebut, masuk ke tab **Import**, pilih berkas SQL di `database/kebumengo.sql`, lalu klik **Import**.
4. Buat file konfigurasi `.env` dari `.env.example`:
   - Ubah isi `.env` bagian database agar sesuai dengan setup MySQL bawaan XAMPP Anda:
     ```env
     DB_HOST=localhost
     DB_PORT=3306
     DB_NAME=kebumengo
     DB_USER=root
     DB_PASS=
     ```
5. Akses aplikasi melalui browser di URL: `http://localhost/KebumenGo/`.

## 🐳 Docker & phpMyAdmin

### Akses phpMyAdmin
Saat menggunakan Docker, phpMyAdmin dapat diakses di: **http://localhost:8081**

#### Login Credentials untuk phpMyAdmin:
- **Username:** `user`
- **Password:** `password`

Atau dengan akun root:
- **Username:** `root`
- **Password:** `password`

### Database Information
- **Host:** `mysql` (dalam Docker) atau `localhost` (dari host machine)
- **Port:** `3306`
- **Database:** `kebumengo`
- **User:** `user`
- **Password:** `password`

### Docker Commands
```bash
# Memulai containers
docker-compose up -d

# Melihat logs
docker-compose logs -f

# Menghentikan containers
docker-compose stop

# Menghapus containers
docker-compose down

# Restart containers
docker-compose restart

# Masuk ke MySQL container
docker-compose exec mysql mysql -u kebumengo_user -p kebumengo

# Masuk ke PHP container
docker-compose exec php sh
```

## Rute yang tersedia
- `/` (Beranda)
- `/destinasi` (Daftar destinasi)
- `/destinasi/{slug}` (Detail destinasi)
- `/rekomendasi` (Hasil rekomendasi budget)
- `/admin/login` (Panel admin)

## Demo login admin
- Email: admin@kebumengo.id
- Password: kebumen2026

## Catatan
- File SQL ada di `database/kebumengo.sql`.
- Frontend ini masih statis dan siap dihubungkan ke database.
