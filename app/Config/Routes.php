<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Page');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Page::applications');
$routes->get('/login', 'Page::login');
$routes->post('/login', 'Page::login');
$routes->get('/logout', 'Page::logout');
$routes->get('/applications', 'Page::applications');
$routes->get('/application-view/(:any)', 'Page::applicationView/$1');

$routes->get('/apply', 'Page::apply');
$routes->post('/submit-application', 'Page::submitApplication');
$routes->post('/update-application', 'Page::updateApplication');
$routes->post('/delete-application', 'Page::deleteApplication');
// $routes->get('/qr', 'Page::qr');

$routes->get('/apiApplicatnsLoad', 'Page::apiApplicantsLoad');


$routes->post('/generate-qr', 'Page::generateQR');
$routes->get('/qrtest', 'Page::qrTest');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

