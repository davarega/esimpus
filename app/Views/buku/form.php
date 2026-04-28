<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>

<h2 class="text-2xl font-semibold mb-4"><?= esc($title) ?></h2>

<?php $isEdit = !empty($buku); ?>
<form method="post" enctype="multipart/form-data" action="<?= $isEdit ? '/buku/update/' . $buku['id_buku'] : '/buku/store' ?>" class="bg-white rounded shadow p-5 space-y-4">
    <?= csrf_field() ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded">
            <?php foreach (session()->getFlashdata('errors') as $e): ?>
                <div>- <?= esc($e) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input name="kode_buku" value="<?= old('kode_buku', $buku['kode_buku'] ?? '') ?>" placeholder="Kode Buku" class="border p-2 rounded" required <?=  $isEdit ? 'readonly' : '' ?>>
        <input name="isbn" value="<?= old('isbn', $buku['isbn'] ?? '') ?>" placeholder="ISBN" class="border p-2 rounded">
        <input name="judul" value="<?= old('judul', $buku['judul'] ?? '') ?>" placeholder="Judul" class="border p-2 rounded" required>
        <input name="penulis" value="<?= old('penulis', $buku['penulis'] ?? '') ?>" placeholder="Penulis" class="border p-2 rounded" required>
        <input name="penerbit" value="<?= old('penerbit', $buku['penerbit'] ?? '') ?>" placeholder="Penerbit" class="border p-2 rounded">
        <input name="tahun" type="number" value="<?= old('tahun', $buku['tahun'] ?? '') ?>" placeholder="Tahun" class="border p-2 rounded">
        <input name="kategori" value="<?= old('kategori', $buku['kategori'] ?? '') ?>" placeholder="Kategori" class="border p-2 rounded">
        <input name="lokasi_rak" value="<?= old('lokasi_rak', $buku['lokasi_rak'] ?? '') ?>" placeholder="Lokasi Rak" class="border p-2 rounded">
        <input name="jumlah_total" type="number" min="0" value="<?= old('jumlah_total', $buku['jumlah_total'] ?? 0) ?>" placeholder="Jumlah Total" class="border p-2 rounded" required>
        <input name="jumlah_tersedia" type="number" min="0" value="<?= old('jumlah_tersedia', $buku['jumlah_tersedia'] ?? 0) ?>" placeholder="Jumlah Tersedia" class="border p-2 rounded" required>
    </div>

    <textarea name="deskripsi" placeholder="Deskripsi" class="border p-2 rounded w-full"><?= old('deskripsi', $buku['deskripsi'] ?? '') ?></textarea>

    <div>
        <label class="block mb-1 text-sm text-gray-600">Gambar Buku</label>
        <input type="file" name="gambar" class="border p-2 rounded w-full">
        <?php if ($isEdit && !empty($buku['gambar'])): ?>
            <img class="mt-2 h-32" src="/uploads/buku/<?= esc($buku['gambar']) ?>" alt="gambar buku">
        <?php endif; ?>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="/buku" class="ml-2 text-gray-600">Kembali</a>
</form>

<?= view('layout/footer') ?>
