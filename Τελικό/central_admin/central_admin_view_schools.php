<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Central Admin View Schools
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>
<body>
<nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Central Admin View Schools</a>
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
                        $query = "SELECT * FROM School";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Schools found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Name</th>';
                                            echo '<th>Address</th>';
                                            echo '<th>Postal_code</th>';
                                            echo '<th>City</th>';
                                            echo '<th>Phone Number</th>';
                                            echo '<th>Email</th>';
                                            echo '<th>Headmasters Name</th>';
                                            echo '<th>School Admin Name</th>';
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
                                            echo '<td>' . $row[6] . '</td>';
                                            echo '<td>' . $row[7] . '</td>';
                                            echo '<td>';
                                                echo '<a type="button" href="./central_admin_view_schools_update.php?id=' .$row[0].'">';
                                                    echo '<i class="fa fa-edit"></i>';
                                                echo '</a>';
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
                            echo '<br><br>';
                            echo "Add a School:";
                            echo '<a href="./central_admin_view_schools_add.php">
                            <button type="button">Add</button>
                            </a>';
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














