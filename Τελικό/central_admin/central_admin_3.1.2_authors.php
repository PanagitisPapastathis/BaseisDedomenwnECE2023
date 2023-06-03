<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Central Admin 3.1.1 Query Authors
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Central Admin 3.1.2 Query Authors</a>
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
                        $subject=$_GET['sub'];
                        $query = "SELECT DISTINCT Name from author a inner join book_author ba on ba.Author_id=a.Author_id inner join (select ISBN from book_subject bs inner join subject s on bs.Subject_id=s.Subject_id where s.Subject_name=$subject) sel on sel.ISBN=ba.ISBN";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">Authors not found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Author</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
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
                                echo '<hr>';
                        }
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////// 

                            $query="SELECT distinct First_Name,Last_Name from Users u inner join lending l on u.Username=l.Username inner join copies c on l.Copy_id=c.Copy_id inner join book_subject bs on c.ISBN=bs.ISBN inner join subject s on bs.Subject_id=s.Subject_id where s.Subject_name=$subject and (u.Status='Teacher' or u.Status='Admin')";
                            $result=mysqli_query($conn, $query);
                            if(mysqli_num_rows($result) == 0){
                                echo '<h1 style="margin-top: 5rem;">Teachers not found!</h1>';
                            }
                            else{
                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Teacher First Name</th>';
                                            echo '<th>Teacher Last Name</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '</td>';
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
    <br>
    <a href="./central_admin_3.1.2.php">
        <button type="button">Back</button>
    </a>
    </p>
</body>
</html>