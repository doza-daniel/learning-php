<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="static/nav.css">
    <link rel="stylesheet" href="static/login.css">
</head>
<body>
  <?php include_once('src/parts/nav.html') ?>
  <hr />
  <div class="container">
    <form class="login" action="login.php" method="POST">
      <div class="form-row">
        <div class="form-column">
          <label>Username: </label>
          <label>Password: </label>
        </div>
        <div class="form-column">
          <input type="text" />
          <input type="password" />
        </div>
      </div>
      <div class="form-row">
        <input type="submit" value="Login">
      </div>
    </form>
  </div>
</body>
</html>
