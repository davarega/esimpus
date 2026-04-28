<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\DetailPeminjamanModel;
use App\Models\PengaturanModel;
use Config\Database;

class Pengembalian extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        $belumKembali = $db->table('detail_peminjaman dp')
            ->select('dp.id_detail, dp.id_buku, b.judul, a.nama, p.tanggal_pinjam, p.tanggal_jatuh_tempo')
            ->join('peminjaman p', 'p.id_peminjaman = dp.id_peminjaman')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->join('buku b', 'b.id_buku = dp.id_buku')
            ->where('dp.status_buku', 'dipinjam')
            ->orderBy('p.tanggal_jatuh_tempo', 'ASC')
            ->get()
            ->getResultArray();

        return view('pengembalian/index', [
            'title'          => 'Pengembalian Buku',
            'belumKembali'   => $belumKembali,
        ]);
    }

    public function kembalikan(int $idDetail)
    {
        $detailModel = new DetailPeminjamanModel();
        $bukuModel = new BukuModel();
        $pengaturan = (new PengaturanModel())->first();

        $detail = $detailModel
            ->select('detail_peminjaman.*, peminjaman.tanggal_jatuh_tempo')
            ->join('peminjaman', 'peminjaman.id_peminjaman = detail_peminjaman.id_peminjaman')
            ->where('detail_peminjaman.id_detail', $idDetail)
            ->first();

        if (! $detail) {
            return redirect()->back()->with('error', 'Detail peminjaman tidak ditemukan.');
        }

        if ($detail['status_buku'] === 'kembali') {
            return redirect()->back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        $today = date('Y-m-d');
        $dueDate = $detail['tanggal_jatuh_tempo'];
        $dendaPerHari = (int) ($pengaturan['denda_per_hari'] ?? 1000);

        $terlambatHari = 0;
        if ($today > $dueDate) {
            $terlambatHari = (new \DateTime($dueDate))->diff(new \DateTime($today))->days;
        }
        $denda = $terlambatHari * $dendaPerHari;

        $db = Database::connect();
        $db->transBegin();

        try {
            $detailModel->update($idDetail, [
                'status_buku'    => 'kembali',
                'tanggal_kembali' => $today,
                'denda'          => $denda,
            ]);

            $buku = $bukuModel->find((int) $detail['id_buku']);
            if (! $buku) {
                throw new \RuntimeException('Data buku terkait tidak ditemukan.');
            }

            $bukuModel->update((int) $detail['id_buku'], [
                'jumlah_tersedia' => (int) $buku['jumlah_tersedia'] + 1,
            ]);

            if (! $db->transStatus()) {
                throw new \RuntimeException('Transaksi pengembalian gagal.');
            }

            $db->transCommit();
            return redirect()->to('/pengembalian')->with('success', "Pengembalian berhasil. Denda: Rp {$denda}");
        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->to('/pengembalian')->with('error', $e->getMessage());
        }
    }
}
