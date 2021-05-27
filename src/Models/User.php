<?php

namespace App\Models;

use \App\Models\Model;

class User extends Model
{
    protected ?string $table = 'users';
    protected array $fillable = ['username', 'email', 'password'];
    protected string $key = 'email';
}
