<?php declare(strict_types = 1); 

namespace MyCompany\Playground\views;

if ($app->isLoggedIn()) {
  header('Location: index.php');
  die();
}

$login_failed = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $success = $app->tryLogin();
  if ($success) {
    header('Location: index.php');
    die();
  }
  $login_failed = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="static/nav.css">
    <link rel="stylesheet" href="static/login.css">
</head>
<body>
  <?php include_once('nav.php') ?>
  <hr />
  <div class="container">
    <form class="login" action="login.php" method="POST">
      <?php if ($login_failed) { ?>
      <div class="form-row">
          <span class='warn-login-failed'>Login failed!</span>
      </div>
      <?php } ?>
      <div class="form-row">
        <div class="form-column">
          <label>Username: </label>
          <label>Password: </label>
        </div>
        <div class="form-column">
          <input type="text" name="username" />
          <input type="password" name="password"/>
        </div>
      </div>
      <div class="form-row">
        <input type="submit" value="Login">
      </div>
    </form>
  </div>
</body>
</html>
