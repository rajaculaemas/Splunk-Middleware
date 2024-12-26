<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
log_message('debug', 'Current URL: ' . current_url());
// Halaman utama dengan proteksi filter auth
$routes->get('/middleware', 'Home::index', ['filter' => 'auth']); // Rute utama yang butuh autentikasi

// Login Routes
$routes->get('/middleware/login', 'Auth::login'); // Halaman login (tanpa filter)
$routes->post('/middleware/login', 'Auth::doLogin'); // Proses login

// Logout Route
$routes->get('/middleware/logout', 'Auth::logout'); // Proses logout

// Register Routes
$routes->get('/middleware/register', 'Auth::register'); // Halaman registrasi
$routes->post('/middleware/register', 'Auth::doRegister'); // Proses registrasi

// Halaman upload dan log (dilindungi oleh auth filter)
$routes->get('middleware/upload', 'Logs::index', ['filter' => 'auth']);
$routes->post('logs/upload', 'Logs::upload', ['filter' => 'auth']);
$routes->get('middleware/logs', 'Logs::showLogs', ['filter' => 'auth']);
$routes->get('middleware/logs/getRawData/(:num)', 'Logs::getRawData/$1', ['filter' => 'auth']);

// Halaman alert (opsional, tanpa proteksi)
$routes->get('/middleware/alert', 'AlertController::alert');
