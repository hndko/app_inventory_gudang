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
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');

$routes->get('/kategori', 'KategoriController::index');
$routes->post('/kategori', 'KategoriController::index');
$routes->get('/kategori/create', 'KategoriController::create');
$routes->post('/kategori/store', 'KategoriController::store');
$routes->get('/kategori/edit/(:num)', 'KategoriController::edit/$1');
$routes->post('/kategori/update', 'KategoriController::update');
$routes->delete('/kategori/delete/(:num)', 'KategoriController::delete/$1');

$routes->get('/satuan', 'SatuanController::index');
$routes->post('/satuan', 'SatuanController::index');
$routes->get('/satuan/create', 'SatuanController::create');
$routes->post('/satuan/store', 'SatuanController::store');
$routes->get('/satuan/edit/(:num)', 'SatuanController::edit/$1');
$routes->post('/satuan/update', 'SatuanController::update');
$routes->delete('/satuan/delete/(:num)', 'SatuanController::delete/$1');

$routes->get('/barang', 'BarangController::index');
$routes->post('/barang', 'BarangController::index');
$routes->get('/barang/create', 'BarangController::create');
$routes->post('/barang/store', 'BarangController::store');
$routes->get('/barang/edit/(:num)', 'BarangController::edit/$1');
$routes->post('/barang/update', 'BarangController::update');
$routes->delete('/barang/delete/(:num)', 'BarangController::delete/$1');

$routes->get('/barangmasuk', 'BarangMasukController::index');
$routes->get('/barangmasuk/dataTemp', 'BarangMasukController::dataTemp');
$routes->post('/barangmasuk/dataTemp', 'BarangMasukController::dataTemp');
$routes->get('/barangmasuk/getDataBarang', 'BarangMasukController::getDataBarang');
$routes->post('/barangmasuk/getDataBarang', 'BarangMasukController::getDataBarang');
$routes->get('/barangmasuk/simpanTemp', 'BarangMasukController::simpanTemp');
$routes->post('/barangmasuk/simpanTemp', 'BarangMasukController::simpanTemp');
$routes->post('/barangmasuk/delete', 'BarangMasukController::delete');
$routes->get('/barangmasuk/searchDataBarang', 'BarangMasukController::searchDataBarang');
$routes->get('/barangmasuk/detailCariBarang', 'BarangMasukController::detailCariBarang');
$routes->post('/barangmasuk/detailCariBarang', 'BarangMasukController::detailCariBarang');

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
