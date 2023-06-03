<?php/* 
$query="select u.Username, u.First_Name, u.Last_Name, u.Birth_Date, count(l.Serial_number) as Books_Lended from Users u inner join lending l on u.Username=l.Username where (extract(year from CURRENT_DATE)-extract(year from u.Birth_Date)<40) and (u.Status='Teacher' or u.Status='Admin') group by u.Username, u.First_Name, u.Last_Name, u.Birth_Date order by Books_Lended DESC";
*/?>


<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Central Admin 3.1.3 Query
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>

<body>
<nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Central Admin 3.1.3 Query</a>
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
                        include 'connection.php';
                        $conn = OpenCon(); 
                        session_start();
                        $query = "select u.Username, u.First_Name, u.Last_Name, u.Birth_Date, count(l.Serial_number) as Books_Lended from Users u inner join lending l on u.Username=l.Username where (extract(year from CURRENT_DATE)-extract(year from u.Birth_Date)<40) and (u.Status='Teacher' or u.Status='Admin') group by u.Username, u.First_Name, u.Last_Name, u.Birth_Date order by Books_Lended DESC";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Users Found found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Username</th>';
                                            echo '<th>First Name</th>';
                                            echo '<th>Last Name</th>';
                                            echo '<th>Birth Date</th>';
                                            echo '<th>Books Lended</th>';
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
                                            echo '<td>';
                                                //echo '<a type="button" href="./central_admin_view_schools_update.php?id=' .$row[0].'">';
                                                    //echo '<i class="fa fa-edit"></i>';
                                                //echo '</a>';
                                            echo '</td>';
                                            echo '<td>';
                                                //fecho '<a type="button" href="./delete_student.php?id=' . $row[0]. '">';
                                                    //echo '<i class = "fa fa-trash"></i>';
                                                //echo '</a>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div>';
                        }
                        ?>          
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p>Return Back:
    <a href="./central_admin.php">
        <button type="button">Back</button>
    </a>
    </p>
</body>
</html>