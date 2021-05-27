<?php

// import SimpleRouter
use \SimpleRouter\Router;
use \SimpleRouter\Request;

require 'vendor/autoload.php';

// init router
Router::load('routes.php') // set the routes file
    ->direct(Request::url(), Request::method());
