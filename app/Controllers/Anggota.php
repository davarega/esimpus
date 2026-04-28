<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    private AnggotaModel $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        return view('anggota/index', [
            'title'   => 'Data Anggota',
            'anggota' => $this->anggotaModel->orderBy('nama', 'ASC')->findAll(),
        ]);
    }

    public function create()
    {
        return view('anggota/form', [
            'title'   => 'Tambah Anggota',
            'anggota' => null,
        ]);
    }

    public function store()
    {
        if (! $this->validate($this->anggotaModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->anggotaModel->insert($this->request->getPost(['kode_anggota', 'nama', 'kelas_jabatan']));
        return redirect()->to('/anggota')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $anggota = $this->anggotaModel->find($id);
        if (! $anggota) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('anggota/form', [
            'title'   => 'Edit Anggota',
            'anggota' => $anggota,
        ]);
    }

    public function update(int $id)
    {
        if (! $this->validate($this->anggotaModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->anggotaModel->update($id, $this->request->getPost(['kode_anggota', 'nama', 'kelas_jabatan']));
        return redirect()->to('/anggota')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $this->anggotaModel->delete($id);
        return redirect()->to('/anggota')->with('success', 'Anggota berhasil dihapus.');
    }
}
