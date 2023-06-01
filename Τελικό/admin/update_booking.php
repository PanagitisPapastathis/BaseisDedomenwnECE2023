<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        User info
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Page</a>
            <a id="navbar-items" href="index.php">
                <i class="fa fa-home "></i> Landing
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row" id="row">
            <div class="col-md-12">
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                    <?php
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);

                        include '../connection.php';
                        $conn = OpenCon();
                        $username = $_GET["username"];
                        $copyid = $_GET["copyid"]; 

                        $query = "DELETE FROM Booking WHERE Username = '$username' AND Copy_id = $copyid";///////////////////////////////////////////////////////////////////////////////
                        if(mysqli_query($conn, $query)) {
                            echo '<h2>Success!</h2>';
                        } else {
                            echo 'Error: '.mysqli_error($conn);
                        }
                    ?>
                    <a type="button" href="./lendings.php">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>
