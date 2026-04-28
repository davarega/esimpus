<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Buku::index');

$routes->group('buku', static function ($routes) {
    $routes->get('/', 'Buku::index');
    $routes->get('create', 'Buku::create');
    $routes->post('store', 'Buku::store');
    $routes->get('edit/(:num)', 'Buku::edit/$1');
    $routes->post('update/(:num)', 'Buku::update/$1');
    $routes->get('delete/(:num)', 'Buku::delete/$1');
});

$routes->group('anggota', static function ($routes) {
    $routes->get('/', 'Anggota::index');
    $routes->get('create', 'Anggota::create');
    $routes->post('store', 'Anggota::store');
    $routes->get('edit/(:num)', 'Anggota::edit/$1');
    $routes->post('update/(:num)', 'Anggota::update/$1');
    $routes->get('delete/(:num)', 'Anggota::delete/$1');
});

$routes->group('peminjaman', static function ($routes) {
    $routes->get('/', 'Peminjaman::index');
    $routes->get('create', 'Peminjaman::create');
    $routes->post('store', 'Peminjaman::store');
});

$routes->group('pengembalian', static function ($routes) {
    $routes->get('/', 'Pengembalian::index');
    $routes->post('kembalikan/(:num)', 'Pengembalian::kembalikan/$1');
});

$routes->group('pengaturan', static function ($routes) {
    $routes->get('/', 'Pengaturan::index');
    $routes->post('update', 'Pengaturan::update');
});

$routes->group('laporan', static function ($routes) {
    $routes->get('buku', 'Laporan::buku');
    $routes->get('dipinjam', 'Laporan::dipinjam');
    $routes->get('riwayat', 'Laporan::riwayat');
    $routes->get('denda', 'Laporan::denda');
});
