<?php
// TODO: password reset
$router->get('/', fn () => view('welcome'));
$router->get('/home', fn () => view('home'));

# AUTH
// REGISTER
$router->get('/register', fn () => view('auth/register')); // showRegisterForm
$router->post('/register', 'AuthController@register');

// LOGIN
$router->get('/login', fn () => view('auth/login')); // showLoginForm
$router->post('/login', 'AuthController@login');

// LOGOUT
$router->post('/logout', 'AuthController@logout');

// EMAIL
$router->get('/email/confirm', fn () => view('auth/verify')); // showResendEmailComfirmForm
$router->post('/email/confirm', 'AuthController@sendConfirmLinkEmail');
$router->get('/email/verify', 'AuthController@verifyEmail');

// FORGOT PASSWORD
$router->get('/password/forgot', fn () => view('auth/forgot')); // showForgotPasswordForm
$router->post('/password/forgot', 'AuthController@sendForgotPasswordEmail');
$router->get('/password/forgot/email', 'AuthController@showForgotPasswordResetForm');
$router->post('/password/forgot/reset', 'AuthController@resetForgotPassword');

// RESET PASSWORD
$router->get('/password/reset', fn () => view('auth/reset'));
$router->post('/password/reset', 'AuthController@resetPassword');


$router->get('/truncate', function () {
    $db = new \Core\Database\QueryBuilder(APP['database']);
    $db->query('TRUNCATE TABLE users;TRUNCATE TABLE email_user');
    redirect('/');
});

$router->get('/token', function () {
    $_SESSION['token'] = bin2hex(random_bytes(20));
    redirect('/');
});


$router->get('/user/{username}/email/{email}', function ($a) {
    dd($a);
});
