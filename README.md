# KebumenGo

Frontend prototype berbasis PHP sederhana dengan routing minimal.

## Menjalankan di lokal
1. Pastikan PHP 8.1+ terpasang.
2. Jalankan server lokal:

```bash
php -S localhost:8000
```

3. Buka `http://localhost:8000`.

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
