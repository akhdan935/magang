<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('auth', static function ($routes) {
    $routes->get('logout', 'Auth::logout');
    $routes->get('success', 'Auth::success');
});

$routes->group('auth', ['filter' => 'noauth'], static function ($routes) {
    $routes->get('/', 'Auth::login');
    $routes->get('login', 'Auth::login');
    $routes->post('/', 'Auth::login');
    $routes->post('login', 'Auth::login');
});

$routes->group('user', ['filter' => 'noauthadmin'], static function ($routes) {
    $routes->get('absent', 'User::absent');
});

$routes->group('user', ['filter' => 'authuser'], static function ($routes) {
    $routes->get('/', 'User::index');
    $routes->get('index', 'User::index');
    $routes->get('absent', 'User::absent');
    $routes->post('absent', 'User::absent');
    $routes->get('record/(:any)/(:any)/(:any)', 'User::record/$1/$2/$3');
    $routes->post('record/(:any)/(:any)/(:any)', 'User::record/$1/$2/$3');
    $routes->post('addrecord/(:any)/(:any)/(:any)', 'User::addRecord/$1/$2/$3');
    $routes->post('/', 'User::index');
    $routes->post('index', 'User::index');
    $routes->post('addfolder', 'User::addFolder');
    $routes->delete('deleterecord/(:num)', 'User::deleteRecord/$1');
    $routes->delete('deletefolder/(:num)', 'User::deleteFolder/$1');
});

$routes->group('admin', ['filter' => 'authadmin'], static function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('index', 'Admin::index');
    $routes->get('addusers', 'Admin::addUsers');
    $routes->get('editusers/(:num)', 'Admin::editUsers/$1');
    $routes->get('absent/(:num)', 'Admin::absent/$1');
    $routes->post('absent/(:num)', 'Admin::absent/$1');
    $routes->get('detailusersfirst/(:num)', 'Admin::detailUsersFirst/$1');
    $routes->get('detailuserssecond/(:any)/(:any)', 'Admin::detailUsersSecond/$1/$2');
    $routes->get('detailuserslast/(:any)/(:any)/(:any)', 'Admin::detailUsersLast/$1/$2/$3');
    $routes->post('/', 'Admin::index');
    $routes->post('index', 'Admin::index');
    $routes->post('saveusers', 'Admin::saveUsers');
    $routes->post('updateusers/(:num)', 'Admin::updateUsers/$1');
    $routes->delete('deleteusers/(:num)', 'Admin::deleteUsers/$1');
    $routes->delete('deleteabsent/(:num)/(:num)', 'Admin::deleteAbsent/$1/$2');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
