
<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Profile Update
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Remove Author from Book</a>
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
$author_name = $_POST['author_name'];
$query="Select Author_id from Author a where a.Name = '$author_name'    ";
        $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) == 0){
                echo '<h1 style="margin-top: 5rem;">Problem finding this Author!</h1>';
            }
            else if($row = mysqli_fetch_row($result)){
                $query1 = "DELETE FROM Book_Author ba WHERE ba.Name = '$author_name' and ba.Author_id= row[0];";
                echo '<h1 style="margin-top: 5rem;">The deleting was successfull!</h1>';
            }
    if (mysqli_query($conn, $query)) {
        header("Location: ./change_add_book_authors.php?isbn=$isbn");
        exit();
    } else {
        echo "Error on Book update: <br>" . mysqli_error($conn) . "<br>";
    }

?>

<html>
<body>
    <main>
    <a href=<?php echo '"./change_book_authors.php?isbn='.$isbn.'"';?>>
        <button type="button">Edit Authors</button>
    </a>
    <a href=<?php echo '"./book_edit.php?isbn='.$isbn.'"';?>>
        <button type="button">Go Back to edit</button>
    </a>

    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </main>
</body>
</html>
<script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>