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
        verifyCsrf(request('_csrf'));

        $request = request();

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirm', 'min:8', 'max:255']
        ]);


        $user = new User();
        if ($user->find($request->email, 'email')) {
            session(['errors' => [
                'email' => 'email address already exist'
            ]]);
            return redirect()->back();
        }

        $request->password = password_hash(
            $request->password, PASSWORD_DEFAULT
        );

        $new_user = $user->create($request->all());

        session(['auth' => [
            'name' => $new_user->name,
            'email' => $new_user->email
            ]]);

        return view("home", compact('new_user'));
    }

    public function login()
    {
        verifyCsrf();

        $request = request();
        $user = new User();
        $current_user = $user->find($request->email, 'email');

        if (!password_verify($request->password, $user->password)) {
            session(['errors' =>
                ['password' => "Password is incorrect"
            ]]);

            return redirect()->back();
        }

        $sql = ''; // set logged_in
        $current_user->rawQuery($sql, [$user->id]);

        session(['auth' => [
            'name' => $current_user->name,
            'email' => $current_user->email,
        ]]);

        return view("home", compact('current_user'));
    }

    public function logout()
    {
        // VALIDATE CSRF
        if (!User::setLoggedOut($_SESSION['auth']['username'])) {
            error("Update logged_out failed");
        }

        session_start();
        session_unset();
        session_destroy();

        return redirect('/');
    }

    public function verifyEmail()
    {
        if (!$user = User::findEmailToken(request("email"))) {
            error("Email doesnt exists");
        }

        if (!hash_equals($user->token, request('token'))) {
            error("Invalid Token");
        }

        if (!User::verified($user->email)) {
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

        if (!isset($email, $token)) {
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
        if (!hash_equals($user->token, $token)) {
            error('419 Unauthorized');
        }

        if (request('password') !== request('password_confirmation')) {
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

        if (!password_verify($user->password, request('old_password'))) {
            error('old password didnt match');
        }

        if (password_verify($user->password, $password)) {
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
        if (!isset(
            $params['email'],
            $params['password'],
            $params['password_confirmation']
        )) {
            error("email, password and confirm password is required");
        }

        $email = $params['email'];

        if (strlen($email) < 12 || strlen($email) > 55) {
            error("invalid email length");
        }

        if (
            !filter_var($email, FILTER_VALIDATE_EMAIL)
            || !preg_match('/^[a-zA-Z0-9@.]*$/', $email)
        ) {
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
