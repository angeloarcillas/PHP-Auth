<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use Core\{Request, Router};

require 'autoload.php';
require 'Core/helpers.php';

$config = require 'config.php';
define('APP', $config);

Router::load('App/routes.php')
    ->direct(Request::uri(), Request::method());