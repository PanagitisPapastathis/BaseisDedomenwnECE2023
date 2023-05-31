<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Databases PHP Demo
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>


<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Books</a>
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
                            include 'connection.php';
                            $conn = OpenCon();
                            session_start();
                            $username = $_SESSION["username"];
                            $query = "SELECT b.Title, GROUP_CONCAT(DISTINCT s.Subject_Name) AS Subject_Names, a.Name, b.ISBN
                            FROM books AS b
                            JOIN book_subject AS bs ON b.ISBN = bs.ISBN
                            JOIN Subject AS s ON bs.Subject_id = s.Subject_id
                            JOIN book_author AS ba ON b.ISBN = ba.ISBN
                            JOIN Author AS a ON ba.Author_id = a.Author_id
                            JOIN copies AS c ON b.ISBN = c.ISBN
                            JOIN users AS u ON c.school_name = u.school_name
                            WHERE u.username = '$username'
                            GROUP BY b.Title, a.Name, B.ISBN";
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
                                                echo '<th>Subjects</th>';
                                                echo '<th>Author</th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                            echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        while($row = mysqli_fetch_row($result)){
                                            echo '<tr>';
                                                echo '<td>' . $row[0] . '</td>';
                                                echo '<td>' . $row[1] . '</td>';
                                                echo '<td>' . $row[2] . '</td>';
                                                echo '<td>';
                                                echo '<a type="button" href="book_info.php?isbn=' . $row[3] .'">';
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

    <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>
