<?php declare(strict_types = 1); 

namespace MyCompany\Playground;

session_start();

require(__DIR__ . '/../vendor/autoload.php');

use MyCompany\Playground\App;

$app = new App();

$uri = $_SERVER['REQUEST_URI'];

if (preg_match('/\/?login.php\/?$/', $uri)) {
  require('views/login.php');
} else {
  require('views/home.php');
}
