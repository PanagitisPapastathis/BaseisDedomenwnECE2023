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
    <title>Succesfully Booked</title>
    <style> </style>
</head>
<body>
    <h2>Booking was succesful!</h2>
    <a class="btn btn-primary" id="show-btn" href="./admin.php">
        <button type="button">Back</button>
    </a>
</body>
</html>