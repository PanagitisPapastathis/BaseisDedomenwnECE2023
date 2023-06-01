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
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h2 class="card-title">Assess review</h2>
                    </div>
                </div>
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', '1');
                        
                        include 'connection.php';
                        $conn = OpenCon();
                        $srn = $_POST['srn'];
                        $query = "SELECT * FROM Accept_Reviews_Help WHERE Serial_Number = $srn"; 
                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<p>No reviews have been submitted by students in your school.</p>';
                        }
                        else{
                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Username</th>';
                                            echo '<th>First Name</th>';
                                            echo '<th>Last Name</th>';
                                            echo '<th>Title</th>';
                                            echo '<th>ISBN</th>';
                                            echo '<th>Submitted at:</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    if($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>'; //username
                                            echo '<td>' . $row[1] . '</td>'; //first name
                                            echo '<td>' . $row[2] . '</td>'; //last name
                                            echo '<td>' . $row[3] . '</td>'; //title
                                            echo '<td>' . $row[4] . '</td>'; //isbn
                                            echo '<td>' . $row[5] . '</td>'; //submitted at
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '<h3>The review:</h3>';
                                    echo '<p>'.$row[7].'</p>';

                                    echo '<form action="./approve_review.php" method="POST">';
                                    echo '<input type="hidden" name="srn" value="'.$row[6].'">';
                                    echo '<button type="submit" style="float: left;">Approve</button>';
                                    echo '</form>';

                                    echo '<form action="./remove_review.php" method="POST">';
                                    echo '<input type="hidden" name="srn" value="'.$row[6].'">';
                                    echo '<button type="submit" style="float: left;">Remove</button>';
                                    echo '</form><br>';

                            echo '</div>';
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