<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Auth
$routes->get('/', 'User::login');
$routes->get('/login', 'User::login');
$routes->post('/login', 'User::prosesLogin');
$routes->get('/logout', 'User::logout');
$routes->get('/form-login', 'User::login');

$routes->get('/dashboard', 'Home::index');
$routes->get('/data-user', 'User::dataUser');
$routes->get('/tambah-user', 'User::tambahUser');
$routes->post('/simpan-user', 'User::simpanUser');
$routes->post('/update-user/(:num)', 'User::updateUser/$1');
$routes->get('/edit-user/(:num)', 'User::editUser/$1');
$routes->get('/tambah-user', 'User::registrasi');
$routes->get('/hapus-user/(:num)', 'User::delete/$1');

$routes->get('/profile', 'User::profile');

//satuan
$routes->get('/data-satuan', 'Satuan::dataSatuan');
$routes->get('/tambah-satuan', 'Satuan::tambahSatuan');
$routes->get('/edit-satuan/(:num)', 'Satuan::editSatuan/$1');
$routes->post('/simpan-satuan', 'Satuan::simpanSatuan');
$routes->get('/hapus-satuan/(:num)', 'Satuan::hapusSatuan/$1');
$routes->post('/update-satuan', 'Satuan::updateSatuan');

//kategori
$routes->get('/data-kategori', 'Kategori::dataKategori');
$routes->get('/tambah-kategori', 'Kategori::tambahKategori');
$routes->get('/edit-kategori/(:num)', 'Kategori::editKategori/$1');
$routes->post('/edit-kategori/(:num)', 'Kategori::editKategori/$1');
$routes->post('/simpan-kategori', 'Kategori::simpanKategori');
$routes->get('/hapus-kategori/(:num)', 'Kategori::hapusKategori/$1');
$routes->post('/update-kategori', 'Kategori::updateKategori');

//produk

$routes->get('/data-produk', 'Produk::dataProduk');
$routes->get('/tambah-produk', 'Produk::tambahProduk');
$routes->get('/edit-produk/(:num)', 'Produk::editProduk/$1');
$routes->post('/simpan-produk', 'Produk::simpanProduk');
$routes->get('/hapus-produk/(:num)', 'Produk::hapusProduk/$1');
$routes->post('/update-produk/(:num)', 'Produk::updateProduk/$1');

$routes->get('/data-laporan', 'Produk::dataLaporan');

//penjualan
$routes->get('/transaksi', 'Penjualan::index');
$routes->get('/tambah-penjualan', 'Penjualan::tambahPenjualan');
$routes->get('/edit-penjualan/(:num)', 'Penjualan::editPenjualan/$1');
$routes->post('/edit-penjualan/(:num)', 'Penjualan::editPenjualan/$1');
$routes->post('/simpan-penjualan', 'Penjualan::simpanPenjualan');
$routes->get('/hapus-penjualan/(:num)', 'Penjualan::hapusPenjualan/$1');
$routes->post('/update-penjualan', 'Penjualan::updatePenjualan');

//validasi
$routes->get('/cek-satuan-digunakan/(:segment)', 'Satuan::cek_keterkaitan_data/$1');

$routes->get('/transaksi-penjualan','Penjualan::index');
$routes->post('/transaksi-penjualan','Penjualan::simpanPenjualan');
$routes->get('/pembayaran','Penjualan::simpanPembayaran');

$routes->get('/', 'PdfController::index');  
$routes->get('/cetak-laporan', 'LaporanStok::generate');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
