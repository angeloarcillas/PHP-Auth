<?php

namespace App\Controllers\Auth;

class RegisterController
{
    public function register()
    {
        $attributes = request()->validate([
            'username' => ['min:3', 'max:55'],
            'email' => ['required', 'email'],
            'password' => ['min:8', 'max:255', 'confirm']
        ]);

        die(var_dump($attributes));
    }
}
