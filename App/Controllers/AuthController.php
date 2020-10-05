<?php
namespace App\Controllers;

use \App\Models\User;

class AuthController
{
/**
 * register
 * login
 * logout
 * verify email
 * resend email link
 * send forgot password email
 * show forgot password reset form
 * reset forgot password
 */


    public function register()
    {
        // VALIDATE CSRF

        $this->validate(request());

        $name = request('name');
        $email = request('email');
        $password = password_hash(request('password'), PASSWORD_DEFAULT);

        if ($user = User::find($email)) {
            error('email address already exist');
        }

        User::register($name, $email, $password);

        // \Core\Mail::to($email)
        //  ->subject("Hello, {$username}")
        //  ->view("register")
        //  ->send();

        $_SESSION['auth']['name'] = request('name');
        $_SESSION['auth']['email'] = request('email');

        return view("home", compact('user'));
    }

    public function login()
    {
        // VALIDATE CSRF

        $request = request();

        if (! $user = User::find($request['email'])) {
            $_SESSION['error'] = "Email doesnt exists";
            return redirect("/login");
        }


        if (! password_verify($request['password'], $user->password)) {
            $_SESSION['error'] = "Password is incorrect";
            return redirect("/login");
        }

        User::setLogggedIn($user->id);

        $_SESSION['auth']['name'] = $user->name;
        $_SESSION['auth']['email'] = $user->email;


        return view("home", compact('user'));
    }

    public function logout()
    {
        // VALIDATE CSRF
        if (! User::setLoggedOut($_SESSION['auth']['username'])) {
            error("Update logged_out failed");
        }

        session_start();
        session_unset();
        session_destroy();

        return redirect('/');
    }

    public function verifyEmail()
    {
        if (! $user = User::findEmailToken(request("email"))) {
            error("Email doesnt exists");
        }

        if (! hash_equals($user->token, request('token'))) {
            error("Invalid Token");
        }

        if (! User::verified($user->email)) {
            error("Update verified user failed");
        }

        return redirect("/PHP-Auth/home");
        // verify token
        // update user
        // redirect home
    }

    public function sendConfirmLinkEmail()
    {
        // Set email_user token or get
        // Mail email verification link
        dd("success");
    }


    public function sendForgotPasswordEmail()
    {
        // Set email_password token
        // Mail password reset link
        dd("Success");
    }

    public function showForgotPasswordResetForm()
    {
        $email = request('email');
        $token = request('token');

        if (! isset($email, $token)) {
            error("419 Unauthorized");
        }

        return view('auth/reset', compact('email', 'token'));
    }

    public function resetForgotPassword()
    {
        // VALIDATE CSRF

        $email = request('email');
        $user = User::findEmailPassword('$email');

        $token = request('token');
        if (! hash_equals($user->token, $token)) {
           error('419 Unauthorized');
        }

        if( request('password') !== request('password_confirmation')) {
            error('password and password confirmation didnt match');
        }

        User::resetPassword($email, $password);
        redirect('/home');
    }

    public function resetPassword($params)
    {
        dd($params);
        $password = request('password');
        $password_confirmation = request('password_confirmation');

        if ($password !== $password_confirmation) {
            error('password and confirm password didnt match');
        }

        $user = User::find($email);

        if(!password_verify($user->password, request('old_password'))) {
            error('old password didnt match');
        }

        if(password_verify($user->password, $password)) {
            error('cant use old password');
        }

        User::resetPassword($password);

        return redirect();

        // VALIDATE CSRF
        // JS validate password and confirm password
        // validate password and confirm password
        // validate old password and database password
        // hash and alter password
        // redirect
    }

    public function validate($params)
    {
        if (! isset($params['email'],
            $params['password'],$params['password_confirmation'])) {
            error("email, password and confirm password is required");
        }

        $email = $params['email'];

        if (strlen($email) < 12 || strlen($email) > 55) {
            error("invalid email length");
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)
            || ! preg_match('/^[a-zA-Z0-9@.]*$/', $email)) {
            error("invalid email");
        }

        $password = $params['password'];

        if (strlen($password) < 8 || strlen($password) > 255) {
            error("password too short");
        }

        if ($password !== $params['password_confirmation']) {
            error("password and confirm password didnt match");
        }
    }
}
