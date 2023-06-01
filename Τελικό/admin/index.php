<?php
session_start();

    include("../connection.php");
    include("../functions.php");

    $user_data = check_login($conn);
?>

<!DOCTYPE html>
<html>
<head>
       <title>Library</title>
</head>
<body>
    <a href = "logout.php">Logout</a>
    <h1>index page </h1>

    <br>
    Hello, Username.
</body>
</html>
