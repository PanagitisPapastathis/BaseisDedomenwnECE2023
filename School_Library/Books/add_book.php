<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Add Book 
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Add Book </a>
            <a id="navbar-items" href="../home.php">
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>
    <main>
        <form action="./add_book.php" method="post">
            <p>
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" id="isbn" placeholder="ISBN" required >
                <br>
                <button type="submit">Done</button>
            </p>
        </form>
        <?php
        include '../connection.php';
        $conn=OpenCon();
        session_start();
        $isbn=isset($_POST["isbn"]) ? $_POST["isbn"] : '';
        $query="select ISBN from Books where ISBN='$isbn'";
        if($isbn!=''){
            echo ''.$isbn.'';
            $result=mysqli_query($conn, $query);
            if(mysqli_num_rows($result)==0){
                header("Location:./add_new_book.php?isbn=$isbn");
                exit();
            }
            else{
                header("Location:./add_not_new_book.php?isbn=$isbn");
                exit();
            }
        }
        ?>
        </main>
        <a href="./books_for_admin.php">
            <button type="button">Cancel</button>
        </a>
        <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </body>
</html>

        