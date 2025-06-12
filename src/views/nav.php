<?php declare(strict_types = 1);
namespace MyCompany\Playground\views;
?>
<div class="nav-wrap">
    <nav>
        <a href="">Home</a>
        <?php if ($app->isLoggedIn()) {?>
        | <form action="createPost.php">
            <input type="submit" value="+ New Post" />
        </form>
        <?php }?>
    </nav>
    <nav>
    <?php if ($app->isLoggedIn()) {?>
        <span>Hello, <?= $_SESSION['username'] ?>!</span> |
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <a href="login.php">Login</a> |
        <a href="register.php">Register</a>
    <?php }?>
    </nav>
</div>

