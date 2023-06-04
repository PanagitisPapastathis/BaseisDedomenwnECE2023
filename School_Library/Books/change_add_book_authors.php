
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
            <a class="navbar-brand" id="nav-bar-text">School Library - Add Book Author</a>
            <a id="navbar-items" href="../home.php">
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>
    <?php
        include '../connection.php';
        $conn = OpenCon();
        session_start();
        $isbn = $_GET['isbn'];
        $school_name = $_SESSION["school_name"];
        $username = $_SESSION["username"];
        
       
    ?>
    
    <a href=<?php echo '"./change_add_new_book_authors.php?isbn='.$isbn.'"';?>>
        <button type="button">Add New Author</button>
    </a>
    <div class="container">
        <div class="row" id="row">
            <div class="col-md-12">
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <?php
                            $query = "SELECT ba.*, a.Name from Book_Author ba
                            join Author a on ba.Author_id != a.Author_id 
                            where ba.isbn = '$isbn'";
                            $result = mysqli_query($conn, $query);
                            
                            if(mysqli_num_rows($result) == 0){
                                echo '<h1 style="margin-top: 5rem;">No Authors for this book found!</h1>';
                            }
                            else{

                                echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                        echo '<thead>';
                                            echo '<tr>';
                                                echo '<th>Author</th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                            echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        while($row = mysqli_fetch_row($result)){
                                            echo '<tr>';
                                                echo '<td>' . $row[2] . '</td>';
                                                echo '<td>';
                                                    echo '<form method="POST" action="./change_add_existing_book_authors.php?isbn=' . $row[1] .'">';
                                                        echo '<input type="hidden" name="author_name" value="' . $row[2] . '">';
                                                        echo '<button type="submit">';
                                                            echo '<i class="fa fa-add"></i>';
                                                        echo '</button>';
                                                    echo '</form>';
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
    
    
    <a href=<?php echo '"./change_book_authors.php?isbn='.$isbn.'"';?>>
        <button type="button">Back</button>
    </a>

    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>