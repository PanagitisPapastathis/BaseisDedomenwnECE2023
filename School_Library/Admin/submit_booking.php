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
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    #session_start();
    $username = $_SESSION['username'];
    $school_name=$_SESSION["school_name"];
    // $lend_status=($_SESSION["status"]=='Student')?'Pending':'Accepted'; // gia na mpei sta bookings
    $school_name = $_SESSION['school_name'];
    if(!isset($_GET['isbn'])) {
        echo "<h2>You fiddled with the link, didn't you?</h2>";
    }
    $isbn = addslashes($_GET['isbn']);
    
    include "../connection.php";
    $conn = OpenCon();
    
    $query = "Select Copy_id FROM Copies WHERE ISBN = '$isbn' AND School_Name = '$school_name' AND NOT Available_copies=0";
    if($result=mysqli_query($conn, $query)) {
        if ($row=mysqli_fetch_row($result)){
            $copyid = $row[0];
            $query = "INSERT INTO Booking (Copy_id, Username) VALUES ('$copyid','$username')";
                
            try{
                mysqli_query($conn, $query);
                header("Location: ./submit_booking_success.php");
                exit;
            }
            catch(Exception $e) {
                echo "<h2>User \"".$username."\" does not exist</h2>";
                echo '<a class="btn btn-primary" id="show-btn" href="./admin.php">
                         <button type="button">Back</button>
                      </a>';
            }
        }
        else {
            echo "<h2>This book is currently not available in your school.</h2>";
            echo '<a class="btn btn-primary" id="show-btn" href="./admin.php">
                      <button type="button">Back</button>
                  </a>';
        }
    } else {
        echo 'Error: '.mysqli_error($conn);
    }

    ?>
</body>
</html>