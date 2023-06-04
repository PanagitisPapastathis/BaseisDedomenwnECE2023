<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Teacher Request
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Teacher Request</a>
            <a id="navbar-items" href="home.php"> 
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>

    <body>
    <main>
        <?php
        include '../connection.php';
        $conn=OpenCon();
        session_start();
        $username=$_SESSION["username"];
        $query="update Users set Status2='Requesting' where Username='$username'";
        if(mysqli_query($conn, $query)){
            echo '<h2>You have requested to become School Admin!</h2>';
            echo '<a href="./teacher.php">';
            echo '<a class="btn btn-primary" id="show-btn" href="./teacher.php">Back</a>';
            echo '</a>';
        }
        else{
            echo '<h2>Request failed!</h2>';
            echo '<a href="./teacher.php"><button type="button>Back</button></a>';
        }
        ?>
        </main>
        </body>
        </html>
    