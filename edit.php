<?php

/*******w******** 
    
    Name: Hung-Sheng Lee
    Date: June 18th, 2024
    Description: Assignment 3

****************/

    require('connect.php');
    require('authenticate.php');

    // UPDATE or DELETE
    if ($_POST && isset($_POST['command'])) {
        $command = $_POST['command'];
        
        if ($command === 'Update' && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['id']) && !empty($_POST['title']) && !empty($_POST['content'])) {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            
            $query = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title);        
            $statement->bindValue(':content', $content);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            
            if ($statement->execute()) {
                header("Location: index.php");
                exit;
            }
        } elseif ($command === 'Delete' && isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            
            $query = "DELETE FROM posts WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            
            if ($statement->execute()) {
                header("Location: index.php");
                exit;
            }
        } else {
            header("Location: error.php");
            exit;
        }
    } else if (isset($_GET['id'])) {
        $query = "SELECT * FROM posts WHERE id = :id LIMIT 1";
        $statement = $db->prepare($query);

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();

        $post = $statement->fetch();
    } else {
        $id = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Edit this Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1>
                <a>Sam Lee Blog - New Post</a>
            </h1>
        </div>
        <?php include('nav.php'); ?>
        <div id="all_blogs">
            <form method="post">
                <fieldset>
                    <legend>Edit Blog Post</legend>
                    <p>
                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    </p>    
                    <p>
                        <label for="title">Title</label>
                        <input name="title" id="title" value="<?= $post['title'] ?>" >
                    </p>
                    <p>
                        <label for="content">Content</label>
                        <textarea name="content" id="content"><?= $post['content'] ?></textarea>
                    </p>
                    <p>
                        <input type="submit" name="command" value="Update">
                        <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')">
                    </p>
                </fieldset>
            </form>
        </div>
        <?php include('footer.php'); ?>
    </div>
</body>
</html>