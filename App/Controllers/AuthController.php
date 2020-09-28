<?php
namespace App\Controllers;

use \App\Models\User;

class AuthController
{
    public function register()
    {
        $this->validate(request());

        $name = request('name');
        $email = request('email');
        $password = password_hash(request('password'), PASSWORD_DEFAULT);

        if (User::find($email)) {
            error('email address already exist');
        }

        User::register($name, $email, $password);

        // \Core\Mail::to($email)
        //  ->subject("Hello, {$username}")
        //  ->view("register")
        //  ->send();

        $_SESSION['auth']['name'] = request('name');
        $_SESSION['auth']['email'] = request('email');

        $user = User::find($email);

        return view("home", compact('user'));
    }

    public function login()
    {
        $request = request();

        if (! $user = User::find($request['email'])) {
            $_SESSION['error'] = "Email doesnt exists";
            return redirect("PHP-Auth/auth/login");
        }

        dd($user);

        if (! password_verify($request['password'], $user->password)) {
            $_SESSION['error'] = "Password is incorrect";
            return redirect("PHP-Auth/auth/login");
        }

        if (! User::setLogggedIn($user->id)) {
            error("Update logged_in failed");
        }

        $_SESSION['auth']['name'] = $user->name;
        $_SESSION['auth']['email'] = $user->email;


        return view("home");
    }

    public function logout()
    {
        if (! User::setLoggedOut($_SESSION['auth']['username'])) {
            error("Update logged_out failed");
        }

        session_start();
        session_unset();
        session_destroy();

        return redirect('/');
    }

    public function sendVerifyLink()
    {
        // Mail email verification link
        dd("success");
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

        redirect("/PHP-Auth/home");
        // verify token
        // update user
        // redirect home
    }

    public function sendResetLinkEmail()
    {
        // Mail password reset link
        dd("Success");
    }
    public function showResetPasswordForm()
    {
        $email = request('email');
        $token = request('token');

        if (! isset($email, $token)) {
            error("email & token is required");
        }

        return view('auth/reset', compact('email', 'token'));
    }

    public function resetPassword()
    {
        dd("reset");

        if (! $user = User::findEmailToken($email)) {
            error("email doesnt exist");
        }
        if (! hash_equals($user->token, $token)) {
            error("token mismatch");
        }

        // UPDATE users SET `password` = ? WHERE `email` = ?;
        // $db->query($sql, [$password, $email]);
        // success
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

        return ['email' => $email, 'password' => $password];
    }
}
