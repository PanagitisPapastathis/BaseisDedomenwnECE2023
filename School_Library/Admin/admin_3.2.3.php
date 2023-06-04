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
         Admin 3.2.3 Query 
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library -  Admin 3.2.3 Query</a>
            <a id="navbar-items" href="index.php">
                <i class="fa fa-home "></i> Log out
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
                        //session_start();
                        $username=$_SESSION["username"];
                        $query="select School_Name from Users where Username='$username'";
                        $result=mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No School name found!</h1>';
                        }
                        else{
                        $row=mysqli_fetch_row($result);                            
                        $query = "select r.Username, r.First_Name, r.Last_Name, s.Subject_name, avg(r.Rating) as rating from admin_query r inner join book_subject as bs on r.ISBN=bs.ISBN inner join Subject as s on bs.Subject_id=s.Subject_id where r.School_name='$row[0]' group by r.Username, s.Subject_name";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Reviews Found found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Username</th>';
                                            echo '<th>First Name</th>';
                                            echo '<th>Last Name</th>';
                                            echo '<th>Subject</th>';
                                            echo '<th>Average Rating</th>';
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
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div>';
                        }
                    }
                        ?>          
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p>Return Back:
    <a href="./admin.php">
        <button type="button">Back</button>
    </a>
    </p>
</body>
</html>