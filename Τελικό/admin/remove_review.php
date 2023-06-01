<!DOCTYPE HTML>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Library - Administrator Page
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library- School Unit Administrator Page</a>
            <a id="navbar-items" href="index.php"> 
                <i class="fa fa-home "></i>Log Out
            </a>
            <br><br>
        </div>
    </nav>

    <div class="container">
        <div class="row" id="row">
            <div class="col-md-12">
            <div class="col-md-4">
                <div class="card" id="card-container-layout"></div>
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', '1');
                        
                        include '../connection.php';
                        $conn = OpenCon();
                        $srn = $_POST['srn'];
                        $query = "UPDATE Reviews SET Status = 'Removed' WHERE Serial_Number = $srn";
                        
                        if(mysqli_query($conn, $query)){
                            echo '<h2>Review has been removed.</h2>';
                        }
                        else{
                            echo '<p>Error 404: Review not found.</p>';
                        }
                        ?>        
                    </div> <br>
                    <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <a class="btn btn-primary" id="show-btn" href="./admin_reviews.php">Go Back</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>
