<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Central Admin 3.1.2 Query
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Central Admin 3.1.2 Query</a>
            <a id="navbar-items" href="index.php">
                <i class="fa fa-home "></i> Log out
            </a>
        </div>
    </nav>
    <div class="container">
    <div class="row" id="row">
        <div class="col-md-12">
        <form action="./central_admin_3.1.2.php" method="post">
        <p>
                        <label for="subject">Choose Subject:</label>
                        <select name="subject" id="subject" >
                            <?php
                            include 'connection.php';
                            $conn=OpenCon();
                            session_start();
                            $query="select Subject_name from subject";
                            $result=mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)==0){
                                echo '<h2>No Subjects found<h2>';
                            }
                            while($row = mysqli_fetch_row($result)){
                                echo '<option value="'.$row[0].'">'.$row[0].'</option>'; 
                            }
                            ?>
                        </select>
                        <button type="submit">Done</button>
                    </p>
        </form>
        <a href="./central_admin.php">
            <button type="button">Cancel</button>
        </a>
        </div>
        <div class="form-group col-sm-3 mb-3">
        <?php
        $subject= isset($_POST["subject"]) ? $_POST["subject"] : '';

        if(isset($_POST["subject"])){
            header("Location: ./central_admin_3.1.2_authors.php?sub='$subject'");
            //exit();
        }
        else if(isset($_POST["subject"])){
            echo "Error on Submission <br>" .mysqli_error($conn)."<br>";
        }
    ?>
        </div>
    </div>
    </div>
</div>
    <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>