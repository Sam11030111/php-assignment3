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
        <h1>An error occured while processing your post.</h1>
        <p>Both the title and content must be at least one character.</p>
        <a href="index.php">Return Home</a>
        <?php include('footer.php'); ?>
    </div>
</body>
</html>