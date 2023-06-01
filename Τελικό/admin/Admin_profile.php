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
                            include '../connection.php';
                            $conn = OpenCon();
                            session_start();
                            $username = $_SESSION["username"];
                            $query = "SELECT * FROM Users u where u.username = '$username'";
                            $result = mysqli_query($conn, $query);
                            
                            if(mysqli_num_rows($result) == 0){
                                echo '<h1 style="margin-top: 5rem;">Profile not found.</h1>';
                            }
                            else{
                                echo '<h2 class="card-title">User Info</h2>';
                                echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                        echo '<thead>';
                                            echo '<tr>';
                                                echo '<th>First Name</th>';
                                                echo '<th>Last Name</th>';
                                                echo '<th>Username</th>';
                                                echo '<th>Email</th>';
                                                echo '<th>Phone Number</th>';
                                                echo '<th>School Name</th>';
                                                echo '<th>Registration Date</th>';
                                                echo '<th>Books Lended</th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                            echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        while($row = mysqli_fetch_row($result)){
                                            echo '<tr>';
                                                echo '<td>' . $row[2] . '</td>';
                                                echo '<td>' . $row[3] . '</td>';
                                                echo '<td>' . $row[0] . '</td>';
                                                echo '<td>' . $row[6] . '</td>';
                                                echo '<td>' . $row[5] . '</td>';
                                                echo '<td>' . $row[9] . '</td>';
                                                echo '<td>' . $row[7] . '</td>';
                                                echo '<td>' . $row[8] . '</td>';
                                            echo '</tr>';
                                        }
                                    echo '</table><br>';
                                    echo '<a class="btn btn-primary" id="show-btn" href="update_profile.php">Click here to update your profile</a>';
                                echo '</div>';//xrhsimo comment
                            }
                        ?> <br>
                        <a type="button" href="./Admin.php">Go back</a>         
                    </div>
                    <a action></a>
                </div>
            </div>
        </div>
    </div>

    <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>
