<?php

namespace App\Models;

use Core\Blueprint\Model;
use Core\Database\QueryBuilder;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'logged_in'];

    public  function setLogggedIn($id)
    {
        $id = "Acct-{$id}";
        $db = new QueryBuilder(APP['database']);
        $sql = "UPDATE users SET `logged_in` = NOW() WHERE `id` = ?";
        return $db->query($sql, [$id]);
    }

    public  function setLoggedOut($id)
    {
        $db = new QueryBuilder(APP['database']);
        $id = "Acct-{$id}";
        $sql = "UPDATE users SET `logged_out` = NOW() WHERE `id` = ?";
        return $db->query($sql, [$id]);
    }

    public function setEmailToken($email, $token)
    {
        $sql = "INSERT INTO email_user (`email`,`token`) VALUES (?,?)";
        return $this->rawQuery($sql, [$email, $token]);
    }

    public function findEmailToken($email)
    {
        $db = new QueryBuilder(APP['database']);
        $sql = "SELECT * FROM email_user WHERE `email` = ?";
        return $db->querySelect($sql, [$email]);
    }

    public function verify($email)
    {
        $db = new QueryBuilder(APP['database']);
        $sql = "UPDATE users SET `verified_at` = NOW() WHERE `email` = ?";

        if (! $db->query($sql, [$email])) {
            return false;
        }

        $sql = "DELETE FROM email_user WHERE `email` = ?";
        return $db->query($sql, [$email]);
    }

    public static function generateID()
    {
        $db = new QueryBuilder(APP['database']);
        $user = $db->querySelect('SELECT id FROM users ORDER BY id DESC LIMIT 1');
        if (!$user) {
            return 'Acct-10000';
        }
        $hold = explode('-', $user->id);
        $id = $hold[1]+1;

        return 'Acct-'.$id;
    }
}
