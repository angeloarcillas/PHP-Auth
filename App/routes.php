<?php
$router->get('PHP-Auth', function () {
    return view("welcome");
});
$router->get('PHP-Auth/home', function () {
    return view("home");
});

// REGISTER
$router->get('PHP-Auth/auth/register', function () {
    return view("auth/login");
});
$router->post('PHP-Auth/auth/register', 'AuthsController@register');

// LOGIN
$router->get('PHP-Auth/auth/login', function () {
    return view("auth/register");
});

$router->post('PHP-Auth/auth/login', 'AuthsController@login');

// LOGOUT
$router->post('PHP-Auth/auth/logout', 'AuthsController@logout');

// EMAIL
$router->get('PHP-Auth/auth/email/verify/link', function () {
    return view('auth/verify');
});
$router->post('PHP-Auth/auth/email/verify/link', 'AuthsController@sendVerifyLink');
$router->get('PHP-Auth/auth/email/verify', 'AuthsController@verifyEmail');

// FORGOT
$router->get('PHP-Auth/auth/password/forgot', 'AuthsController@showForgotForm');
$router->post('PHP-Auth/auth/password/email', 'AuthsController@sendForgotLink');

// RESET
$router->get('PHP-Auth/auth/password/reset/{token}', 'AuthsController@showResetForm');
$router->post('PHP-Auth/auth/password/reset', 'AuthsController@resetPassword');


// server/email/?token=C#^$#^C#$^C@#&email=sample@mail.com