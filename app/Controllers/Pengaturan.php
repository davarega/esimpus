<?php

namespace App\Controllers;

use App\Models\PengaturanModel;

class Pengaturan extends BaseController
{
    public function index()
    {
        $model = new PengaturanModel();
        $pengaturan = $model->first();

        return view('pengaturan/index', [
            'title'      => 'Pengaturan Sistem',
            'pengaturan' => $pengaturan,
        ]);
    }

    public function update()
    {
        $rules = [
            'maksimal_pinjam' => 'required|integer|greater_than[0]|less_than_equal_to[10]',
            'lama_pinjam'     => 'required|integer|greater_than[0]|less_than_equal_to[60]',
            'denda_per_hari'  => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new PengaturanModel();
        $pengaturan = $model->first();

        $data = [
            'maksimal_pinjam' => (int) $this->request->getPost('maksimal_pinjam'),
            'lama_pinjam'     => (int) $this->request->getPost('lama_pinjam'),
            'denda_per_hari'  => (int) $this->request->getPost('denda_per_hari'),
        ];

        if ($pengaturan) {
            $model->update($pengaturan['id_pengaturan'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to('/pengaturan')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
