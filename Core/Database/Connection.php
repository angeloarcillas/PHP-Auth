<?php

namespace Core\Database;

class Connection
{
    /**
     * Establish connection to database
     */
    protected static function make($config)
    {
        try {
            return new \PDO(
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}