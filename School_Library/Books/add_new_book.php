<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Add Book that doesn't exist in the Database
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Add Book that doesn't exist in the Database</a>
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
        <form action="add_new_book.php?isbn=<?php echo''.$isbn.''?>" method="post">
            <p>
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" placeholder="title" required >
                <br>
                <label for="new_summary">Summary:</label>
                <input type="text" name="new_summary" id="new_summary" placeholder="Summary" required>
                <br>
                <label for="new_no_pages">Number of Pages:</label>
                <input type="text" name="new_no_pages" id="new_no_pages" placeholder="Number of Pages" required>
                <br>
                <label for="new_image">Image:</label>
                <input type="text" name="new_image" id="new_image" placeholder="Image" required >
                <br>
                <label for="new_language">Language:</label>
                <input type="text" name="new_language" id="new_language" placeholder="Language" required>
                <br>
                <label for="new_key_words">Key Words:</label>
                <input type="text" name="new_key_words" id="new_key_words" placeholder="Key Words" required>
                <br>
                <label for="no_copies">Number of Copies:</label>
                <input type="text" name="no_copies" id="no_copies" placeholder="Number of Copies" required>
                <br>
                <button type="submit">Done</button>
            </p>
        </form>
    </main>
    <?php
    $title=isset($_POST["title"]) ? $_POST["title"] : '';
    $summary=isset($_POST["new_summary"]) ? $_POST["new_summary"] : '';
    $no_pages=isset($_POST["new_no_pages"]) ? $_POST["new_no_pages"] : '';
    $image=isset($_POST["new_image"]) ? $_POST["new_image"] : '';
    $language=isset($_POST["new_language"]) ? $_POST["new_language"] : '';
    $key_words=isset($_POST["new_key_words"]) ? $_POST["new_key_words"] : '';
    $no_copies=isset($_POST["no_copies"]) ? $_POST["no_copies"] : '';
    $sname=$_SESSION["school_name"];
    $query="insert into Books (ISBN, Title, Summary, No_pages, Image, Book_language, Key_words) values ('$isbn', '$title', '$summary', '$no_pages', 
    '$image', '$language', '$key_words')";
    if($title!=''){
    if(mysqli_query($conn, $query)){
        //echo '<h2>Insertion in Books table Successful!</h2>';
        $query="insert into Copies (ISBN, No_of_copies, School_Name) values ('$isbn', '$no_copies', '$sname')";
        if(mysqli_query($conn, $query)){
            //echo '<h2>Insertion in Copies table Successful!</h2>'; 
            header("Location:./add_new_book_publisher.php?isbn=$isbn");
            exit(); 
        }
        else {
            echo '<h2>Insertion into Copies did not succeed!</h2>';
        }     
        
    }
    else {
        echo '<h2>Insertion into Books did not secceed!</h2>';
    }
}
        /*if(mysqli_query($conn, $query)){
            $query1="update Book_author set Author='$author', where ISBN='$isbn' "; //book author + chech if autgor exists
            if(mysqli_query($conn, $query1)){
                if(mysqli_query($conn, $query1)){
                    $query1="update Publisher set Publisher='$publisher' where ISBN='$isbn' ";     //book publisher + check if publisher exists        
                    header("Location: ./central_admin_profile.php");
                    exit();
                }
                else{
                    echo "Error on Publisher update: <br>" .mysqli_error($conn)."<br>";
                }
            }
            else{
                echo "Error on Author update: <br>" .mysqli_error($conn)."<br>";
            }
        }
        else{
            echo "Error on Book update: <br>" .mysqli_error($conn)."<br>";
        }*/
    
    ?>
    <a href="./add_book.php">
        <button type="button">Cancel</button>
    </a>
    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </body>
</html>