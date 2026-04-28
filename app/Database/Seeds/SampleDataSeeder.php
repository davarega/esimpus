<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // ================= ANGGOTA =================
        $anggota = [
            [
                'kode_anggota' => 'AG001',
                'nama' => 'Budi Santoso',
                'kelas_jabatan' => 'Siswa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_anggota' => 'AG002',
                'nama' => 'Siti Aminah',
                'kelas_jabatan' => 'Mahasiswa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_anggota' => 'AG003',
                'nama' => 'Andi Wijaya',
                'kelas_jabatan' => 'Pegawai',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('anggota')->insertBatch($anggota);

        // ================= BUKU =================
        $buku = [
            [
                'kode_buku' => 'BK001',
                'isbn' => '9786020324788',
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun' => 2005,
                'kategori' => 'Novel',
                'deskripsi' => 'Kisah inspiratif anak-anak Belitung.',
                'lokasi_rak' => 'A1',
                'gambar' => null,
                'jumlah_total' => 5,
                'jumlah_tersedia' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_buku' => 'BK002',
                'isbn' => '9789793062792',
                'judul' => 'Bumi',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia',
                'tahun' => 2014,
                'kategori' => 'Fantasi',
                'deskripsi' => 'Petualangan dunia paralel.',
                'lokasi_rak' => 'A2',
                'gambar' => null,
                'jumlah_total' => 4,
                'jumlah_tersedia' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_buku' => 'BK003',
                'isbn' => '9786022916622',
                'judul' => 'Negeri 5 Menara',
                'penulis' => 'Ahmad Fuadi',
                'penerbit' => 'Gramedia',
                'tahun' => 2009,
                'kategori' => 'Motivasi',
                'deskripsi' => 'Cerita perjuangan santri.',
                'lokasi_rak' => 'B1',
                'gambar' => null,
                'jumlah_total' => 3,
                'jumlah_tersedia' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_buku' => 'BK004',
                'isbn' => '9786020323064',
                'judul' => 'Ayat-Ayat Cinta',
                'penulis' => 'Habiburrahman El Shirazy',
                'penerbit' => 'Republika',
                'tahun' => 2004,
                'kategori' => 'Religi',
                'deskripsi' => 'Novel religi romantis.',
                'lokasi_rak' => 'B2',
                'gambar' => null,
                'jumlah_total' => 6,
                'jumlah_tersedia' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_buku' => 'BK005',
                'isbn' => '9786024246949',
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia',
                'tahun' => 2018,
                'kategori' => 'Pengembangan Diri',
                'deskripsi' => 'Strategi membangun kebiasaan baik.',
                'lokasi_rak' => 'C1',
                'gambar' => null,
                'jumlah_total' => 2,
                'jumlah_tersedia' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('buku')->insertBatch($buku);
    }
}