<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Profile Update
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Add new Book Author</a>
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isbn = $_GET['isbn'];
    $new_name = isset($_POST["new_name"]) ? $_POST["new_name"] : '';

    $query = "Insert into Author(Name) values ('$new_name')";
    if (mysqli_query($conn, $query)) {
        header("Location: ./change_add_book_authors.php?isbn=$isbn");
        exit();
    } else {
        echo "Error on Book update: <br>" . mysqli_error($conn) . "<br>";
    }
}
?>

<html>
<body>
    <main>
        <form action="change_add_book_authors.php?isbn=<?php echo $_GET['isbn']; ?>" method="post">
            <p>
                <label for="new_name">New Name:</label>
                <input type="text" name="new_name" id="new_name" placeholder="New Name">
                <br>
                <br>
                   
                <button type="submit">Done</button>
                <br>
                <br> 
                <br> 
                
            </p>
        </form>
        <a href=<?php echo '"./change_add_book_authors.php?isbn='.$isbn.'"';?>>
        <button type="submit">Back</button>
        </a>
    </main>
</body>
</html>
    </body>
</html>