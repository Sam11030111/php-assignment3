<?php

/*******w******** 
    
    Name: Hung-Sheng Lee
    Date: June 18th, 2024
    Description: Assignment 3

****************/
require('authenticate.php');
require('connect.php');

if ($_POST) {
    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $query = "INSERT INTO posts (title, content) VALUES (:title, :content)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        
        if ($statement->execute()) {
            header("Location: index.php");
            exit;
        }
    } else {
        header("Location: error.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>My Blog Post!</title>
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
                    <legend>New Blog Post</legend>
                    <p>
                        <label for="title">Title</label>
                        <input name="title" id="title">
                    </p>
                    <p>
                        <label for="content">Content</label>
                        <textarea name="content" id="content"></textarea>
                    </p>
                    <p>
                        <input type="submit" name="command" value="Create">
                    </p>
                    <p>
                        <a href="logout.php">Logout</a>
                    </p>
                </fieldset>
            </form>
        </div>
        <?php include('footer.php'); ?>
    </div>
</body>
</html>