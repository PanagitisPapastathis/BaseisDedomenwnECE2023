<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Add Book that exists in table Books
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Add Book that exists in table Books</a>
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
        <form action="add_not_new_book.php?isbn=<?php echo''.$isbn.''?>" method="post">
            <p>
                <!--<input type="hidden" name="isbn" id="isbn" value="<?php //echo''.$isbn.''?>" >-->
                <label for="no_copies">Number of Copies:</label>
                <input type="text" name="no_copies" id="no_copies" placeholder="Number of Copies"  >
                <br>
                <button type="submit">Done</button>
            </p>
        </form>
        <a href="./add_book.php">
        <button type="button">Cancel</button>
    </a>
        <?php 
        if (!isset($_POST["no_copies"])) return;
        else{
            //$isbn=$_POST["isbn"];
            $ncopies=$_POST["no_copies"];
            $sname=$_SESSION["school_name"]; 
            $query="insert into Copies (No_of_Copies, School_Name, ISBN) values ('$ncopies', '$sname', '$isbn')";
            if (mysqli_query($conn, $query)){
                echo '<h2>Succesful Insertion!</h2>';
                //header("Location:./add_book.php")  // Αυτό το header πρέπει να οδηγεί στην αρχική σελίδα με τον πίνακα των βιβλίων
            }
            else {
                echo '<h2>Insertion did not Succeed</h2>';
            }

        }
        ?>
    </main>
    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    
    </body>
    </html>
