<?php
session_start();
require('src/App.php');

use MyCompany\Playground\App;

$app = new App();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" href="static/nav.css">
</head>
<body>
  <?php include_once('src/parts/nav.html') ?>
  <hr />
  <h1>
    <?php
      if ($app->isLoggedIn()) {
        $username = $_SESSION['username'];
        echo "Hello $username";
      } else {
        echo "Hello world";
      }
    ?>
  </h1>
  <?php foreach ($app->getTitles() as $title) { ?>
  <h1><?= $title ?></h1>
  <?php } ?>
</body>
</html>
