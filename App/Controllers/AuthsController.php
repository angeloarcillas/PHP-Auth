<?php
namespace App\Controllers;

use \App\Models\User;

class AuthsController
{
    public function showLoginForm()
    {
        return view("auth/login");
    }
  
    public function showRegisterForm()
    {
        return view("auth/register");
    }

    public function register()
    {
        $request = request();
    
        $this->validate($request);

        $username = $request['username'];
        $email = $request['email'];
        $password = password_hash($request['password'], PASSWORD_DEFAULT);

        
        if (! User::register($username, $email, $password)) {
            error("Insert user failed");
        }
        
        // \Http\Mail::to($email)->subject("Hello, {$username}")->view("register")->send();
        $_SESSION['auth']['name'] = $username;
        return redirect("PHP-Auth/home");
    }

    public function login()
    {
        $request = request();

        // select username
        // verify password
        // update login
        // set session
        // success
        if (! $user = User::find($request['username'])) {
            $_SESSION['error'] = "Username or email doesnt exists";
            return redirect("PHP-Auth/auth/login");
        }
        $hold = explode("-", $user->id);
        $user->id = $hold[1];
        
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