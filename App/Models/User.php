<?php

namespace App\Models;

use Core\Database\QueryBuilder;

class User
{
    public function register($username, $email, $password)
    {
        $db = new QueryBuilder(APP['database']);
        $id = $this->generateID();
        $sql = "INSERT INTO users (`id`,`username`, `email`, `password`) VALUES (?,?, ?, ?)";
        $db->query($sql, [$id, $username, $email, $password]);
    }

    public function login($username, $password)
    {
        // check if verified
        // fetch user
        // set session
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

    public function generateID()
    {
        $db = new QueryBuilder(APP['database']);
        $id = $db->querySelect('SELECT id FROM users ORDER BY id DESC');

        if (!$id) {
            return 'Acct-10000';
        }

        $hold = explode('-', $id);
        $id = $hold[1]+1;

        return 'Acct-'.$id;
    }
}