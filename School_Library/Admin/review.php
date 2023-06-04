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
            $query = "SELECT 1 FROM Books WHERE ISBN = '$isbBn'";
            $result=mysqli_query($conn, $query);
            if (mysqli_num_rows($result)!=0) {
                echo '<p>ISBN:'.$isbBn.'</p>';
                echo '<h2>Add a review for this book, ' . $_SESSION["username"] .' from '.$_SESSION["school_name"]. '</h2>';
                echo '<div class="card-body" id="card">
                    <form method="POST" action="./submit_review.php">
                        <input type="hidden" name="isbn" value="'.$isbBn.'">
                        <div class="rating">
                            <input type="radio" name="rating" value="5" id="5" required><label for="5">5☆</label>
                            <input type="radio" name="rating" value="4" id="4"><label for="4">4☆</label>
                            <input type="radio" name="rating" value="3" id="3"><label for="3">3☆</label>
                            <input type="radio" name="rating" value="2" id="2"><label for="2">2☆</label>
                            <input type="radio" name="rating" value="1" id="1"><label for="1">1☆</label>
                        </div>';
                echo "<p>How did you like this book?</p>";
                echo "";
                echo '<textarea name="text" rows="4" cols="50" placeholder="Enter your paragraph" required></textarea>
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
                echo '<h2>Error: Book not found</h2>';
                echo '<div class="card-body" id="card">
                          <a class="btn btn-primary" id="show-btn" href="./admin.php">
                              <button type="button">Back</button>
                          </a>
                      </div>';
            }
        }
        else echo '<h2>Error 420: you fiddled with the link, didn\'t you?</h2>';
    } else {
        echo '<h2>You are not logged in</h2>';
    }
    ?>
</body>
</html>
