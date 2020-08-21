<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    // $_SESSION['token'] = bin2hex(random_bytes(20));
}

use Core\Request;
use Core\Router;

require 'autoload.php';
require 'Core/helpers.php';

$config = require 'config.php';
define('APP', $config);

Router::load('App/routes.php')
    ->direct(Request::uri(), Request::method());