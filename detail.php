<?php
    require('connect.php');

    $query = "SELECT * FROM posts WHERE id = :id LIMIT 1";
    $statement = $db->prepare($query);
    
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    $statement->bindValue('id', $id, PDO::PARAM_INT);
    $statement->execute();
    
    $post = $statement->fetch();
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
            <div class="blog_post">
                <h2>
                    <?= $post['title'] ?>
                </h2>
                <p>
                    <small>
                        <?= date('F j, Y, g:i a', strtotime($post['time'])) . " - " ?>
                        <a href="edit.php?id=<?= $post['id'] ?>">edit</a>
                    </small>
                </p>
                <div class="blog_content">
                    <?= $post['content'] ?>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
</body>
</html>