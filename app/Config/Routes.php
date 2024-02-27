<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Home::admin');
$routes->get('login', 'Home::login_page');
$routes->get('signup', 'Home::signup_page');


// ================ ROLE USER ================ \\
$routes->group('user', function ($routes) {
    $routes->get('/', 'User::index');

    $routes->get('detail/(:segment)/(:segment)', 'User::detail/$1/$2');
    $routes->get('new-article', 'User::addArticle');

    $routes->post('edit-article', 'User::editArticle');
    $routes->post('save-article', 'User::saveArticle');

    $routes->delete('delete-article/(:any)/(:any)', 'User::deleteArticle/$1/$2');
});

$routes->group('admin', function ($routes) {
    $routes->get('view', '');
});

$routes->group('auth', function ($routes) {
    $routes->post('login', 'Auth::login_controller');
    $routes->post('signup', 'Auth::signup_controller');
    $routes->get('logout', 'Auth::logout');
});
