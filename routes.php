<?php

// set host
$router->host = 'php-auth';

// set routes
$router->get('/', function () {
  echo "Hello World!";
});
