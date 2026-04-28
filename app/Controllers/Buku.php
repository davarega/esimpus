<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    private BukuModel $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
        return view('buku/index', [
            'title' => 'Data Buku',
            'buku'  => $this->bukuModel->orderBy('judul', 'ASC')->findAll(),
        ]);
    }

    public function create()
    {
        return view('buku/form', [
            'title' => 'Tambah Buku',
            'buku'  => null,
        ]);
    }

    public function store()
    {
        $rules = $this->bukuModel->getValidationRules();
        $rules['gambar'] = 'permit_empty|is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]';

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambar = $this->uploadGambar();

        $jumlahTotal = (int) $this->request->getPost('jumlah_total');
        $jumlahTersedia = (int) $this->request->getPost('jumlah_tersedia');
        if ($jumlahTersedia > $jumlahTotal) {
            return redirect()->back()->withInput()->with('error', 'Jumlah tersedia tidak boleh melebihi jumlah total.');
        }

        $this->bukuModel->insert([
            'kode_buku'       => $this->request->getPost('kode_buku'),
            'isbn'            => $this->request->getPost('isbn'),
            'judul'           => $this->request->getPost('judul'),
            'penulis'         => $this->request->getPost('penulis'),
            'penerbit'        => $this->request->getPost('penerbit'),
            'tahun'           => $this->request->getPost('tahun') ?: null,
            'kategori'        => $this->request->getPost('kategori'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            'lokasi_rak'      => $this->request->getPost('lokasi_rak'),
            'gambar'          => $gambar,
            'jumlah_total'    => $jumlahTotal,
            'jumlah_tersedia' => $jumlahTersedia,
        ]);

        return redirect()->to('/buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $buku = $this->bukuModel->find($id);
        if (! $buku) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('buku/form', [
            'title' => 'Edit Buku',
            'buku'  => $buku,
        ]);
    }

    public function update(int $id)
    {
        $buku = $this->bukuModel->find($id);
        if (! $buku) {
            return redirect()->to('/buku')->with('error', 'Data buku tidak ditemukan.');
        }

        $rules = $this->bukuModel->getValidationRules();
        $rules['gambar'] = 'permit_empty|is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]';

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $jumlahTotal = (int) $this->request->getPost('jumlah_total');
        $jumlahTersedia = (int) $this->request->getPost('jumlah_tersedia');
        if ($jumlahTersedia > $jumlahTotal) {
            return redirect()->back()->withInput()->with('error', 'Jumlah tersedia tidak boleh melebihi jumlah total.');
        }

        $gambar = $buku['gambar'];
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $gambar = $this->uploadGambar();
            if ($buku['gambar'] && is_file(FCPATH . 'uploads/buku/' . $buku['gambar'])) {
                unlink(FCPATH . 'uploads/buku/' . $buku['gambar']);
            }
        }

        $this->bukuModel->update($id, [
            // 'kode_buku'       => $this->request->getPost('kode_buku'),
            'isbn'            => $this->request->getPost('isbn'),
            'judul'           => $this->request->getPost('judul'),
            'penulis'         => $this->request->getPost('penulis'),
            'penerbit'        => $this->request->getPost('penerbit'),
            'tahun'           => $this->request->getPost('tahun') ?: null,
            'kategori'        => $this->request->getPost('kategori'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            'lokasi_rak'      => $this->request->getPost('lokasi_rak'),
            'gambar'          => $gambar,
            'jumlah_total'    => $jumlahTotal,
            'jumlah_tersedia' => $jumlahTersedia,
        ]);

        return redirect()->to('/buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $buku = $this->bukuModel->find($id);
        if (! $buku) {
            return redirect()->to('/buku')->with('error', 'Data buku tidak ditemukan.');
        }

        if ($buku['gambar'] && is_file(FCPATH . 'uploads/buku/' . $buku['gambar'])) {
            unlink(FCPATH . 'uploads/buku/' . $buku['gambar']);
        }

        $this->bukuModel->delete($id);
        return redirect()->to('/buku')->with('success', 'Buku berhasil dihapus.');
    }

    private function uploadGambar(): ?string
    {
        $file = $this->request->getFile('gambar');
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        $filename = $file->getRandomName();
        $file->move(FCPATH . 'uploads/buku', $filename);

        return $filename;
    }
}
