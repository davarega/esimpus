<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>
<h2 class="text-2xl font-semibold mb-4">Laporan Keterlambatan (Denda)</h2>
<div class="bg-white rounded shadow overflow-auto">
<table class="min-w-full text-sm">
    <thead class="bg-gray-100"><tr><th class="px-3 py-2 text-left">Anggota</th><th class="px-3 py-2 text-left">Buku</th><th class="px-3 py-2 text-left">Jatuh Tempo</th><th class="px-3 py-2 text-left">Tanggal Kembali</th><th class="px-3 py-2 text-left">Denda</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
        <tr class="border-t"><td class="px-3 py-2"><?= esc($r['nama']) ?></td><td class="px-3 py-2"><?= esc($r['judul']) ?></td><td class="px-3 py-2"><?= esc($r['tanggal_jatuh_tempo']) ?></td><td class="px-3 py-2"><?= esc($r['tanggal_kembali']) ?></td><td class="px-3 py-2">Rp <?= number_format((int)$r['denda'], 0, ',', '.') ?></td></tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= view('layout/footer') ?>
