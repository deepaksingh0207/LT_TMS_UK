<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Users::login');
$routes->get('/users', 'Users::index');
$routes->get('/users/login', 'Users::login');
$routes->post('/users/login', 'Users::login');
$routes->get('/users/logout', 'Users::logout');
$routes->post('/users/logout', 'Users::logout');
$routes->get('/users/register', 'Users::register');
$routes->post('/users/register', 'Users::register');
$routes->post('/users/update', 'Users::update');

$routes->get('/dashboard', 'Dashboard::index');

service('auth')->routes($routes, ['except' => ['login', 'register','logout']]);

$routes->get('login', 'Users::login');
$routes->get('register', 'Users::register');
$routes->get('logout', 'Users::logout');

$routes->get("user_management","UserManagement::index");