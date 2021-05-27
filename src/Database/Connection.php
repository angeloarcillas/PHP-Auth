<?php

namespace App\Database;

use \PDO;

abstract class Connection
{
    /**
     * Establish connection to database
     * 
     * @param array $config
     * 
     */
    protected static function connect(array $config): PDO
    {
        // !FIXME: configs are not sanitized
        // TODO: Check for vulnerability
        return new PDO(
            $config['connection'] . ';dbname=' . $config['name'],
            $config['username'],
            $config['password'],
            $config['options']
        );
    }
}


// abstract ->  abstract -> abstract
// models -> querybuilder -> connection
