<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Add Book that doesn't exist in the Database Add Subject
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Add Book that doesn't exist in the Database Add Subject</a>
            <a id="navbar-items" href="../home.php">
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>
    <main>
        <?php
        include '../connection.php';
        $conn=OpenCon();
        session_start();
        if(!isset($_GET["isbn"])){
            echo "<h2>Error: isbn fail no english</h2>";
            return;
        }
        $isbn=$_GET['isbn'];
        ?>
        <?php 
        echo '<h2>ISBN:'.$isbn.'</h2>';
        ?>
        <?php
        $query="select Subject_name from Subject";
        $result=mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0){
            echo '<h1 style="margin-top: 5rem;">No Subjects found!</h1>';
        }


        else{

            echo '<div class="table-responsive">';
                echo '<table class="table">';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>Name</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while($row = mysqli_fetch_row($result)){
                        echo '<tr>';
                            echo '<td>' . $row[0] . '</td>';
                            echo '<td>';
                                echo '<a type="button" href="./add_new_book_subject_select.php?isbn='.$isbn.'&name='.$row[0].'">';
                                    echo '<i class="fa fa-check"></i>';
                                echo '</a>';
                            echo '</td>';
                            //echo '<td>';
                                //fecho '<a type="button" href="./delete_student.php?id=' . $row[0]. '">';
                                    //echo '<i class = "fa fa-trash"></i>';
                                //echo '</a>';
                            //echo '</td>';
                        echo '</tr>';
                    }
                    echo '<tr>';
                            echo '<td>Other</td>';
                            echo '<td>';
                                echo '<a type="button" href="./add_new_book_subject_select_other.php?isbn='.$isbn.'">';
                                    echo '<i class="fa fa-check"></i>';
                                echo '</a>';
                            echo '</td>';
                        echo '</tr>';
                    echo '</tbody>';
                echo '</table>';
                echo '<a href="./books_for_admin.php">';
                echo '<button type="button">Finish</button>';
                echo '</a>';
            echo '</div>';
        }
        ?>
        </main>
        <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </body>
    </html>
