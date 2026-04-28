<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id_buku';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_buku',
        'isbn',
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'kategori',
        'deskripsi',
        'lokasi_rak',
        'gambar',
        'jumlah_total',
        'jumlah_tersedia',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'kode_buku'       => 'required|max_length[30]|is_unique[buku.kode_buku,id_buku,{id_buku}]',
        'judul'           => 'required|max_length[200]',
        'penulis'         => 'required|max_length[100]',
        'tahun'           => 'permit_empty|integer|greater_than[1900]|less_than_equal_to[2100]',
        'jumlah_total'    => 'required|integer|greater_than_equal_to[0]',
        'jumlah_tersedia' => 'required|integer|greater_than_equal_to[0]',
    ];
}
