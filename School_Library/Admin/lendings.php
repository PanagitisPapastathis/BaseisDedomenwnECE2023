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
                        <h2 class="card-title">Active Lendings</h2>
                    </div>
                </div>
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <?php
                        
                        include '../connection.php';
                        $conn = OpenCon();
                        $school_name = $_SESSION['school_name'];
                        $query = "SELECT * FROM Lending_Help where School_Name = '$school_name' order by Making_date ";///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No active lendings.</h1>';
                        }
                        else{
                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Username</th>';
                                            echo '<th>First Name</th>';
                                            echo '<th>Last Name</th>';
                                            echo '<th>Book Title</th>';
                                            echo '<th>ISBN</th>';
                                            echo '<th>Making Date</th>';
                                            echo '<th> </th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '</td>';
                                            echo '<td>' . $row[2] . '</td>';
                                            echo '<td>' . $row[3] . '</td>';
                                            echo '<td>' . $row[4] . '</td>';
                                            echo '<td>' . $row[5] . '</td>';
                                            echo '<td>';
                                                echo '<a type="button" href="./update_lending.php?copyid=' . $row[6]. '&username=' . $row[0] . '">';
                                                    echo '<i class="fa fa-check"></i>';
                                                echo '</a>';
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
                        <a class="btn btn-primary" id="show-btn" href="./admin.php">
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
