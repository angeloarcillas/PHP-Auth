<?php
// !TODO: Implement password reset
$router->get('PHP-Auth', function () {
    return view("welcome");
});
$router->get('PHP-Auth/home', function () {
    return view("home");
});

// REGISTER
$router->get('PHP-Auth/auth/register', function () {
    return view("auth/register");
});
$router->post('PHP-Auth/auth/register', 'AuthsController@register');

// LOGIN
$router->view('PHP-Auth/auth/login', 'PHP-Auth/login');

$router->get('PHP-Auth/auth/login', function () {
    return view("auth/login");
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
$router->get('PHP-Auth/auth/password/forgot', function () {
    return view("auth/forgot");
});
$router->post('PHP-Auth/auth/password/email', 'AuthsController@sendForgotLink');

// RESET
$router->get('PHP-Auth/auth/password/reset/{token}', function ($token) {
    return view('auth/reset', compact("token"));
});
$router->post('PHP-Auth/auth/password/reset', 'AuthsController@resetPassword');


$router->get('PHP-Auth/truncate', function () {
    $db = new \Core\Database\QueryBuilder(APP['database']);
    $db->query("TRUNCATE TABLE users;TRUNCATE TABLE email_token");
    redirect("PHP-Auth");
});

$router->get('PHP-Auth/reset/token', function () {
    $_SESSION['token'] = bin2hex(random_bytes(20));
    redirect("PHP-Auth");
});