<!DOCTYPE html>
<html>
<head>
    <title>Review</title>
    <style> </style>
</head>
<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    $username = $_SESSION['username'];
    $review = addslashes($_POST['text']);
    $rating = $_POST['rating'];
    $school_name = $_SESSION['school_name'];
    $isbn = addslashes($_POST['isbn']);
    
    include "../connection.php";
    $conn = OpenCon();
    

    //$query = "INSERT INTO Reviews (Review, Username, ISBN, Status) VALUES ('$review', '$username','$isbn','Pending')";
    $query = "INSERT INTO Reviews (Review, Rating, Username, ISBN, Status) VALUES ('$review', $rating, '$username','$isbn','Pending')";
    //na mpei sta triggers oti oi students ypovalloun me status = pending kai oi ypoloipoi me accepted

    if(mysqli_query($conn, $query)) {
        header("Location: ./submit_review_success.php");
        exit;
    } else {
        echo 'Error: '.mysqli_error($conn);
    }

    ?>
</body>
</html>
