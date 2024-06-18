<?php
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Our Blog"');
    echo "<p>You have been logged out. <a href='index.php'>Go to homepage</a></p>";
    exit();
?>

