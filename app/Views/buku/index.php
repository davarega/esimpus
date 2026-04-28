<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>

<div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-semibold">Data Buku</h2>
    <a href="/buku/create" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah</a>
</div>

<div class="bg-white rounded shadow overflow-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-3 py-2 text-left">Kode</th>
                <th class="px-3 py-2 text-left">Judul</th>
                <th class="px-3 py-2 text-left">Penulis</th>
                <th class="px-3 py-2 text-left">Kategori</th>
                <th class="px-3 py-2 text-left">Stok</th>
                <th class="px-3 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($buku as $row): ?>
                <tr class="border-t">
                    <td class="px-3 py-2"><?= esc($row['kode_buku']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['judul']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['penulis']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['kategori']) ?></td>
                    <td class="px-3 py-2"><?= (int) $row['jumlah_tersedia'] ?> / <?= (int) $row['jumlah_total'] ?></td>
                    <td class="px-3 py-2 space-x-2">
                        <a class="text-blue-600" href="/buku/edit/<?= $row['id_buku'] ?>">Edit</a>
                        <a class="text-red-600" href="/buku/delete/<?= $row['id_buku'] ?>" onclick="return confirm('Hapus buku ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= view('layout/footer') ?>
