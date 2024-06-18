<?php
    function isActive($page) {
        $current_page = basename($_SERVER['PHP_SELF']);
        return $current_page === $page ? 'active' : '';
    }
?>


<ul id="menu">
    <li>
        <a href="index.php" class="<?= isActive('index.php') ?>">Home</a>
    </li>
    <li>
        <a href="post.php" class="<?= isActive('post.php') ?>">New Post</a>
    </li>
</ul>