<?php

namespace App\Models;

use \App\Models\Model;

class User extends Model
{
    protected ?string $table = 'users';
    protected $filable = ['username', 'email', 'password'];
}
