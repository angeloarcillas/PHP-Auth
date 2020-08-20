<?php

namespace App\Models;

use Core\Database\QueryBuilder;

class User
{
    public static function register($username, $email, $password)
    {
        $db = new QueryBuilder(APP['database']);
        $id = self::generateID();
        $sql = "INSERT INTO users (`id`,`username`, `email`, `password`, `logged_in`, `created_at`) VALUES (?,?, ?, ?, NOW(), NOW())";
        return $db->query($sql, [$id, $username, $email, $password]);
    }

    public static function find($username)
    {
        $db = new QueryBuilder(APP['database']);
        $sql = "SELECT * FROM users WHERE `username` = ? or `email` = ?";
        return $user = $db->querySelect($sql, [$username, $username]);
    }
    public function setLogggedIn($id)
    {
        $id = "Acct-{$id}";
        $db = new QueryBuilder(APP['database']);
        $sql = "UPDATE users SET `logged_in` = NOW() WHERE `id` = ?";
        return $db->query($sql, [$id]);
    }
    
    public function logout($id)
    {
        $db = new QueryBuilder(APP['database']);
        $id = "Acct-{$id}";
        $sql = "UPDATE users SET `logged_out` = NOW() WHERE `id` = ?";
        return $db->query($sql, [$id]);
    }

    public function VerifyUser($email, $token)
    {
        $db = new QueryBuilder(APP['database']);
        $sql = "SELECT token FROM user_verify WHERE email = ?";
        $DB_token = $db->querySelect($sql, [$email]);
        if (hash_equals($DB_token, $token)) {
            $sql = "UPDATE users SET status = ?";
            $db->query($sql, ["verified"]);
        }
    }

    public static function generateID()
    {
        $db = new QueryBuilder(APP['database']);
        $user = $db->querySelect('SELECT id FROM users ORDER BY id DESC');
        if (!$user) {
            return 'Acct-10000';
        }
        $hold = explode('-', $user->id);
        $id = $hold[1]+1;

        return 'Acct-'.$id;
    }
}