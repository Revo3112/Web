<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/user', 'Home::user');
$routes->get('/user_article', 'Home::user_article');
$routes->get('/admin', 'Home::admin');
$routes->get('login', 'Home::login_page');
$routes->get('signup', 'Home::signup_page');

$routes->group('auth', function ($routes) {
    $routes->post('login', 'Auth::login_controller');
    $routes->post('signup', 'Auth::signup_controller');
});
