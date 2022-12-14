<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
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
$routes->get('/home', 'Home::index');
//API
$routes->resource('/api/data-instansi', ['controller' => 'Api\Instansi']);
//Routes Login
$routes->get('/', 'Auth::index');
$routes->add('/auth/verify', 'Auth::cek');
$routes->get('/auth/logout', 'Auth::logout');
//Routes User
$routes->get('data-user', 'User::user');
$routes->get('data-user/add', 'User::add');
$routes->post('data-user/save', 'User::save');
$routes->get('data-user/(:num)', 'User::delete/$1');
$routes->get('data-user/edit/(:segment)', 'User::edit/$1');
$routes->add('data-user/update/(:segment)', 'User::update/$1');
//Routes Data Instansi
$routes->get('/data-instansi', 'DataInstansi::data');
$routes->get('/data-instansi/add', 'DataInstansi::add');
$routes->add('/data-instansi/save', 'DataInstansi::save');
$routes->delete('/data-instansi/(:num)', 'DataInstansi::delete/$1');
$routes->get('/data-instansi/edit/(:segment)', 'DataInstansi::edit/$1');
$routes->add('/data-instansi/update/(:segment)', 'DataInstansi::update/$1');
//Routes My Profil
$routes->get('/my-profil', 'MyProfil::myprofil');
$routes->get('/my-profil/edit/(:segment)', 'MyProfil::edit/$1');
$routes->add('/my-profil/update/(:segment)', 'MyProfil::update/$1');
//Routes Perda
$routes->get('/perda', 'DataPerda::data');
$routes->get('/perda/add', 'DataPerda::add');
$routes->add('/perda/save', 'DataPerda::save');
$routes->delete('/perda/(:num)', 'DataPerda::delete/$1');
$routes->get('/perda/edit/(:segment)', 'DataPerda::edit/$1');
$routes->add('/perda/update/(:segment)', 'DataPerda::update/$1');
$routes->get('/perda/review/(:segment)', 'DataPerda::review/$1');

// Routes Slideshow
$routes->get('/data-slideshow', 'Slideshow::slideshow');
$routes->get('/data-slideshow/add', 'Slideshow::add');
$routes->post('/data-slideshow/save', 'SLideshow::save');
$routes->get('/data-slideshow/(:num)', 'Slideshow::delete/$1');

//Routes Pengajuan Perda
$routes->get('/pengajuan-perda', 'DataPerda::dataperda');
$routes->get('/pengajuan-perda/verifikasi/(:segment)', 'DataPerda::verifikasi/$1');
$routes->post('/pengajuan-perda/verify/(:segment)', 'DataPerda::verify/$1');
$routes->get('/pengajuan-perda/review/(:segment)', 'DataPerda::reviewp/$1');
//Routes Perda Terverifikasi
$routes->get('/perda-terverifikasi', 'DataPerda::dataperdav');
$routes->get('/perda-terverifikasi/review/(:segment)', 'DataPerda::reviewv/$1');
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
