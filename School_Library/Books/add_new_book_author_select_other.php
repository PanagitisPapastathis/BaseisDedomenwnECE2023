<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Add Book that doesn't exist in the Database Add Author Select Other
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Add Book that doesn't exist in the Database Add Author Select Other</a>
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
    <form action="add_new_book_author_select_other.php?isbn=<?php echo''.$isbn.''?>" method="post">
        <p>
                 <label for="author">Author:</label>
                <input type="text" name="author" id="author" placeholder="Author" required>
                <button type="submit">Add</button>
        </p>
    </form>
    <?php
    $author=isset($_POST["author"]) ? $_POST["author"] : '';
    $query="insert into Author (Name) values ('$author')";
    if($author!=''){
        if(mysqli_query($conn, $query)){
            //echo '<h2>Insertion into Author succeeded!</h2>';
            $query="select Author_id from Author where Name='$author'";
            $result=mysqli_query($conn, $query);
            $row=mysqli_fetch_row($result);
            $query="insert into Book_Author (Author_id, ISBN) values ('$row[0]', '$isbn')";
            if(mysqli_query($conn, $query)){
                //echo '<h2>Insertion into Book_Author succeeded!</h2>';
                header("Location:./add_new_book_author.php?isbn=$isbn");
                exit();
            }
            else {
                echo '<h2>Insertion into Book_Author did not succeed!</h2>';
            }

        }
        else {
            echo '<h2>Insertion into Author did not succeed!</h2>';
        }
    }
    ?>
    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </body>
    </html>
