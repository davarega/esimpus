<aside class="w-64 bg-slate-800 text-white p-5">
    <h1 class="text-xl font-bold mb-6">Perpustakaan</h1>
    <nav class="space-y-2 text-sm">
        <a class="block hover:bg-slate-700 rounded px-3 py-2" href="/buku">Manajemen Buku</a>
        <a class="block hover:bg-slate-700 rounded px-3 py-2" href="/anggota">Manajemen Anggota</a>
        <a class="block hover:bg-slate-700 rounded px-3 py-2" href="/peminjaman">Peminjaman</a>
        <a class="block hover:bg-slate-700 rounded px-3 py-2" href="/pengembalian">Pengembalian</a>
        <a class="block hover:bg-slate-700 rounded px-3 py-2" href="/pengaturan">Pengaturan</a>
        <div class="pt-3 border-t border-slate-600 mt-3"></div>
        <a class="block hover:bg-slate-700 rounded px-3 py-2" href="/laporan/buku">Laporan Buku</a>
        <a class="block hover:bg-slate-700 rounded px-3 py-2" href="/laporan/dipinjam">Laporan Dipinjam</a>
        <a class="block hover:bg-slate-700 rounded px-3 py-2" href="/laporan/riwayat">Riwayat</a>
        <a class="block hover:bg-slate-700 rounded px-3 py-2" href="/laporan/denda">Laporan Denda</a>
    </nav>
</aside>
<main class="flex-1 p-6">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-3"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-3"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>
