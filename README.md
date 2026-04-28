# Sistem Manajemen Perpustakaan Sekolah (CodeIgniter 4)

## Stack
- CodeIgniter 4 (MVC)
- MySQL
- Tailwind CSS (CDN)

## Modul
- Manajemen Buku (CRUD + upload gambar)
- Manajemen Anggota (CRUD)
- Peminjaman (multi-buku, maksimal dari pengaturan, stok aman)
- Pengembalian per buku (denda otomatis)
- Pengaturan sistem
- Laporan (buku, dipinjam, riwayat, denda)

## Setup singkat
1. Buat project CI4 lalu salin folder `app/` dari repo ini.
2. Import `database/schema.sql`.
3. Atur `.env` DB (`database.default.hostname`, `database.default.database`, `database.default.username`, `database.default.password`).
4. Pastikan folder upload ada: `public/uploads/buku`.
5. Jalankan `php spark serve` lalu buka `http://localhost:8080`.
