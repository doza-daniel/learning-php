<?php declare(strict_types = 1); 

namespace MyCompany\Playground;

session_start();

require(__DIR__ . '/../vendor/autoload.php');

use MyCompany\Playground\App;

$app = new App();

$uri = $_SERVER['REQUEST_URI'];

if (preg_match('/\/?login.php\/?$/', $uri)) {
  require('views/login.php');
} else if (preg_match('/\/?logout.php\/?$/', $uri)) {
  require('views/logout.php');
} else if (preg_match('/\/?register.php\/?$/', $uri)) {
  require('views/register.php');
} else if (preg_match('/\/?createPost.php(\/|\?)?$/', $uri)) {
  require('views/createPost.php');
} else {
  $view = require('views/home.php');
  $view($app);
}
