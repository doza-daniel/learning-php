<!DOCTYPE html>
<?php
    require('src/App.php');
    use MyCompany\Playground\App;
    $app = new App();
?>
<html>
<head>
    <title><?= $app->getTitle() ?></title>
    <link rel="stylesheet" href="static/index.css">
</head>
<body>
    <div class="nav-wrap">
        <nav>
            <a href="">Home</a> |
            <a href="">Blog</a>
        </nav>
        <nav>
            <a href="">Login</a> |
            <a href="">Register</a>
        </nav>
    </div>
    <hr />
</body>
</html>
