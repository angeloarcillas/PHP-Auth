<?php


// set host


$router->host = 'php-auth';

// set routes
$router->get('/', 'PagesController@welcome');

// REGISTER
$router->get('/register', function () {
    return view('auth.register');
});
$router->post('/register', 'Auth\RegisterController@register');

// LOGIN
$router->get('/login', function () {
    return view('auth.login');
});
$router->post('/login', 'Auth\LoginController@login');

// CHANGE PASSWORD
$router->get('/password/:any/:any/edit', function ($args,$asd) {
    // $user = new \App\Models\User();
    // $isFound = $user->select('$args')
    die(var_dump(...[$args, $asd]));
});
$router->put('/password', 'Auth\ChangePasswordController@update');
