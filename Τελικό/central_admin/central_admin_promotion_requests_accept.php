<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
</head>
<body>
    <?php
    include '../connection.php';
    $conn=OpenCon();
    $username=$_GET['id'];
    $query="update Users set Status2='Accepted', Status='Admin' where username='$username'";
    if(mysqli_query($conn, $query)){
        //echo '<h2>Succes!<h2>';
        header("Location:./central_admin_promotion_requests.php");
        exit();
    }
    ?>
    </body>
</html>
