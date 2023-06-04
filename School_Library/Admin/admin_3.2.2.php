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
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
         Admin 3.2.2 Query
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library -  Admin 3.2.2 Query</a>
            <a id="navbar-items" href="index.php">
                <i class="fa fa-home "></i> Log out
            </a>
        </div>
    </nav>

    <div class="container">
    <div class="row" id="row">
        <div class="col-md-12">
        <form action="./admin_3.2.2.php" method="post">
        <p>
                        <label for="criteria">Choose Criteria:</label>
                        <select name="criteria" id="criteria" >
                            <option value="fname">First Name</option>
                            <option value="lname">Last Name</option>
                            <option value="days">Days Dalayed</option>
                        </select>
                        <button type="submit">Done</button>
                    </p>
        </form>
        <a href="./admin.php">
            <button type="button">Cancel</button>
        </a>
        </div>
        <div class="form-group col-sm-3 mb-3">
        <?php
        $criteria= isset($_POST["criteria"]) ? $_POST["criteria"] : '';

        if(isset($_POST["criteria"])){
            switch($criteria){
                case 'fname':
                    header("Location: ./admin_3.2.2_by_first_name.php?sub='$criteria'");
                    exit();
                case 'lname':
                    header("Location: ./admin_3.2.2_by_last_name.php?sub='$criteria'");
                    exit();
                case 'days':
                    header("Location: ./admin_3.2.2_by_days.php?sub='$criteria'");
                    exit();
            }
        }
        else if(isset($_POST["criteria"])){
            echo "Error on Submission <br>" .mysqli_error($conn)."<br>";
        }
    ?>
        </div>
    </div>
    </div>
</div>
    <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>