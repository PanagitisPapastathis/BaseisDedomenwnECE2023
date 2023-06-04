<!DOCTYPE html>
<html lang = "en">

<head>
    <link rel="stylesheet" href="../css/styles.css">
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
            <a class="navbar-brand" id="nav-bar-text">School Library - Books</a>
            <a id="navbar-items" href="../home.php">
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>
    
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
        <a class="navbar-brand" id="nav-bar-text">Add a book</a>
            <a id="navbar-items" href="add_book.php">
                <i class="fa fa-book "></i> Add
            </a>            
        </div>
    </nav>

    <div class="container">
        <div class="row" id="row">
            <div class="col-md-12">
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <ul>
                            <li><a href="#">Search by</a>
                                <ul>
                                    <li><a href="./book_by_title.php">Title</a></li>
                                    <li><a href="./book_by_subject.php">Subject</a></li>
                                    <li><a href="./book_by_author.php">Author</a></li>
                                </ul>
                            </li>
                            
                        </ul>

                        <?php
                            include '../connection.php';
                            $conn = OpenCon();
                            session_start();
                            $username = $_SESSION["username"];
                            $query = "SELECT * from Book_info_small bis
                            JOIN Users AS u ON bis.School_name = u.School_name
                            WHERE u.Username = '$username'";
                            $result = mysqli_query($conn, $query);
                            
                            if(mysqli_num_rows($result) == 0){
                                echo '<h1 style="margin-top: 5rem;">No Books found!</h1>';
                            }
                            else{

                                echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                        echo '<thead>';
                                            echo '<tr>';
                                                echo '<th>Title</th>';
                                                echo '<th>Subjects</th>';
                                                echo '<th>Author</th>';
                                                echo '<th>Number of Copies</th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                            echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        while($row = mysqli_fetch_row($result)){
                                            echo '<tr>';
                                                echo '<td>' . $row[0] . '</td>';
                                                echo '<td>' . $row[4] . '</td>';
                                                echo '<td>' . $row[5] . '</td>';
                                                echo '<td>' . $row[3] . '</td>';
                                                echo '<td>';
                                                echo '<a type="button" href="./book_info.php?isbn=' . $row[1] .'">';
                                                    echo '<i class="fa fa-eye"></i>';
                                                echo '</a>';
                                                echo '<a type="button" href="./books_edit.php?isbn=' . $row[1] .'">';
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
    <a href="../Admin/admin.php">
        <button type="button">Back</button>
    </a>
    

    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>