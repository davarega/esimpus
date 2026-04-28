<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>

<h2 class="text-2xl font-semibold mb-4"><?= esc($title) ?></h2>
<?php $isEdit = !empty($anggota); ?>
<form method="post" action="<?= $isEdit ? '/anggota/update/' . $anggota['id_anggota'] : '/anggota/store' ?>" class="bg-white rounded shadow p-5 space-y-4 max-w-2xl">
    <?= csrf_field() ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded">
            <?php foreach (session()->getFlashdata('errors') as $e): ?>
                <div>- <?= esc($e) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <input name="kode_anggota" value="<?= old('kode_anggota', $anggota['kode_anggota'] ?? '') ?>" placeholder="Kode Anggota" class="border p-2 rounded w-full" required>
    <input name="nama" value="<?= old('nama', $anggota['nama'] ?? '') ?>" placeholder="Nama" class="border p-2 rounded w-full" required>
    <input name="kelas_jabatan" value="<?= old('kelas_jabatan', $anggota['kelas_jabatan'] ?? '') ?>" placeholder="Kelas/Jabatan" class="border p-2 rounded w-full" required>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="/anggota" class="ml-2 text-gray-600">Kembali</a>
</form>

<?= view('layout/footer') ?>
