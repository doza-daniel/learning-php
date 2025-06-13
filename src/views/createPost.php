<?php declare(strict_types = 1);
namespace MyCompany\Playground\views;

if (!$app->isLoggedIn()) {
  header('Location: index.php');
  die();
}

$create_post_successful = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!$app->tryCreatePost()) {
    $create_post_successful = false;
  } else {
    $create_post_successful = true;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>New post</title>
    <link rel="stylesheet" href="static/nav.css">
    <link rel="stylesheet" href="static/form.css">
</head>
<body>
  <?php include_once('nav.php') ?>
  <hr />
  <div class="container">
    <form action="createPost.php" method="POST">
      <?php if ($create_post_successful === false) { ?>
      <div class="form-row">
          <span class='error-form'>Failed to create the post!</span>
      </div>
      <?php } else if ($create_post_successful === true) { ?>
      <div class="form-row">
          <span class='success-form'>Post created successfully!</span>
      </div>
      <?php } ?>
      <label for"title">Title:</label>
      <input type="text" name="title">
      <label for"body">Body:</label>
      <textarea cols="80" rows="30" name="body"></textarea>
      <input type="submit" name="submit" value="Create">
    </form>
  </div>
</body>
</html>
