<!DOCTYPE html>
<html>
<head>
    <title>Lending Rules</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

</head>
<body>
<link rel="stylesheet" href="../styles.css">
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Databases PHP Demo
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>


<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Booking</a>
            <a id="navbar-items" href="home.php">
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>
    <body>


<body>
    <h2>Booking Rules</h2>
    <p>
        Blah blah blah... 
    </p>
    <p>
        More details... 
    </p>
    <?php include '../connection.php';
        $conn = OpenCon();
        session_start();
        $isbn = $_GET['ISBN'];
        ?>
    <div class="button-container">
        <form method="post" action="booking.php?isbn='<?php $isbn ?>'">    
        <button type="submit" name="book">Proceed to Booking</button>
        </form>
    </div>
    <a href="./book_info.php">
        <button type="button">Back</button>
    </a>
    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>
</html>
<?php
    // lend.php

    if (isset($_POST['book'])) {
        include '../connection.php';
        $conn = OpenCon();
        session_start();
        $username = $_SESSION["username"];
        $isbn = $_GET['ISBN'];
        
        $subquery = "select c.Copy_id 
        from Copies as c
        join Users as u on c.School_Name  = u.School_Name 
        where c.ISBN = '$isbn'
        and u.Username = '$username'";
        
        $result=mysqli_query($conn, $subquery);
        
        
        if ($row = mysqli_fetch_assoc($result)) {
           $copy_id = $row['Copy_id'];    
           $query = "insert into Booking(Username, Copy_id) values ('$username', $copy_id)" ; #!!!!!!!!!!
           {if (mysqli_query($conn, $query)) {
                header("Location: ./success.php");
                exit;
            } else {
            
                echo "Error: " . mysqli_error($conn);
            }
            }
        }

    }
?>
