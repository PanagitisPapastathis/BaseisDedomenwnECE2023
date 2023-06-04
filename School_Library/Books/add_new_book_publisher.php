<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        School Unit Administrator Add Book that doesn't exist in the Database Add Publisher
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - School Unit Administrator Add Book that doesn't exist in the Database Add Publisher</a>
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
        <form action="add_new_book_publisher.php?isbn=<?php echo''.$isbn.''?>" method="post">
            <p>
                <label for="publisher">Publisher:</label>
                <select name="publisher" id="publisher" required>
                    <?php
                    $q="select Name from Publisher";
                    $res=mysqli_query($conn, $q);
                    if (mysqli_num_rows($res) == 0){
                        echo '<h2>Publishers not found!</h2>';
                    }
                    else {
                        while ($r=mysqli_fetch_row($res)){
                            echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                        }
                        echo '<option value="other">Other</option>';
                    }
                    ?>
                </select>
                <button type="submit">Done</button>
            </p>
        </form>
        <?php 
        $publisher=isset($_POST["publisher"]) ? $_POST["publisher"] : '';
        if($publisher=="other"){
            header("Location:./add_new_book_publisher_other.php?isbn=$isbn");
        }
        else if($publisher!=''){
            $query="select Publisher_id from Publisher where Name='$publisher'";
            $result=mysqli_query($conn, $query);
            $row=mysqli_fetch_row($result);
            $query="insert into Book_Publisher (Publisher_id, ISBN) values ('$row[0]', '$isbn')";
                if(mysqli_query($conn, $query)){
                    //echo '<h2>Insertion into Book_Publisher succeeded!</h2>';
                    header("Location:./add_new_book_author.php?isbn=$isbn");
                    exit();
                }
                else {
                    echo '<h2>Insertion into Publisher did not succeed!</h2>';
                }
        }
        ?>
        </main>
        <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
    </body>
    </html>



