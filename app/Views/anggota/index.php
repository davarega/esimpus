<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>

<div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-semibold">Data Anggota</h2>
    <a href="/anggota/create" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah</a>
</div>

<div class="bg-white rounded shadow overflow-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-3 py-2 text-left">Kode</th>
                <th class="px-3 py-2 text-left">Nama</th>
                <th class="px-3 py-2 text-left">Kelas/Jabatan</th>
                <th class="px-3 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anggota as $row): ?>
                <tr class="border-t">
                    <td class="px-3 py-2"><?= esc($row['kode_anggota']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['nama']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['kelas_jabatan']) ?></td>
                    <td class="px-3 py-2 space-x-2">
                        <a class="text-blue-600" href="/anggota/edit/<?= $row['id_anggota'] ?>">Edit</a>
                        <a class="text-red-600" href="/anggota/delete/<?= $row['id_anggota'] ?>" onclick="return confirm('Hapus anggota ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= view('layout/footer') ?>
