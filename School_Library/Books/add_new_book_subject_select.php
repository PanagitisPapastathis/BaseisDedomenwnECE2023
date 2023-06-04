<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Add Book that doesn't exist in the Database Add Subject Select
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Add Book that doesn't exist in the Database Add Subject Select</a>
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
        <?php
        if(!isset($_GET["name"])){
            echo "<h2>Error: Author name did not transmit!</h2>";
            return;
        }
        $name=$_GET["name"];
        echo $name;
        $query="select Subject_id from Subject where Subject_name='$name'";
        $result=mysqli_query($conn, $query);
        $row=mysqli_fetch_row($result);
        $q="select * from Book_Subject where Subject_id='$row[0]' and ISBN='$isbn'";
        $r=mysqli_query($conn, $q);
        if(mysqli_num_rows($r)==0){
            $query="insert into Book_Subject (Subject_id, ISBN) values ('$row[0]', '$isbn')";
            if(mysqli_query($conn, $query)){
                echo '<h2>Insertion succeeded!</h2>';
                echo '<a href="./add_new_book_subject.php?isbn='.$isbn.'">Back</a>';
            }
            else{
                echo '<h2>Insertion into Book_Subject did not succeed!</h2>';
            }
        }
        else{
            echo '<h2>Subject has already been added!</h2>';
            echo '<a href="./add_new_book_subject.php?isbn='.$isbn.'">Back</a>';
        }
        ?>
        </main>
        <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </body>
</html>