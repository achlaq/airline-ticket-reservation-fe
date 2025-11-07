<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Flights::index');
$routes->get('/flights/search', 'Flights::search');

$routes->get('/bookings/new/(:segment)', 'Bookings::createForm/$1');
$routes->post('/bookings', 'Bookings::create');
$routes->get('/bookings/(:segment)', 'Bookings::detail/$1');
$routes->post('/bookings/(:segment)/update', 'Bookings::update/$1');
$routes->post('/bookings/(:segment)/cancel', 'Bookings::cancel/$1');

$routes->get('/admin/bookings', 'AdminBookings::index');
$routes->get('/admin/bookings/search', 'AdminBookings::search');
$routes->post('/admin/bookings/(:segment)/update', 'AdminBookings::update/$1');
$routes->post('/admin/bookings/(:segment)/cancel', 'AdminBookings::cancel/$1');
