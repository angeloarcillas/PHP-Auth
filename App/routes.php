<?php
// !: view route removed change all view route
// TODO: Implement password reset
$router->get('PHP-Auth', fn() => view('welcome'));
$router->get('PHP-Auth/home', fn() => view('home'));

// REGISTER
$router->get('PHP-Auth/auth/register', fn() => view('auth/register')); // showRegisterForm
$router->post('PHP-Auth/auth/register', 'AuthController@register');

// LOGIN
$router->get('PHP-Auth/auth/login', 'auth/login'); // showLoginForm
$router->post('PHP-Auth/auth/login', 'AuthController@login');

// LOGOUT
$router->post('PHP-Auth/auth/logout', 'AuthController@logout');

// EMAIL
$router->get('PHP-Auth/auth/email/confirm', 'auth/verify'); // showResendEmailComfirmForm
$router->post('PHP-Auth/auth/email/confirm', 'AuthController@sendConfirmLinkEmail');
$router->get('PHP-Auth/auth/email/verify', 'AuthController@verifyEmail');

// FORGOT
$router->get('PHP-Auth/auth/password/forgot', 'auth/forgot'); // showForgotPasswordForm
$router->post('PHP-Auth/auth/password/email', 'AuthController@sendResetLinkEmail');
$router->get('PHP-Auth/auth/password/reset', 'AuthController@showResetPasswordForm');
$router->post('PHP-Auth/auth/password/reset', 'AuthController@resetPassword');

// RESET PASSWORD
// show
// update


$router->get('PHP-Auth/truncate', function () {
    $db = new \Core\Database\QueryBuilder(APP['database']);
    $db->query('TRUNCATE TABLE users;TRUNCATE TABLE email_token');
    redirect('PHP-Auth');
});

$router->get('PHP-Auth/reset/token', function () {
    $_SESSION['token'] = bin2hex(random_bytes(20));
    redirect('PHP-Auth');
});


$router->get('PHP-Auth/user/{username}/email/{email}', function ($a) {
    var_dump($a);
});