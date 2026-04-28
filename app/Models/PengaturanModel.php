<?php
namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table            = 'pengaturan';
    protected $primaryKey       = 'id_pengaturan';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['maksimal_pinjam', 'lama_pinjam', 'denda_per_hari'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}