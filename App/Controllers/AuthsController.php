<?php
namespace App\Controllers;

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
    
    // $this->validate($request);

    $username = $request['username'];
    $email = $request['email'];
    $password = password_hash($request['password'], PASSWORD_DEFAULT);

    $User = new \App\Models\User;
    if (! $User->register($username, $email, $password)) {
      error("somethings went wrong please try again");
    }
dd("success");
    \Http\Mail::to($email)->subject("Hello, {$username}")->view("register")->send();

    return redirect("/PHP-Auth/auth/login");
  }


  public function validate($params)
  {
    if(! isset($params['username'],$params['email'],
      $params['password'],$params['confirmPassword']))
    {
      error("username, email, password and confirm password is required");
    }
    
    $username = $params['username'];
    if (strlen($username) < 5 && strlen($username) > 55) {
      error("invalid username length");
    }
    if (! preg_match("/^[a-zA-Z ]*$/", $username)) {
      error("invalid username");
    }

    $email = $params['email'];
    if (strlen($username) < 12 && strlen($username) > 55) {
      error("invalid email length");
    }
    if (! filter_var($email, FILTER_VALIDATE_EMAIL) 
    || ! preg_match('/^[a-zA-Z0-9@.]*$/', $email))
    {
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
