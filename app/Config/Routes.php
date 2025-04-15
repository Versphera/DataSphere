<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/pendidikan', 'Pendidikan::index');
$routes->get('/kesehatan', 'Kesehatan::index');
$routes->get('/ekonomi', 'Ekonomi::index');
$routes->get('/kependudukan', 'Kependudukan::index');


