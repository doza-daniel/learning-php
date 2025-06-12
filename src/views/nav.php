<div class="nav-wrap">
    <nav>
        <a href="">Home</a> |
        <a href="">Blog</a>
    </nav>
    <nav>
    <?php if ($app->isLoggedIn()) {?>
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <a href="login.php">Login</a> |
        <a href="">Register</a>
    <?php }?>
    </nav>
</div>

