<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_peminjaman';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_anggota', 'tanggal_pinjam', 'tanggal_jatuh_tempo'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
