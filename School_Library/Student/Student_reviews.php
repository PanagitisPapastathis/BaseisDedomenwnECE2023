
<!DOCTYPE HTML>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Library - Administrator Page
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library- School Unit Administrator Page</a>
            <a id="navbar-items" href="../home.php"> 
                <i class="fa fa-home "></i>Home
            </a>
            <br><br>
        </div>
    </nav>

    <div class="container">
        <div class="row" id="row">
            <div class="col-md-12">
            
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h2 class="card-title">Submitted Reviews</h2>
                    </div>
                </div>
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', '1');
                        session_start();
                        include '../connection.php';
                        $conn = OpenCon();
                        $username = $_SESSION['username'];
                        $query = "SELECT * FROM Accept_Reviews_Help WHERE Status='Accepted' and Username = '$username'"; 
                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<p>No reviews have been accepted.</p>';
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
                                            echo '<th> </th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>'; //username
                                            echo '<td>' . $row[1] . '</td>'; //first name
                                            echo '<td>' . $row[2] . '</td>'; //last name
                                            echo '<td>' . $row[3] . '</td>'; //title
                                            echo '<td>' . $row[4] . '</td>'; //isbn
                                            echo '<td>' . $row[5] . '</td>'; //submitted at
                                            echo '<td>';
                                                echo '<form action="./student_view_reviews.php" method="post">';
                                                    echo '<input type="hidden" name="username" value='. $row[0] .'>';
                                                    echo '<input type="hidden" name="isbn" value='. $row[4] .'>';
                                                    echo '<button type="submit" class="btn btn-primary">';
                                                        echo '<i class="fa fa-eye"></i>';
                                                    echo '</button>';
                                                echo '</form>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div>';
                        }
                        ?>          
                    </div> <br>
                    <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <a class="btn btn-primary" id="show-btn" href="./Student.php">
                            <button type="button">Back</button>
                        </a>
                    </div>
                </div>
                </div>
            
        </div>
    </div>

    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>
