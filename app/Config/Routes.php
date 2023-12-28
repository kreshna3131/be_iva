<?php

use App\Controllers\Home;
use App\Controllers\RegistrasiController;

$routes->get('/', 'Home::index');

// Endpoint untuk mendapatkan data registrasi
$routes->get('registrasi', 'RegistrasiController::registrasi');

$routes->match(['post', 'options'], 'api/registrasi', 'RegistrasiController::create');
$routes->match(['post', 'options'], 'api/login', 'RegistrasiController::login');
$routes->match(['put', 'options'], 'update/registrasi/(:segment)', 'RegistrasiController::update/$1');
$routes->match(['delete', 'options'], 'delete/registrasi/(:segment)', 'RegistrasiController::delete/$1');

$routes->get('admin', 'AdminController::admin');

$routes->match(['post', 'options'], 'api/admin', 'AdminController::create_admin');
$routes->match(['post', 'options'], 'api/login_admin', 'AdminController::login_admin');
$routes->match(['put', 'options'], 'api/update_admin/admin/(:segment)', 'AdminController::update_admin/$1');
$routes->match(['delete', 'options'], 'api/delete_admin/admin/(:segment)', 'AdminController::delete_admin/$1');

$routes->get('lamaran', 'LamaranController::lamaran');

$routes->match(['post', 'options'], 'api/lamaran', 'LamaranController::create_lamaran');
$routes->match(['post', 'options'], 'api/login_lamaran', 'LamaranController::login_lamaran');
$routes->match(['put', 'options'], 'api/update_lamaran/lamaran/(:segment)', 'LamaranController::update_lamaran/$1');
$routes->match(['delete', 'options'], 'api/delete_lamaran/lamaran/(:segment)', 'LamaranController::delete_lamaran/$1');

$routes->get('lowker', 'LowkerController::lowker');

$routes->match(['post', 'options'], 'api/lowker', 'LowkerController::create_lowker');
$routes->match(['put', 'options'], 'api/update_lowker/lowker/(:segment)', 'LowkerController::update_lowker/$1');
$routes->match(['delete', 'options'], 'api/delete_lowker/lowker/(:segment)', 'LowkerController::delete_lowker/$1');


$routes->get('perusahaan', 'PerusahaanController::perusahaan');

$routes->match(['post', 'options'], 'api/perusahaan', 'PerusahaanController::create_perusahaan');
$routes->match(['post', 'options'], 'api/login_perusahaan', 'PerusahaanController::login_perusahaan');
$routes->match(['put', 'options'], 'api/update_perusahaan/perusahaan/(:segment)', 'PerusahaanController::update_perusahaan/$1');
$routes->match(['delete', 'options'], 'api/delete_perusahaan/perusahaan/(:segment)', 'PerusahaanController::delete_perusahaan/$1');

$routes->get('profile', 'ProfileController::profile');

$routes->match(['post', 'options'], 'api/profile', 'ProfileController::create_profile');
$routes->match(['put', 'options'], 'api/update_profile/profile/(:segment)', 'ProfileController::update_profile/$1');
$routes->match(['delete', 'options'], 'api/delete_profile/profile/(:segment)', 'ProfileController::delete_profile/$1');
