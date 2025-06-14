<?php declare(strict_types = 1);
namespace MyCompany\Playground\views;

use MyCompany\Playground\App;

return function(App $app) { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" href="static/nav.css">
  <link rel="stylesheet" href="static/form.css">
  <link rel="stylesheet" href="static/home.css">
</head>
<body>
  <?php require('nav.php') ?>
  <hr />
  <div class="container">
    <?php foreach ($app->getPosts() as $post) { ?>
      <div class="post">
        <div class="post-header">
          <div class="title"><?= $post['title'] ?></div>
          <div class="createdAt"><?= $post['created_at'] ?></div>
        </div>
        <div class="body"><?= $post['body'] ?></div>
      </div>
    <?php } ?>
  </div>
</body>
</html>
<?php } ?>
