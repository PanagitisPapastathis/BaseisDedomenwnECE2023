<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Central Admin Add School
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>
<body>
<nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Add School</a>
            <a id="navbar-items" href="home.php">
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>
    <div class="container">
    <div class="row" id="row">
        <div class="col-md-12">
        <form action="./central_admin_view_schools_add.php" method="post">
            <p>
                <label for="school_name">School Name:</label>
                <input type="text" name="school_name" id="school_name" placeholder="Enter school name" required>
                <br> <br>
                <label for="school_address">School Address:</label>
                <input type="text" name="school_address" id="school_address" placeholder="Enter school address" required>
                <br> <br>
                <label for="school_postal_code">School Postal Code:</label>
                <input type="text" name="school_postal_code" id="school_postal_code" placeholder="Enter school postal code" required>
                <br> <br>
                <label for="school_city">School City:</label>
                <input type="text" name="school_city" id="school_city" placeholder="Enter school city" required>
                <br> <br>
                <label for="new_phone_number">Phone Number:</label>
                <input type="text" name="new_phone_number" id="new_phone_number" placeholder="0000000000" required>
                <br> <br>
                <label for="new_email">Email:</label>
                <input type="text" name="new_email" id="new_email" placeholder="New Email" required>
                <br> <br>
                <label for="new_headmaster_name">Headmaster:</label>
                <input type="text" name="new_headmaster_name" id="new_headmaster_name" placeholder="New Headmaster Name" required>
                <br> <br>
                <button type="submit">Submit</button>
            </p>
        </form>
        <a href="./central_admin_view_schools.php">
            <button type="button">Cancel</button>
        </a>
        </div>
        <div class="form-group col-sm-3 mb-3">
        <?php
        include 'connection.php';
        $conn=OpenCon();
        session_start();
    //$name=$_GET['id'];
    //echo ''.$_GET['id'].'';
    //$name=$_SESSION['name'];
    //echo '<br>'.$_SESSION["name"].'<br>';
    $sname= isset($_POST["school_name"]) ? $_POST["school_name"] : '';
    $addr= isset($_POST["school_address"]) ? $_POST["school_address"] : '';
    $pc= isset($_POST["school_postal_code"]) ? $_POST["school_postal_code"] : '';
    $city= isset($_POST["school_city"]) ? $_POST["school_city"] : '';
    $pnum= isset($_POST["new_phone_number"]) ? $_POST["new_phone_number"] : '';
    $email= isset($_POST["new_email"]) ? $_POST["new_email"] : '';
    $hname= isset($_POST["new_headmaster_name"]) ? $_POST["new_headmaster_name"] : '';
    //$saname= isset($_POST["new_school_admin_name"]) ? $_POST["new_school_admin_name"] : '';
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        if (isset($_POST["new_email"])){
            echo '<hr>Invalid email format, please try again';
        }
    }
    else{
        $query="insert into School (Name, Address, Postal_code, City, Phone_number, Email, Headmaster_name) values ('$sname', '$addr', '$pc', '$city', '$pnum', '$email', '$hname')";
        if(mysqli_query($conn, $query)){
            //echo "Record added successfully";
            header("Location: ./central_admin_view_schools.php");
            exit();
        }
        else{
            echo "Error on insertion: <br>" .mysqli_error($conn)."<br>";
        }
    }
    ?>
        </div>
    </div>
    </div>
</div>
    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
