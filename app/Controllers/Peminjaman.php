<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\DetailPeminjamanModel;
use App\Models\PeminjamanModel;
use App\Models\PengaturanModel;
use Config\Database;

class Peminjaman extends BaseController
{
    public function index()
    {
        $db = Database::connect();
        $data = $db->table('peminjaman p')
            ->select('p.id_peminjaman, a.nama, p.tanggal_pinjam, p.tanggal_jatuh_tempo')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->orderBy('p.id_peminjaman', 'DESC')
            ->get()
            ->getResultArray();

        return view('peminjaman/index', [
            'title'       => 'Data Peminjaman',
            'peminjaman'  => $data,
        ]);
    }

    public function create()
    {
        $anggota = (new AnggotaModel())->orderBy('nama', 'ASC')->findAll();
        $buku = (new BukuModel())
            ->where('jumlah_tersedia >', 0)
            ->orderBy('judul', 'ASC')
            ->findAll();
        $pengaturan = (new PengaturanModel())->first();

        return view('peminjaman/form', [
            'title'      => 'Transaksi Peminjaman',
            'anggota'    => $anggota,
            'buku'       => $buku,
            'pengaturan' => $pengaturan,
        ]);
    }

    public function store()
    {
        $anggotaId = (int) $this->request->getPost('id_anggota');
        $bukuIds = array_values(array_unique(array_map('intval', $this->request->getPost('id_buku') ?? [])));

        $pengaturanModel = new PengaturanModel();
        $pengaturan = $pengaturanModel->first();
        $maksimalPinjam = (int) ($pengaturan['maksimal_pinjam'] ?? 3);
        $lamaPinjam = (int) ($pengaturan['lama_pinjam'] ?? 7);

        if ($anggotaId <= 0) {
            return redirect()->back()->withInput()->with('error', 'Anggota wajib dipilih.');
        }

        if (count($bukuIds) < 1) {
            return redirect()->back()->withInput()->with('error', 'Pilih minimal 1 buku.');
        }

        if (count($bukuIds) > $maksimalPinjam) {
            return redirect()->back()->withInput()->with('error', "Maksimal {$maksimalPinjam} buku per transaksi.");
        }

        $db = Database::connect();
        $bukuModel = new BukuModel();
        $peminjamanModel = new PeminjamanModel();
        $detailModel = new DetailPeminjamanModel();

        $tanggalPinjam = date('Y-m-d');
        $tanggalJatuhTempo = date('Y-m-d', strtotime("+{$lamaPinjam} days"));

        $db->transBegin();

        try {
            foreach ($bukuIds as $idBuku) {
                $buku = $bukuModel->find($idBuku);
                if (! $buku) {
                    throw new \RuntimeException("Buku ID {$idBuku} tidak ditemukan.");
                }
                if ((int) $buku['jumlah_tersedia'] <= 0) {
                    throw new \RuntimeException("Stok buku {$buku['judul']} habis.");
                }
            }

            $peminjamanModel->insert([
                'id_anggota'          => $anggotaId,
                'tanggal_pinjam'      => $tanggalPinjam,
                'tanggal_jatuh_tempo' => $tanggalJatuhTempo,
            ]);

            $idPeminjaman = (int) $peminjamanModel->getInsertID();

            foreach ($bukuIds as $idBuku) {
                $detailModel->insert([
                    'id_peminjaman' => $idPeminjaman,
                    'id_buku'       => $idBuku,
                    'status_buku'   => 'dipinjam',
                ]);

                $buku = $bukuModel->find($idBuku);
                $stokBaru = (int) $buku['jumlah_tersedia'] - 1;
                if ($stokBaru < 0) {
                    throw new \RuntimeException('Stok minus terdeteksi.');
                }
                $bukuModel->update($idBuku, ['jumlah_tersedia' => $stokBaru]);
            }

            if (! $db->transStatus()) {
                throw new \RuntimeException('Transaksi database gagal.');
            }

            $db->transCommit();
            return redirect()->to('/peminjaman')->with('success', 'Transaksi peminjaman berhasil disimpan.');
        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
