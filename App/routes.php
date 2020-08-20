<?php
$router->get('PHP-Auth', function () {
    return view("welcome");
});
$router->get('PHP-Auth/home', function () {
    return view("home");
});

// REGISTER
$router->get('PHP-Auth/auth/register', 'AuthsController@showRegisterForm');
$router->post('PHP-Auth/auth/register', 'AuthsController@register');

// LOGIN
$router->get('PHP-Auth/auth/login', 'AuthsController@showLoginForm');
$router->post('PHP-Auth/auth/login', 'AuthsController@login');

// LOGOUT
$router->post('PHP-Auth/auth/logout', 'AuthsController@logout');

// EMAIL
$router->get('PHP-Auth/auth/email/verify', 'AuthsController@showSendVerifymForm');
$router->post('PHP-Auth/auth/email/verify', 'AuthsController@sendVerifyLink');

// FORGOT
$router->get('PHP-Auth/auth/password/forgot', 'AuthsController@showForgotForm');
$router->post('PHP-Auth/auth/password/email', 'AuthsController@sendForgotLink');

// RESET
$router->get('PHP-Auth/auth/password/reset/{token}', 'AuthsController@showResetForm');
$router->post('PHP-Auth/auth/password/reset', 'AuthsController@resetPassword');