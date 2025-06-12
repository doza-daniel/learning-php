<?php declare(strict_types = 1); 

namespace MyCompany\Playground\views;

?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" href="static/nav.css">
</head>
<body>
  <?php require('nav.php') ?>
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
</body>
</html>
