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
                        <h2 class="card-title">New accounts</h2>
                    </div>
                </div>
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <?php
                        
                        include '../connection.php';
                        $conn = OpenCon();

                        $query = "SELECT Username, First_Name, Last_Name, Email FROM Users WHERE Status2='Pending'"; 
                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<p>No new accounts.</p>';
                        }
                        else{                            
                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Username</th>';
                                            echo '<th>First Name</th>';
                                            echo '<th>Last Name</th>';
                                            echo '<th>Email</th>';
                                            echo '<th></th>';
                                            echo '<th></th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';  // Username
                                            echo '<td>' . $row[1] . '</td>';  // First Name
                                            echo '<td>' . $row[2] . '</td>';  // Last Name
                                            echo '<td>' . $row[3] . '</td>';  // Book Title
                                            echo '<td>' . $row[4] . '</td>';  // ISBN
                                            echo '<td>' . $row[5] . '</td>';  // Making Date
                                            echo '<td>';
                                                echo '<a type="button" href="./accept_new_account.php?username='. $row[0] . '">';
                                                    echo '<i class="fa fa-check"></i>';
                                                echo '</a>';
                                            echo '</td>';
                                            echo '<td>';
                                                echo '<a type="button" href="./reject_new_account.php?username='. $row[0] . '">';
                                                    echo '<i class="fa fa-times" style="color: red;"></i>';
                                                echo '</a>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div><br>';
                        }

                        echo "<h2 class=\"card-title\">New accounts</h2>"; //this line is breaking my code. why? fix it
                        
                        $query = "SELECT Username, First_Name, Last_Name, Email FROM Users WHERE Status2='Requesting'"; 
                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<p>No requests to become admin.</p>';
                        }
                        else{                            
                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Username</th>';
                                            echo '<th>First Name</th>';
                                            echo '<th>Last Name</th>';
                                            echo '<th>Email</th>';
                                            echo '<th></th>';
                                            echo '<th></th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';  // Username
                                            echo '<td>' . $row[1] . '</td>';  // First Name
                                            echo '<td>' . $row[2] . '</td>';  // Last Name
                                            echo '<td>' . $row[3] . '</td>';  // Book Title
                                            echo '<td>' . $row[4] . '</td>';  // ISBN
                                            echo '<td>' . $row[5] . '</td>';  // Making Date
                                            echo '<td>';
                                                echo '<a type="button" href="./accept_new_account.php?username='. $row[0] . '">';
                                                    echo '<i class="fa fa-check"></i>';
                                                echo '</a>';
                                            echo '</td>';
                                            echo '<td>';
                                                echo '<a type="button" href="./reject_new_account.php?username='. $row[0] . '">';
                                                    echo '<i class="fa fa-times" style="color: red;"></i>';
                                                echo '</a>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div>';
                        }
                        ?>
                        <br>
                        <a type="button" href="./Admin.php">Go back</a>       
                    </div> <br>
                </div>
            </div>
        </div>
    </div>

    <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>
