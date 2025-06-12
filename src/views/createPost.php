<?php declare(strict_types = 1);
namespace MyCompany\Playground\views;

if (!$app->isLoggedIn()) {
  header('Location: index.php');
  die();
}

$create_post_failed = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // TODO: handle post creation
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
      <?php if ($create_post_failed) { ?>
      <div class="form-row">
          <span class='warn-form-failed'>Failed to create the post!</span>
      </div>
      <?php } ?>
      <label for"title">Title:</label>
      <input type="text" name="title">
      <label for"body">Body:</label>
      <textarea cols="80" rows="30" name="body"></textarea>
    </form>
  </div>
</body>
</html>
