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
$routes->setDefaultController('Home');
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

$routes->get('/events/schedule/(:any)', 'Event::schedule/$1');
$routes->post('/events/schedule/add', 'Event::addScheduledEvent');
$routes->get('/events/calendar/(:any)', 'Event::calendar/$1');
$routes->get('/events/tables/(:any)/(:any)', 'Event::tables/$1/$2');
$routes->post('/events/calendar/addDay', 'Event::addDay');
$routes->post('/events/rooms/addTable', 'Event::addtable');
$routes->get('/events/rooms/(:any)', 'Event::rooms/$1');
$routes->post('/events/rooms/addRoom', 'Event::addRoom');
$routes->post('/events/addEvent', 'Event::addEvent');
$routes->post('/events/gameCheckIn', 'Event::gameCheckIn');
$routes->post('/events/gameCheckOut', 'Event::gameCheckOut');
$routes->get('/events/library/add/(:any)/(:any)', 'Event::addGameToEventLibrary/$1/$2');
$routes->get('/events/library/remove/(:any)/(:any)', 'Event::removeGameFromEventLibrary/$1/$2');
$routes->get('/events/library/(:any)', 'Event::Library/$1');
$routes->get('/events/cico/(:any)', 'Event::cico/$1');
$routes->get('/events', 'Event::index');
$routes->post('/library/addGameToLibrary', 'Library::addGameToLibrary');
$routes->get('/library/new', 'Library::new');
$routes->get('/library/(:any)', 'Library::index/$1');
$routes->post('/game/new', 'Game::new');
$routes->get('/game/profile/(:any)', 'Game::profile/$1');
$routes->get('/games/getGamesByAll/(:any)','Game::getGamesByAll/$1');
$routes->post('/game/edit/(:any)', 'Game::update/$1');
$routes->get('/game/(:any)', 'Home::game/$1');

$routes->get('/tag-library', 'Home::tagLibrary');
$routes->get('/', 'Home::index');

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

