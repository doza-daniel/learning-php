<?php declare(strict_types = 1);
namespace MyCompany\Playground\views;

if ($app->isLoggedIn()) {
  header('Location: index.php');
  die();
}

$register_failed = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $success = $app->tryRegister();
  if ($success) {
    header('Location: index.php');
    die();
  }
  $register_failed = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="static/nav.css">
    <link rel="stylesheet" href="static/form.css">
</head>
<body>
  <?php include_once('nav.php') ?>
  <hr />
  <div class="container">
    <form class="register" action="register.php" method="POST">
      <?php if ($register_failed) { ?>
      <div class="form-row">
          <span class='warn-form-failed'>Registration failed!</span>
      </div>
      <?php } ?>
      <div class="form-row">
        <div class="form-column">
          <label>Username: </label>
          <label>Password: </label>
          <label>Confirm password: </label>
        </div>
        <div class="form-column">
          <input type="text" name="username" />
          <input type="password" name="password"/>
          <input type="password" name="confirm-password"/>
        </div>
      </div>
      <div class="form-row">
        <input type="submit" value="Register">
      </div>
    </form>
  </div>
</body>
</html>
