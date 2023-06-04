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
            <a class="navbar-brand" id="nav-bar-text">School Library - School Book Update</a>
            <a id="navbar-items" href="../home.php">
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>
<body>
    <?php
include '../connection.php';
$conn = OpenCon();
session_start();
$isbn = $_GET['isbn'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isbn = $_GET['isbn'];
    $key_words = isset($_POST["new_key_words"]) ? $_POST["new_key_words"] : '';
    $summary = isset($_POST["new_summary"]) ? $_POST["new_summary"] : '';
    $language = isset($_POST["new_language"]) ? $_POST["new_language"] : '';
    $no_pages = isset($_POST["new_no_pages"]) ? $_POST["new_no_pages"] : '';

    $query = "UPDATE Books SET Key_words='$key_words', Summary='$summary', Book_language='$language', No_pages='$no_pages' WHERE ISBN='$isbn'";
    if (mysqli_query($conn, $query)) {
        header("Location: ./book_info.php?isbn=$isbn");
        exit();
    } else {
        echo "Error on Book update: <br>" . mysqli_error($conn) . "<br>";
    }
}
?>

<html>
<body>
    <main>
        <form action="books_edit.php?isbn=<?php echo $_GET['isbn']; ?>" method="post">
            <p>
                <label for="new_key_words">New Key Words:</label>
                <input type="text" name="new_key_words" id="new_key_words" placeholder="New Key Words">
                <br>
                <label for="new_summary">New Summary:</label>
                <input type="text" name="new_summary" id="new_summary" placeholder="New Summary">
                <br>
                <label for="new_language">New Language:</label>
                <input type="text" name="new_language" id="new_language" placeholder="New Language">
                <br>
                <label for="new_no_pages">New Number of pages:</label>
                <input type="text" name="new_no_pages" id="new_no_pages" placeholder="New Number of pages">
                <br>
                   
                <button type="submit">Done</button>
                <br>
                <br> 
                <br> 
                
            </p>
        </form>
        <a href=<?php echo '"./change_book_authors.php?isbn='.$isbn.'"';?>>
        <button type="button">Change_Authors</button>
        </a>
        <a href=<?php echo '"./change_book_publisher.php?isbn='.$isbn.'"';?>>
        <button type="submit">Change_Publisher</button>
        </a>
        <a href=<?php echo '"./change_book_subjects.php?isbn='.$isbn.'"';?>>
        <button type="submit">Change_Subjects</button>
        </a>
        <br>
        <br>
        <a href=<?php echo '"./books_for_admin.php?isbn='.$isbn.'"';?>>
        <button type="submit">Back</button>
        </a>
    </main>
</body>
</html>
<script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </body>
</html>