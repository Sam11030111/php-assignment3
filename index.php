<?php

/*******w******** 
    
    Name: Hung-Sheng Lee
    Date: June 18th, 2024
    Description: Assignment 3

****************/
    require('connect.php');

    $query = "SELECT id, title, content, time FROM posts ORDER BY time DESC LIMIT 5";
    $statement = $db->prepare($query);
    $statement->execute();
    $posts = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome to my Blog!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1>
                <a href="index.php">Sam Lee Blog - Index</a>
            </h1>
        </div>
        <?php include('nav.php'); ?>
        <div id="all_blogs">
            <?php foreach ($posts as $post): ?>
                <div class="blog_post">
                    <h2>
                        <a href="detail.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h2>
                    <p>
                        <small>
                            <?= date('F j, Y, g:i a', strtotime($post['time'])) . " - " ?>
                            <a href="edit.php?id=<?= $post['id'] ?>">edit</a>
                        </small>
                    </p>
                    <div class="blog_content">
                        <?php if (strlen($post['content']) > 200): ?>
                            <?= substr($post['content'], 0, 200) . '...' ?>
                            <a href="detail.php?id=<?= $post['id'] ?>">Read more</a>
                        <?php else: ?>
                            <?= $post['content'] ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php include('footer.php'); ?>
    </div>
</body>
</html>