<?php

// check if session started
if (session_status() === PHP_SESSION_NONE) {
    // start a session
    session_start();
}

// import SimpleRouter
use \SimpleRouter\Router;
use \SimpleRouter\Request;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/helpers.php';

$config = require_once 'config.php';
define('CONFIG', $config);

// init router
Router::load('src/routes.php') // set the routes file
    ->direct(Request::url(), Request::method());
