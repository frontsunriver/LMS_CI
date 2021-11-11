<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
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
$routes->get('/', 'Login::index', ['filter' => 'noauth']);
$routes->get('/index2', 'Login::index2', ['filter' => 'noauth']);

$routes->get('/login', 'Login::index', ['filter' => 'noauth']);
$routes->post('/authenticate', 'Login::authenticate');

$routes->get('/resume', 'Dashboard::resume', ['filter' => 'auth']);
$routes->post('/changePeriods', 'Dashboard::changePeriods');
$routes->get('/logout', 'Dashboard::logout');

$routes->get('/calendario', 'Calendario::index', ['filter' => 'auth']);
$routes->get('/calendario/curso', 'Calendario::curso', ['filter' => 'auth']);
$routes->post('/calendario/evento', 'Calendario::detalles', ['filter' => 'auth']);

$routes->get('/exam', 'Exam::index', ['filter' => 'auth']);
$routes->get('/exam/detail', 'Exam::detail', ['filter' => 'auth']);
$routes->get('/exam/detail', 'Exam::detail', ['filter' => 'auth']);
$routes->post('/exam/getQuesList', 'Exam::getQuesList', ['filter' => 'auth']);
$routes->post('/exam/getExamList', 'Exam::getExamList', ['filter' => 'auth']);
$routes->post('/exam/create/save', 'Exam::saveExam', ['filter' => 'auth']);
$routes->post('/exam/create/question', 'Exam::saveExamQuestion', ['filter' => 'auth']);
$routes->post('/exam/unique/delete', 'Exam::deleteQuize', ['filter' => 'auth']);
$routes->post('/exam/quiz/getQuizById', 'Exam::getQuizById', ['filter' => 'auth']);
$routes->post('/exam/save/popular', 'Exam::savePopularSetting', ['filter' => 'auth']);
$routes->post('/exam/delete', 'Exam::examDelete', ['filter' => 'auth']);
$routes->post('/exam/show', 'Exam::toggleShow', ['filter' => 'auth']);












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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
