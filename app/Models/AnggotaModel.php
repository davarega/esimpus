<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota';
    protected $primaryKey       = 'id_anggota';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_anggota', 'nama', 'kelas_jabatan'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'kode_anggota'  => 'required|max_length[30]|is_unique[anggota.kode_anggota,id_anggota,{id_anggota}]',
        'nama'          => 'required|max_length[100]',
        'kelas_jabatan' => 'required|max_length[100]',
    ];
}
