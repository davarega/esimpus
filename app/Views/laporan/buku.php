<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>
<h2 class="text-2xl font-semibold mb-4">Laporan Semua Buku</h2>
<div class="bg-white rounded shadow overflow-auto">
<table class="min-w-full text-sm">
    <thead class="bg-gray-100"><tr><th class="px-3 py-2 text-left">Kode</th><th class="px-3 py-2 text-left">Judul</th><th class="px-3 py-2 text-left">Kategori</th><th class="px-3 py-2 text-left">Stok</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
        <tr class="border-t"><td class="px-3 py-2"><?= esc($r['kode_buku']) ?></td><td class="px-3 py-2"><?= esc($r['judul']) ?></td><td class="px-3 py-2"><?= esc($r['kategori']) ?></td><td class="px-3 py-2"><?= (int)$r['jumlah_tersedia'] ?>/<?= (int)$r['jumlah_total'] ?></td></tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= view('layout/footer') ?>
