<?php

namespace App\Controllers\Auth;

use \App\Models\User;

class RegisterController
{
    public function register()
    {
        verifyCsrf(request()->_csrf);
        
        $attributes = request()->validate([
            'username' => ['min:3', 'max:55'],
            'email' => ['required', 'email'],
            'password' => ['min:8', 'max:255', 'confirm']
        ]);

        $user = new User();
        
        $isCreated = $user->insert($attributes);

        if (!$isCreated) {
            return redirect('/php-auth/503');
        }

        return redirect('dashboard');
    }
}
