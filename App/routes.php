<?php
// !TODO: Implement password reset
$router->view('PHP-Auth', 'welcome');
$router->view('PHP-Auth/home', 'home');

// REGISTER
$router->view('PHP-Auth/auth/register', 'auth/register');
$router->post('PHP-Auth/auth/register', 'AuthsController@register');

// LOGIN
$router->view('PHP-Auth/auth/login', 'PHP-Auth/login');

$router->view('PHP-Auth/auth/login', 'auth/login');

$router->post('PHP-Auth/auth/login', 'AuthsController@login');

// LOGOUT
$router->post('PHP-Auth/auth/logout', 'AuthsController@logout');

// EMAIL
$router->view('PHP-Auth/auth/email/verify/link', 'auth/verify');
$router->post('PHP-Auth/auth/email/verify/link', 'AuthsController@sendVerifyLink');
$router->get('PHP-Auth/auth/email/verify', 'AuthsController@verifyEmail');

// FORGOT
$router->view('PHP-Auth/auth/password/forgot', 'auth/forgot');
$router->post('PHP-Auth/auth/password/email', 'AuthsController@sendForgotLink');

// RESET
$router->view('PHP-Auth/auth/password/reset/{email}', 'auth/reset');
// pwd/res/em?email=example@mail.com&token=!%!#%!%!$

 // select where email == 1
 // $user->token hash_equals $token
 // update user pwd

 // if id
 // update user pwd

// $router->get('PHP-Auth/auth/password/reset/email', );
$router->post('PHP-Auth/auth/password/reset', 'AuthsController@resetPassword');


$router->get('PHP-Auth/truncate', function () {
    $db = new \Core\Database\QueryBuilder(APP['database']);
    $db->query('TRUNCATE TABLE users;TRUNCATE TABLE email_token');
    redirect('PHP-Auth');
});

$router->get('PHP-Auth/reset/token', function () {
    $_SESSION['token'] = bin2hex(random_bytes(20));
    redirect('PHP-Auth');
});
