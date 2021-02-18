<?php
// Set php stict types
declare(strict_types=1);

// // Set error reporting to none
// error_reporting(0);

// Check if session started
if (session_status() == PHP_SESSION_NONE) session_start();

use Core\Http\Request;
use Core\Http\Router;

// Load autoload & herlpers
require 'autoload.php';
require 'Core/helpers.php';

// Set configs
$config = require 'config.php';
define('CONFIG', $config);

// Set Router
Router::load('App/routes.php')
    ->direct(Request::url(), Request::method());
