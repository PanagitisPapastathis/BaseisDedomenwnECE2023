<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Profile Update
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Update</a>
            <a id="navbar-items" href="index.php">
                <i class="fa fa-home "></i> Landing
            </a>
        </div>
    </nav>
    <main>
        <form action="update_central_admin_profile.php" method="post">
            <p>
                <label for="new_first_name">New First Name:</label>
                <input type="text" name="new_first_name" id="new_first_name" placeholder="New First Name" required>
                <br>
                <label for="new_last_name">New Last Name:</label>
                <input type="text" name="new_last_name" id="new_last_name" placeholder="New Last Name" required>
                <br>
                <label for="new_email">New Email:</label>
                <input type="text" name="new_email" id="new_email" placeholder="New Email" required>
                <br>
                <label for="new_phone_number">New Phone Number:</label>
                <input type="number" name="new_phone_number" id="new_phone_number" placeholder="0000000000" required>
                <br>
                <label for="new_school_name">New School Name:</label>
                <input type="text" name="new_school_name" id="new_school_name" placeholder="New School Name" required>
                <br>
                <button type="submit">Done</button>
            </p>
        </form>
    </main>
    <?php
    include '../connection.php';/////
    $conn=OpenCon();
    session_start();
    $username=$_SESSION["username"];
    $fname=$_POST["new_first_name"];
    $lname=$_POST["new_last_name"];
    $email=$_POST["new_email"];
    $pnum=$_POST["new_phone_number"];
    $sname=$_POST["new_school_name"];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<hr>Invalid email format, please try again';
    }
    else{
        $query="update Users set First_Name='$fname', Last_Name='$lname', Email='$email', Phone_number='$pnum', School_Name='$sname' where Username='$username' ";
        if(mysqli_query($conn, $query)){
            //echo "Record updated successfully";
            header("Location: ./central_admin_profile.php");
            exit();
        }
        else{
            echo "Error on update: <br>" .mysqli_error($conn)."<br>";
        }
    }
    ?>
    </body>
</html>
