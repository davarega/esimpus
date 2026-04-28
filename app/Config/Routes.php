<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Buku::index');

// Buku
$routes->group('buku', static function ($routes) {
    $routes->get('/', 'Buku::index');
    $routes->get('create', 'Buku::create');
    $routes->post('store', 'Buku::store');
    $routes->get('edit/(:num)', 'Buku::edit/$1');
    $routes->post('update/(:num)', 'Buku::update/$1');
    $routes->get('delete/(:num)', 'Buku::delete/$1');
});

// Anggota
$routes->group('anggota', static function ($routes) {
    $routes->get('/', 'Anggota::index');
    $routes->get('create', 'Anggota::create');
    $routes->post('store', 'Anggota::store');
    $routes->get('edit/(:num)', 'Anggota::edit/$1');
    $routes->post('update/(:num)', 'Anggota::update/$1');
    $routes->get('delete/(:num)', 'Anggota::delete/$1');
});

// Peminjaman
$routes->group('peminjaman', static function ($routes) {
    $routes->get('/', 'Peminjaman::index');
    $routes->get('create', 'Peminjaman::create');
    $routes->post('store', 'Peminjaman::store');
});

// Pengembalian
$routes->group('pengembalian', static function ($routes) {
    $routes->get('/', 'Pengembalian::index');
    $routes->post('proses/(:num)', 'Pengembalian::proses/$1');
});

// Pengaturan
$routes->group('pengaturan', static function ($routes) {
    $routes->get('/', 'Pengaturan::index');
    $routes->post('update', 'Pengaturan::update');
});

// Laporan
$routes->group('laporan', static function ($routes) {
    $routes->get('buku', 'Laporan::buku');
    $routes->get('dipinjam', 'Laporan::dipinjam');
    $routes->get('riwayat', 'Laporan::riwayat');
    $routes->get('denda', 'Laporan::denda');
});