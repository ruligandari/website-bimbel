<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin\AuthController::index');
$routes->post('auth', 'Admin\AuthController::login');
$routes->get('logout', 'Admin\AuthController::logout');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->get('soal', 'Admin\SoalController::index');
    $routes->get('nilai', 'Admin\NilaiController::index');
    // Add other admin routes here
});
