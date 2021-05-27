<?php


namespace App\Controllers\Auth;

use \App\Models\User;

class LoginController
{
    public function login()
    {
        verifyCsrf(request()->_csrf);

        $attributes = request()->validate([
            'email' => ['email'],
            'password' => ['min:8', 'max:255']
        ]);

        $user = new User();

        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $isFound = $user->fetch($sql, $attributes);

        if (!$isFound) {
            $_SESSION = ['errors' => ['auth' => "Email or Password didn't match."]];
            return redirect()->back();
        }

        return redirect('dashboard');
    }
}
