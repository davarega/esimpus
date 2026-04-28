<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>

<h2 class="text-2xl font-semibold mb-4">Pengaturan Sistem</h2>

<form method="post" action="/pengaturan/update" class="bg-white rounded shadow p-5 space-y-4 max-w-xl">
    <?= csrf_field() ?>

    <div>
        <label class="block mb-1">Maksimal Pinjam</label>
        <input type="number" min="1" name="maksimal_pinjam" value="<?= old('maksimal_pinjam', $pengaturan['maksimal_pinjam'] ?? 3) ?>" class="border p-2 rounded w-full" required>
    </div>

    <div>
        <label class="block mb-1">Lama Pinjam (hari)</label>
        <input type="number" min="1" name="lama_pinjam" value="<?= old('lama_pinjam', $pengaturan['lama_pinjam'] ?? 7) ?>" class="border p-2 rounded w-full" required>
    </div>

    <div>
        <label class="block mb-1">Denda per Hari</label>
        <input type="number" min="0" name="denda_per_hari" value="<?= old('denda_per_hari', $pengaturan['denda_per_hari'] ?? 1000) ?>" class="border p-2 rounded w-full" required>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Pengaturan</button>
</form>

<?= view('layout/footer') ?>
