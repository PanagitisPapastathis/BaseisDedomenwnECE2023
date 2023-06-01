<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Central Admin View Schools Update
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>
<body>
<nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Central Admin School Update</a>
            <a id="navbar-items" href="index.php">
                <i class="fa fa-home "></i> Log out
            </a>
        </div>
    </nav>
    <?php
    include 'connection.php';
    $conn=OpenCon();
    session_start();
    $name=$_GET['id'];
    $q="select Name, Phone_number, Email, Headmaster_name, School_admin_name from School where Name='$name'";
    $result=mysqli_query($conn, $q);
    $row=mysqli_fetch_row($result);

    ?>
    <div class="container">
    <div class="row" id="row">
        <div class="col-md-12">
        <form action="./central_admin_view_schools_update.php" method="post">
            <p>
                <!--<label for="school_name">School Name</label>-->
                <input type="hidden" name="school_name" id="school_name" placeholder="Enter school name" value="<?php echo ''.$row[0].'' ?>" required>
                <label for="new_phone_number">New Phone Number:</label>
                <input type="number" name="new_phone_number" id="new_phone_number" placeholder="0000000000" value="<?php echo ''.$row[1].''?>" required>
                <br> <br>
                <label for="new_email">New Email:</label>
                <input type="text" name="new_email" id="new_email" placeholder="New Email" value="<?php echo ''.$row[2].''?>" required>
                <br> <br>
                <label for="new_headmaster_name">New Headmaster:</label>
                <input type="text" name="new_headmaster_name" id="new_headmaster_name" placeholder="New Headmaster Name" value="<?php echo ''.$row[3].''?>" required>
                <br> <br>
                <label for="new_school_admin_name">New School Admin Name:</label>
                <input type="text" name="new_school_admin_name" id="new_school_admin_name" placeholder="New School Admin Name" value="<?php echo ''.$row[4].''?>" required>
                <br> <br>
                <button type="submit">Done</button>
            </p>
        </form>
        <a href="./central_admin_view_schools.php">
            <button type="button">Cancel</button>
        </a>
        </div>
        <div class="form-group col-sm-3 mb-3">
        <?php
    /*$name=$_GET['id'];
    $_SESSION['id']=$name;
    echo ''.$_GET['id'].'';
    $name=$_SESSION['name'];
    echo '<br>'.$_SESSION["name"].'<br>';*/
    $sname= isset($_POST["school_name"]) ? $_POST["school_name"] : '';
    $pnum= isset($_POST["new_phone_number"]) ? $_POST["new_phone_number"] : '';
    $email= isset($_POST["new_email"]) ? $_POST["new_email"] : '';
    $hname= isset($_POST["new_headmaster_name"]) ? $_POST["new_headmaster_name"] : '';
    $saname= isset($_POST["new_school_admin_name"]) ? $_POST["new_school_admin_name"] : '';
    /*if (isset($_POST["new_phone_number"])){
        $_SESSION['new_phone_number']=$pnum;
        $_SESSION['new_email']=$email;
        $_SESSION['new_headmaster_name']=$hname;
        $_SESSION['new_school_admin_name']=$saname;
    }*/
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        if(isset($_POST["new_email"])){
            echo '<hr>Invalid email format, please try again';
        }
    }
    else{
        $query="update School set Phone_number='$pnum', Email='$email', Headmaster_Name='$hname', School_admin_name='$saname' where Name='$sname' ";
        if(mysqli_query($conn, $query)){
            //echo "Record updated successfully";
            header("Location: ./central_admin_view_schools.php");
            exit();
        }
        else{
            echo "Error on update: <br>" .mysqli_error($conn)."<br>";
        }
    }
    ?>
        </div>
    </div>
    </div>
</div>
    <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>

















