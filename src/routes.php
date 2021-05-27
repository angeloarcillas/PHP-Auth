<?php


// set host


$router->host = 'php-auth';

// set routes
$router->get('/', 'PagesController@welcome');

$router->get('/register', function () {
    return view('auth.register');
});
$router->post('/register', 'Auth\RegisterController@register');
