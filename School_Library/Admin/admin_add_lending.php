<?php
session_start();
if(!isset($_SESSION['status'])){
    header('Location: ../home.php');
    exit;
}
if($_SESSION['status']!='Admin') {
    header('Location: ../home.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Review</title>
    <style> </style>
</head>
<body>
    <?php
    include '../connection.php';
    $conn = OpenCon();
    #session_start();
    if (isset($_SESSION["username"])) {
        if (isset($_GET['isbn'])) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $isbBn = $_GET["isbn"];
            $query = "SELECT Title, Copy_id FROM Books JOIN Copies
            ON Copies.ISBN = Books.ISBN
            WHERE Books.ISBN = '$isbBn' AND NOT Copies.Available_Copies = 0";
            $result=mysqli_query($conn, $query);
            if ($row=mysqli_fetch_row($result)) {
                echo '<p>ISBN:'.$isbBn.'</p>';
                echo '<h2>Lend "' .$row[0].'" from '.$_SESSION["school_name"]. '</h2>';
                echo '<div class="card-body" id="card">
                    <form method="POST" action="./admin_submit_lending.php">
                    <input type="hidden" name="copyid" value="'.$row[1].'">';
                echo '<input type="hidden" name="isbn" value="'.$isbBn.'">';
                echo "<h4>Username:<h/4><br>";
                echo "";
                echo '<input type="text" name="username" required>
                        <br><br>
                        <input type="submit" value="Submit">
                    </form>
                </div><br>
                <div class="card-body" id="card">
                    <a class="btn btn-primary" id="show-btn" href="./admin.php">
                        <button type="button">Back</button>
                    </a>
                </div>';
            }
            else {
                echo "<h2>This book is currently not available in your school.</h2>";
                echo '<a class="btn btn-primary" id="show-btn" href="./admin.php">
                          <button type="button">Back</button>
                      </a>';
            }
        }
        else echo '<h2>Error 420: you fiddled with the link, didn\'t you?</h2>';
    } else {
        echo '<h2>You are not logged in</h2>';
    }
    ?>
</body>
</html>
