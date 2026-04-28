<?= view('layout/header', ['title' => $title]) ?>
<?= view('layout/sidebar') ?>
<h2 class="text-2xl font-semibold mb-4">Riwayat Peminjaman</h2>
<div class="bg-white rounded shadow overflow-auto">
<table class="min-w-full text-sm">
    <thead class="bg-gray-100"><tr><th class="px-3 py-2 text-left">Anggota</th><th class="px-3 py-2 text-left">Buku</th><th class="px-3 py-2 text-left">Pinjam</th><th class="px-3 py-2 text-left">Tempo</th><th class="px-3 py-2 text-left">Kembali</th><th class="px-3 py-2 text-left">Status</th><th class="px-3 py-2 text-left">Denda</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
        <tr class="border-t"><td class="px-3 py-2"><?= esc($r['nama']) ?></td><td class="px-3 py-2"><?= esc($r['judul']) ?></td><td class="px-3 py-2"><?= esc($r['tanggal_pinjam']) ?></td><td class="px-3 py-2"><?= esc($r['tanggal_jatuh_tempo']) ?></td><td class="px-3 py-2"><?= esc($r['tanggal_kembali']) ?></td><td class="px-3 py-2"><?= esc($r['status_buku']) ?></td><td class="px-3 py-2">Rp <?= number_format((int)$r['denda'], 0, ',', '.') ?></td></tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?= view('layout/footer') ?>
