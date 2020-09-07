<?php
namespace App\Controllers;

use \App\Models\User;

//! VERIFY CSRF TOKEN
class AuthsController
{
    public function register()
    {
        $this->validate(request());

        $username = request('username');
        $email = request('email');
        $password = password_hash(request('password'), PASSWORD_DEFAULT);


        if (! User::register($username, $email, $password)) {
            error("Insert user failed");
        }

        $_SESSION['token'] = bin2hex(random_bytes(20));
        if (! User::setEmailToken($email, $_SESSION['token'])) {
            error("Set email and token to email_token table failed");
        }

        // \Core\Mail::to($email)->subject("Hello, {$username}")->view("register")->send();
        $user = User::find($username);
        $_SESSION['auth']['id'] = $user->id;
        $_SESSION['auth']['name'] = $user->name;
        $_SESSION['auth']['email'] = $user->email;

        return view("home", compact('user'));
    }

    public function login()
    {
        $request = request();

        if (! $user = User::find($request['username'])) {
            $_SESSION['error'] = "Username or email doesnt exists";
            return redirect("PHP-Auth/auth/login");
        }

        if (! password_verify($request['password'], $user->password)) {
            $_SESSION['error'] = "Password is incorrect";
            return redirect("PHP-Auth/auth/login");
        }
        if (! User::setLogggedIn($user->id)) {
            error("Update logged_in failed");
        }

        $_SESSION['auth']['id'] = $user->id;
        $_SESSION['auth']['name'] = $user->username;

        return view("home", compact('user'));
    }

    public function logout()
    {
        if (! User::setLoggedOut($_SESSION['auth']['id'])) {
            error("Update logged_out failed");
        }

        session_start();
        session_unset();
        session_destroy();

        return redirect("PHP-Auth");
    }

    public function sendVerifyLink()
    {
        // Mail email verification link
        dd("success");
    }
    public function verifyEmail()
    {
        // $token = Request::query("token");
        // $email = Request::query("email");

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
        if (! isset($params['username'],$params['email'],
            $params['password'],$params['confirmPassword'])) {
            error("username, email, password and confirm password is required");
        }

        $username = $params['username'];

        if (strlen($username) < 5 || strlen($username) > 55) {
            error("invalid username length");
        }

        if (! preg_match("/^[a-zA-Z0-9 ]*$/", $username)) {
            error("invalid username");
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

        if ($password !== $params['confirmPassword']) {
            error("password and confirm password didnt match");
        }
    }
}
