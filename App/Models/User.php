<?php

namespace App\Models;

use Core\Database\QueryBuilder;

class User
{
    public static function register($name, $email, $password)
    {
        $db = new QueryBuilder(APP['database']);
        $id = self::generateID();
        $sql = "INSERT INTO users (`id`,`name`, `email`, `password`, `logged_in`, `created_at`) VALUES (?,?, ?, ?, NOW(), NOW())";
        $db->query($sql, [$id, $name, $email, $password]);
        self::setEmailToken($email, csrf_token());
        return true;
    }

    public static function find($email)
    {
        $db = new QueryBuilder(APP['database']);
        $sql = "SELECT * FROM users WHERE `email` = ? LIMIT 1";

        return $db->querySelect($sql, [$email]);
    }

    public static function setLogggedIn($id)
    {
        $id = "Acct-{$id}";
        $db = new QueryBuilder(APP['database']);
        $sql = "UPDATE users SET `logged_in` = NOW() WHERE `id` = ?";
        return $db->query($sql, [$id]);
    }

    public static function setLoggedOut($id)
    {
        $db = new QueryBuilder(APP['database']);
        $id = "Acct-{$id}";
        $sql = "UPDATE users SET `logged_out` = NOW() WHERE `id` = ?";
        return $db->query($sql, [$id]);
    }

    public static function setEmailToken($email, $token)
    {
        $db = new QueryBuilder(APP['database']);
        $sql = "INSERT INTO email_user (`email`,`token`) VALUES (?,?)";
        return $db->query($sql, [$email, $token]);
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
