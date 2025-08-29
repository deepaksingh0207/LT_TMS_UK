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
$routes->post('/users/add', 'Users::add');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/edit/(:num)', 'Users::edit/$1');
$routes->get('/users/profile', 'Users::profile');
$routes->get('/users/get-head-master-data', 'Users::getHeadMasterData');
$routes->get('/users/get-trolley-master-data', 'Users::getTrolleyMasterData');
$routes->post('/users/add-head-master-data', 'Users::addHeadMasterData');
$routes->post('/users/add-trolley-master-data', 'Users::addTrolleyMasterData');

$routes->get('/dashboard', 'Dashboard::index');

service('auth')->routes($routes, ['except' => ['login', 'register','logout']]);

$routes->get('login', 'Users::login');
$routes->get('register', 'Users::register');
$routes->get('logout', 'Users::logout');

$routes->get("user_management","UserManagement::index");
$routes->get("delivery_orders","DeliveryOrders::index");
$routes->get("head_master","HeadMaster::index");
$routes->get("trolley_master","TrolleyMaster::index");