<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  ************************** Public Routes *******************************************************
$routes->get('/', 'Beranda::index');
$routes->get('/beranda/index', 'Beranda::index');
$routes->get('/beranda/ketentuan', 'Beranda::ketentuan');
$routes->get('/beranda/track', 'Beranda::track');
$routes->get('/beranda/permohonan', 'Beranda::permohonan');
$routes->post('/beranda/submit', 'Beranda::submit');
$routes->post('/beranda/search', 'Beranda::search');
$routes->get('/beranda/search', 'Beranda::search');
$routes->post('/beranda/submitSurvey/', 'Beranda::submitSurvey');
$routes->get('/beranda/lampiran-jadi/(:num)', 'Beranda::getLampiranJadi/$1');
$routes->post('/beranda/survey/', 'Beranda::survey');


// ************************** Admin &PTSP Routes **************************************************
$routes->group('', ['filter' => 'role:Admin,PTSP'], function ($routes) {
  // Dashboard
  $routes->get('/dashboard', 'Dashboard::index');
  $routes->get('/dashboard/index', 'Dashboard::index');

  // Seksi/Pengelola
  $routes->group('seksi', function ($routes) {
    $routes->get('', 'Seksi::index');
    $routes->get('index', 'Seksi::index');
    $routes->post('add', 'Seksi::add');
    $routes->post('update/(:num)', 'Seksi::update/$1');
    $routes->post('delete/(:num)', 'Seksi::delete/$1');
  });

  // Pemohon
  $routes->group('pemohon', function ($routes) {
    $routes->get('', 'Pemohon::index');
    $routes->get('index', 'Pemohon::index');
    $routes->post('add', 'Pemohon::add');
    $routes->post('update/(:num)', 'Pemohon::update/$1');
    $routes->post('delete/(:num)', 'Pemohon::delete/$1');
  });

  // Agama
  $routes->group('agama', function ($routes) {
    $routes->get('', 'Agama::index');
    $routes->get('index', 'Agama::index');
    $routes->post('add', 'Agama::add');
    $routes->post('update/(:num)', 'Agama::update/$1');
    $routes->post('delete/(:num)', 'Agama::delete/$1');
  });

  // Layanan
  $routes->group('layanan', function ($routes) {
    $routes->get('', 'Layanan::index');
    $routes->get('index', 'Layanan::index');
    $routes->post('add', 'Layanan::add');
    $routes->post('update/(:num)', 'Layanan::update/$1');
    $routes->post('delete/(:num)', 'Layanan::delete/$1');
  });

  // Profil
  $routes->group('profile', function ($routes) {
    $routes->get('', 'Profile::index');
    $routes->get('index', 'Profile::index');
    $routes->post('update/(:num)', 'Profile::update/$1');
  });

  // User
  $routes->group('users', function ($routes) {
    $routes->get('repassword', 'Users::repassword');
    // $routes->post('savepassword/(:num)', 'Users::savepassword/$1');
    $routes->post('savepassword', 'Users::savepassword');
  });
});



// ************************** Admin Routes **************************************************
$routes->group('', ['filter' => 'role:Admin'], function ($routes) {
  // User Management
  $routes->group('users', function ($routes) {
    $routes->get('', 'Users::index');
    $routes->get('index', 'Users::index');
    $routes->post('add', 'Users::add');
    $routes->get('aktif/(:num)', 'Users::aktif/$1');
    $routes->get('nonaktif/(:num)', 'Users::nonaktif/$1');
    $routes->post('delete/(:num)', 'Users::delete/$1');
  });

  // Data Instansi
  $routes->group('company', function ($routes) {
    $routes->get('', 'Company::index');
    $routes->get('index', 'Company::index');
    $routes->post('update/(:num)', 'Company::update/$1');
  });

  // About
  $routes->group('about', function ($routes) {
    $routes->get('', 'About::index');
    $routes->get('index', 'About::index');
    $routes->post('update/(:num)', 'About::update/$1');
  });

  // Layanan Detail
  $routes->group('layanandetail', function ($routes) {
    $routes->get('', 'LayananDetail::index');
    $routes->get('index', 'LayananDetail::index');
    $routes->post('add', 'LayananDetail::add');
    $routes->post('update/(:num)', 'LayananDetail::update/$1');
    $routes->post('delete/(:num)', 'LayananDetail::delete/$1');
  });
});

// ************************** PTSP Routes **************************************************
$routes->group('', ['filter' => 'role:PTSP'], function ($routes) {
  // Pelayanan
  $routes->group('pelayanan', function ($routes) {
    $routes->get('', 'Pelayanan::index');
    $routes->get('index', 'Pelayanan::index');
    $routes->get('fetchData', 'Pelayanan::fetchData');
    $routes->post('add', 'Pelayanan::add');
    $routes->post('update/(:num)', 'Pelayanan::update/$1');
    $routes->post('detail/(:num)', 'Pelayanan::detail/$1');
    $routes->post('delete/(:num)', 'Pelayanan::delete/$1');
    $routes->get('cetak_tanda/(:num)', 'Pelayanan::cetak_tanda/$1');
    $routes->match(['get', 'post'], 'diproses_ptsp/(:num)', 'Pelayanan::diproses_ptsp/$1');
    $routes->match(['get', 'post'], 'diproses_unit/(:num)', 'Pelayanan::diproses_unit/$1');
    $routes->match(['get', 'post'], 'selesai/(:num)', 'Pelayanan::selesai/$1');
  });
});
