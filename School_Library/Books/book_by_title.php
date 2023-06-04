<!DOCTYPE html>
<html lang = "en">

<head>
    <link rel="stylesheet" href="../styles.css">
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Databases PHP Demo
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>


<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Books by Title</a>
            <a id="navbar-items" href="../home.php">
                <i class="fa fa-home "></i> Home
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
                            $query = "SELECT bis.Title, bis.ISBN from Book_info_small bis
                            JOIN Users AS u ON bis.school_name = u.school_name
                            WHERE u.username = '$username' order by bis.Title";
                            $result = mysqli_query($conn, $query);
                            
                            if(mysqli_num_rows($result) == 0){
                                echo '<h1 style="margin-top: 5rem;">No Students found!</h1>';
                            }
                            else{

                                echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                        echo '<thead>';
                                            echo '<tr>';
                                                echo '<th>Title</th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                            echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        while($row = mysqli_fetch_row($result)){
                                            echo '<tr>';
                                                echo '<td>' . $row[0] . '</td>';
                                                echo '<td>';
                                                echo '<a type="button" href="book_info.php?isbn=' . $row[1] .'">';
                                                    echo '<i class="fa fa-edit"></i>';
                                                echo '</a>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        echo '</tbody>';
                                    echo '</table>';
                                echo '</div>';
                            }
                        ?>          
                    </div>
                    <a action></a>
                </div>
            </div>
        </div>
    </div>
    <a href=<?php 
        //session_start();
        if (!isset($_SESSION['status'])){
            echo '"./index.php"';
            return;
        } 
        $status=$_SESSION['status'];
        switch($status){
            case 'Student':
                echo '"./books.php"';
                break;
            case 'Teacher':
                echo '"./books.php"';
                break;
            case 'Admin':
                echo '"./books_for_admin.php"';
                break;    
            case 'Central Admin':
                echo '"../central_admin/central_admin.php"';
                break;
        }
        ?>>
        <button type="button">Back</button>
    </a>

    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>