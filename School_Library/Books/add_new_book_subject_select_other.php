<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Add Book that doesn't exist in the Database Add Subject Select Other
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Add Book that doesn't exist in the Database Add Subject Select Other</a>
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
        <form action="add_new_book_subject_select_other.php?isbn=<?php echo''.$isbn.''?>" method="post">
        <p>
                 <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" placeholder="Subject" required>
                <button type="submit">Add</button>
        </p>
        </form>
        <?php
    $subject=isset($_POST["subject"]) ? $_POST["subject"] : '';
    $query="insert into Subject (Subject_name) values ('$subject')";
    if($subject!=''){
        if(mysqli_query($conn, $query)){
            //echo '<h2>Insertion into Subject succeeded!</h2>';
            $query="select Subject_id from Subject where Subject_name='$subject'";
            $result=mysqli_query($conn, $query);
            $row=mysqli_fetch_row($result);
            $query="insert into Book_Subject (Subject_id, ISBN) values ('$row[0]', '$isbn')";
            if(mysqli_query($conn, $query)){
                //echo '<h2>Insertion into Book_Subject succeeded!</h2>';
                header("Location:./add_new_book_subject.php?isbn=$isbn");
                exit();
            }
            else {
                echo '<h2>Insertion into Book_Subject did not succeed!</h2>';
            }
        }
        else {
            echo '<h2>Insertion into Subject did not succeed!</h2>';
        }
    }
    ?>
    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </body>
    </html>