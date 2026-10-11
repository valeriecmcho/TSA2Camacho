<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Landing page is the Login page
$routes->get('/', 'Auth::loginForm');
$routes->post('/', 'Auth::loginAction');

// Home / Dashboard (protected)
$routes->get('home', 'Home::index');

$routes->get('operations', 'Operations::index');
$routes->get('operations/displayinfo/(:segment)/(:segment)/(:segment)/(:segment)/(:segment)', 'Operations::displayinfo/$1/$2/$3/$4/$5');
$routes->get('operations/compute/(:num)/(:num)', 'Operations::compute/$1/$2');
$routes->get('operations/compute', 'Operations::compute');

// POS System Routes
$routes->get('customer-accounts', 'CustomerAccounts::index');
$routes->get('user-accounts', 'UserAccounts::index');

// Authentication Routes
$routes->get('login', 'Auth::loginForm');
$routes->post('login', 'Auth::loginAction');
$routes->post('logout', 'Auth::logout');

// Task Management System Routes  (public views)
$routes->get('tasks', 'Tasks::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'About::index');

// Task CRUD – protected by AuthFilter (see Config/Filters.php)
$routes->get('tasks/new', 'Tasks::newForm');
$routes->post('tasks/create', 'Tasks::create');
$routes->get('tasks/edit/(:num)', 'Tasks::editForm/$1');
$routes->post('tasks/update/(:num)', 'Tasks::update/$1');
$routes->post('tasks/delete/(:num)', 'Tasks::delete/$1');
