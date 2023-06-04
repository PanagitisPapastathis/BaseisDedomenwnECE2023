<!DOCTYPE html>
<html>
<head>
    <title>Review Submitted</title>
    <style> </style>
</head>
<body>
    <h2>Your review has been submitted succesfully!</h2>
    <a href=<?php 
        session_start();
        if (!isset($_SESSION['status'])){
            echo '"../home.php"';
            return;
        } 
        $status=$_SESSION['status'];
        switch($status){
            case 'Student':
                echo '"./books.php"';
                break;
            case 'Teacher':
                echo '"./books.php"';
                break;
            case 'Admin':
                echo '"./books_for_admin.php"';
                break;    
            case 'Central Admin':
                echo '"../central_admin/central_admin.php"';
                break;
        }
        ?>>
        <button type="button">Back</button>
    </a>
</body>
</html>