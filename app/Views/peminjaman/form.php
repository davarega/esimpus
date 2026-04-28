<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>

<h2 class="text-2xl font-semibold mb-4">Transaksi Peminjaman</h2>

<div class="bg-blue-50 text-blue-700 p-3 rounded mb-4 text-sm">
    Maksimal pinjam: <b><?= (int) ($pengaturan['maksimal_pinjam'] ?? 3) ?></b> buku, lama pinjam: <b><?= (int) ($pengaturan['lama_pinjam'] ?? 7) ?></b> hari.
</div>

<form method="post" action="/peminjaman/store" class="bg-white rounded shadow p-5 space-y-4">
    <?= csrf_field() ?>

    <div>
        <label class="block mb-1">Anggota</label>
        <select name="id_anggota" class="border p-2 rounded w-full" required>
            <option value="">Pilih anggota...</option>
            <?php foreach ($anggota as $a): ?>
                <option value="<?= $a['id_anggota'] ?>" <?= old('id_anggota') == $a['id_anggota'] ? 'selected' : '' ?>>
                    <?= esc($a['nama']) ?> (<?= esc($a['kode_anggota']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label class="block mb-2">Pilih Buku (maksimal <?= (int) ($pengaturan['maksimal_pinjam'] ?? 3) ?>)</label>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <?php foreach ($buku as $b): ?>
                <label class="border rounded p-3 flex items-start gap-2">
                    <input type="checkbox" name="id_buku[]" value="<?= $b['id_buku'] ?>">
                    <span>
                        <b><?= esc($b['judul']) ?></b><br>
                        <small class="text-gray-500">Stok tersedia: <?= (int) $b['jumlah_tersedia'] ?></small>
                    </span>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
    <a href="/peminjaman" class="ml-2 text-gray-600">Kembali</a>
</form>

<?= view('layout/footer') ?>
