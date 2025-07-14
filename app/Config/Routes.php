<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Hapus baris di bawah ini kalau sudah tidak dipakai
// $routes->post('/order/process', 'Home::processOrder');

// Gunakan hanya ini:
$routes->post('order/process', 'OrderController::process');
$routes->get('admin/login', 'AdminController::login');
$routes->post('admin/login-process', 'AdminController::loginProcess');
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/admin/logout', 'AdminController::logout');
$routes->post('/admin/update-status', 'AdminController::updateStatus');
$routes->get('/admin/export-excel', 'AdminController::exportExcel');
$routes->get('/admin/cetak/(:num)', 'AdminController::cetakInvoice/$1');
$routes->get('/email-test', 'EmailTestController::index');
$routes->post('/order/delete/(:num)', 'OrderController::delete/$1');
$routes->post('/admin/order/delete/(:num)', 'OrderController::delete/$1');

