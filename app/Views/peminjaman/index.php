<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>

<div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-semibold">Data Peminjaman</h2>
    <a href="/peminjaman/create" class="bg-blue-600 text-white px-4 py-2 rounded">+ Transaksi Baru</a>
</div>

<div class="bg-white rounded shadow overflow-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-3 py-2 text-left">ID</th>
                <th class="px-3 py-2 text-left">Anggota</th>
                <th class="px-3 py-2 text-left">Tanggal Pinjam</th>
                <th class="px-3 py-2 text-left">Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peminjaman as $row): ?>
                <tr class="border-t">
                    <td class="px-3 py-2">#<?= (int) $row['id_peminjaman'] ?></td>
                    <td class="px-3 py-2"><?= esc($row['nama']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['tanggal_pinjam']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['tanggal_jatuh_tempo']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= view('layout/footer') ?>
