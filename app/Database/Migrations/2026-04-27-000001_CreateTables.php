<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // ================= ADMIN =================
        $this->forge->addField([
            'id_admin' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('admin');

        // ================= ANGGOTA =================
        $this->forge->addField([
            'id_anggota' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'kode_anggota' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'unique' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'kelas_jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_anggota', true);
        $this->forge->createTable('anggota');

        // ================= BUKU =================
        $this->forge->addField([
            'id_buku' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'kode_buku' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'unique' => true,
            ],
            'isbn' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'penulis' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'penerbit' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'tahun' => [
                'type' => 'YEAR',
                'null' => true,
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'lokasi_rak' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'jumlah_total' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'jumlah_tersedia' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_buku', true);
        $this->forge->createTable('buku');

        // ================= PEMINJAMAN =================
        $this->forge->addField([
            'id_peminjaman' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_anggota' => [
                'type' => 'INT',
            ],
            'tanggal_pinjam' => [
                'type' => 'DATE',
            ],
            'tanggal_jatuh_tempo' => [
                'type' => 'DATE',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_peminjaman', true);
        $this->forge->addForeignKey('id_anggota', 'anggota', 'id_anggota', 'CASCADE', 'CASCADE');
        $this->forge->createTable('peminjaman');

        // ================= DETAIL PEMINJAMAN =================
        $this->forge->addField([
            'id_detail' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_peminjaman' => [
                'type' => 'INT',
            ],
            'id_buku' => [
                'type' => 'INT',
            ],
            'status_buku' => [
                'type' => 'ENUM',
                'constraint' => ['dipinjam', 'kembali'],
                'default' => 'dipinjam',
            ],
            'tanggal_kembali' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'denda' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_detail', true);
        $this->forge->addForeignKey('id_peminjaman', 'peminjaman', 'id_peminjaman', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_buku', 'buku', 'id_buku', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_peminjaman');

        // ================= PENGATURAN =================
        $this->forge->addField([
            'id_pengaturan' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'maksimal_pinjam' => [
                'type' => 'INT',
                'default' => 3,
            ],
            'lama_pinjam' => [
                'type' => 'INT',
                'default' => 7,
            ],
            'denda_per_hari' => [
                'type' => 'INT',
                'default' => 1000,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_pengaturan', true);
        $this->forge->createTable('pengaturan');

        // Insert default pengaturan
        $this->db->table('pengaturan')->insert([
            'maksimal_pinjam' => 3,
            'lama_pinjam' => 7,
            'denda_per_hari' => 1000,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('detail_peminjaman', true);
        $this->forge->dropTable('peminjaman', true);
        $this->forge->dropTable('buku', true);
        $this->forge->dropTable('anggota', true);
        $this->forge->dropTable('admin', true);
        $this->forge->dropTable('pengaturan', true);
    }
}