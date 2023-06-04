
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
        $author_name = $_POST['author_name'];
        $query="Select Author_id from Author a where a.Name = '$author_name'    ";
        $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) == 0){
                echo '<h1 style="margin-top: 5rem;">Problem finding this Author!</h1>';
            }
            else if($row = mysqli_fetch_row($result)){
                $query1 = "Insert into Book_Author(Author_id, ISBN) values ($row[0], '$isbn')";
                echo '<h1 style="margin-top: 5rem;">The adding was successfull!</h1>';
            }
    ?>





    <a href=<?php echo '"./change_add_book_authors.php?isbn='.$isbn.'"';?>>
        <button type="button">Add more Authors</button>
    </a>
    <a href=<?php echo '"./book_edit.php?isbn='.$isbn.'"';?>>
        <button type="button">Go Back to edit</button>
    </a>

    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </body>

</html>