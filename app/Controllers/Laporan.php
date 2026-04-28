<?php

namespace App\Controllers;

use Config\Database;

class Laporan extends BaseController
{
    public function buku()
    {
        $data = Database::connect()->table('buku')->orderBy('judul', 'ASC')->get()->getResultArray();

        return view('laporan/buku', [
            'title' => 'Laporan Semua Buku',
            'rows'  => $data,
        ]);
    }

    public function dipinjam()
    {
        $rows = Database::connect()->table('detail_peminjaman dp')
            ->select('a.nama, b.judul, p.tanggal_pinjam, p.tanggal_jatuh_tempo')
            ->join('peminjaman p', 'p.id_peminjaman = dp.id_peminjaman')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->join('buku b', 'b.id_buku = dp.id_buku')
            ->where('dp.status_buku', 'dipinjam')
            ->orderBy('p.tanggal_jatuh_tempo', 'ASC')
            ->get()->getResultArray();

        return view('laporan/dipinjam', [
            'title' => 'Buku Sedang Dipinjam',
            'rows'  => $rows,
        ]);
    }

    public function riwayat()
    {
        $rows = Database::connect()->table('detail_peminjaman dp')
            ->select('a.nama, b.judul, p.tanggal_pinjam, p.tanggal_jatuh_tempo, dp.tanggal_kembali, dp.status_buku, dp.denda')
            ->join('peminjaman p', 'p.id_peminjaman = dp.id_peminjaman')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->join('buku b', 'b.id_buku = dp.id_buku')
            ->orderBy('dp.id_detail', 'DESC')
            ->get()->getResultArray();

        return view('laporan/riwayat', [
            'title' => 'Riwayat Peminjaman',
            'rows'  => $rows,
        ]);
    }

    public function denda()
    {
        $rows = Database::connect()->table('detail_peminjaman dp')
            ->select('a.nama, b.judul, p.tanggal_jatuh_tempo, dp.tanggal_kembali, dp.denda')
            ->join('peminjaman p', 'p.id_peminjaman = dp.id_peminjaman')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->join('buku b', 'b.id_buku = dp.id_buku')
            ->where('dp.denda >', 0)
            ->orderBy('dp.tanggal_kembali', 'DESC')
            ->get()->getResultArray();

        return view('laporan/denda', [
            'title' => 'Laporan Denda Keterlambatan',
            'rows'  => $rows,
        ]);
    }
}
