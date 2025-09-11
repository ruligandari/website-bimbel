<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin\AuthController::index');
$routes->post('auth', 'Admin\AuthController::login');
$routes->get('logout', 'Admin\AuthController::logout');

// api docs swagger
$routes->get('docs', 'Docs\SwaggerController::index');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->get('soal', 'Admin\SoalController::index');
    $routes->post('soal/store', 'Admin\SoalController::store');
    $routes->post('soal/update/(:num)', 'Admin\SoalController::update/$1');
    $routes->delete('soal/delete/(:num)', 'Admin\SoalController::delete/$1');
    $routes->get('nilai', 'Admin\NilaiController::index');
    // Add other admin routes here
});

// API Routes
$routes->group('api', function ($routes) {
    // login
    $routes->post('login', 'Api\ApiController::loginSiswa');
    // get soal
    $routes->get('soal', 'Api\ApiController::getSoal');
    // push nilai
    $routes->post('nilai/start', 'Api\NilaiController::start');
    $routes->post('nilai/update', 'Api\NilaiController::update');
    $routes->get('nilai', 'Api\NilaiController::getNilai');
    // Add other API routes here
});
