CREATE DATABASE IF NOT EXISTS perpustakaan_ci4;
USE perpustakaan_ci4;

CREATE TABLE admin (
  id_admin INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) UNIQUE,
  password VARCHAR(255),
  created_at DATETIME NULL,
  updated_at DATETIME NULL
);

CREATE TABLE anggota (
  id_anggota INT AUTO_INCREMENT PRIMARY KEY,
  kode_anggota VARCHAR(30) UNIQUE NOT NULL,
  nama VARCHAR(100) NOT NULL,
  kelas_jabatan VARCHAR(100) NOT NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL
);

CREATE TABLE buku (
  id_buku INT AUTO_INCREMENT PRIMARY KEY,
  kode_buku VARCHAR(30) UNIQUE NOT NULL,
  isbn VARCHAR(30),
  judul VARCHAR(200) NOT NULL,
  penulis VARCHAR(100) NOT NULL,
  penerbit VARCHAR(100),
  tahun YEAR,
  kategori VARCHAR(100),
  deskripsi TEXT,
  lokasi_rak VARCHAR(50),
  gambar VARCHAR(255),
  jumlah_total INT NOT NULL DEFAULT 0,
  jumlah_tersedia INT NOT NULL DEFAULT 0,
  created_at DATETIME NULL,
  updated_at DATETIME NULL
);

CREATE TABLE peminjaman (
  id_peminjaman INT AUTO_INCREMENT PRIMARY KEY,
  id_anggota INT NOT NULL,
  tanggal_pinjam DATE NOT NULL,
  tanggal_jatuh_tempo DATE NOT NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT fk_peminjaman_anggota FOREIGN KEY (id_anggota) REFERENCES anggota(id_anggota)
);

CREATE TABLE detail_peminjaman (
  id_detail INT AUTO_INCREMENT PRIMARY KEY,
  id_peminjaman INT NOT NULL,
  id_buku INT NOT NULL,
  status_buku ENUM('dipinjam','kembali') NOT NULL DEFAULT 'dipinjam',
  tanggal_kembali DATE NULL,
  denda INT NOT NULL DEFAULT 0,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  CONSTRAINT fk_detail_peminjaman FOREIGN KEY (id_peminjaman) REFERENCES peminjaman(id_peminjaman),
  CONSTRAINT fk_detail_buku FOREIGN KEY (id_buku) REFERENCES buku(id_buku)
);

CREATE TABLE pengaturan (
  id_pengaturan INT AUTO_INCREMENT PRIMARY KEY,
  maksimal_pinjam INT NOT NULL DEFAULT 3,
  lama_pinjam INT NOT NULL DEFAULT 7,
  denda_per_hari INT NOT NULL DEFAULT 1000,
  created_at DATETIME NULL,
  updated_at DATETIME NULL
);

INSERT INTO pengaturan (maksimal_pinjam, lama_pinjam, denda_per_hari, created_at, updated_at)
VALUES (3, 7, 1000, NOW(), NOW());
