<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>

<h2 class="text-2xl font-semibold mb-4">Pengembalian Buku (Per Buku)</h2>

<div class="bg-white rounded shadow overflow-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-3 py-2 text-left">Anggota</th>
                <th class="px-3 py-2 text-left">Judul Buku</th>
                <th class="px-3 py-2 text-left">Tanggal Pinjam</th>
                <th class="px-3 py-2 text-left">Jatuh Tempo</th>
                <th class="px-3 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($belumKembali as $row): ?>
                <tr class="border-t">
                    <td class="px-3 py-2"><?= esc($row['nama']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['judul']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['tanggal_pinjam']) ?></td>
                    <td class="px-3 py-2"><?= esc($row['tanggal_jatuh_tempo']) ?></td>
                    <td class="px-3 py-2">
                        <form action="/pengembalian/proses/<?= $row['id_detail'] ?>" method="post" onsubmit="return confirm('Proses pengembalian buku ini?')">
                            <?= csrf_field() ?>
                            <button class="bg-green-600 text-white px-3 py-1 rounded">Kembalikan</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= view('layout/footer') ?>
