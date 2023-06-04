<!DOCTYPE html>
<html>
<head>
    <title>Book Details</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        img {
            width: 200px;
            height: 300px;
        }
        .information {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }
        .information div {
            width: 50%;
        }
        .information p {
            margin: 5px 0;
        }
        .button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<link rel="stylesheet" href="../styles.css">
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Databases PHP Demo
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>


<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Book information</a>
            <a id="navbar-items" href="../home.php">
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>
    <body>

<?php
        include '../connection.php';
        $conn = OpenCon();
        $isbn = $_GET['isbn'];

        $query = "SELECT * from Book_info bi
        where bi.ISBN = '$isbn'";
            $result = mysqli_query($conn, $query);
            if ($row = mysqli_fetch_assoc($result)) {
                $ISBN = $row['ISBN'];
                $title = $row['Title'];
                $image = $row['Image']; 
                $description = $row['Summary'];
                $author = $row['AuthorName'];
                $subject = $row['SubjectNames'];
                $status = $row['av_c'];
                $publisher = $row['PublisherName'];
                $pages = $row['No_pages'];
                $language = $row['Book_language'];
                $keywords = $row['Key_words'];
            }
?>
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <img src="<?php echo $image; ?>" alt="Book Image">
        <p><?php echo $description; ?></p>
        <div class="information">
            <div>
                <p><strong>ISBN:</strong> <?php echo $ISBN; ?></p>
                <p><strong>Author:</strong> <?php echo $author; ?> </p>
                <p><strong>Subject:</strong><?php echo $subject; ?> </p>
                <p><strong>Status:</strong> <?php echo $status; ?></p>
            </div>
            <div>
                <p><strong>Publisher:</strong> <?php echo $publisher; ?></p>
                <p><strong>No of pages:</strong> <?php echo $pages; ?></p>
                <p><strong>Language:</strong> <?php echo $language; ?></p>
                <p><strong>Key Words:</strong> <?php echo $keywords; ?></p>
            </div>
        </div>
        <style>
            .button {
                display: flex;
                gap: 8px;
            }
            .button form {
                display: inline-block;
            }
        </style>

        <div class="button">
            <?php 
                session_start();
                $status=isset($_SESSION['status'])?$_SESSION['status']:0;
                if ($status=='Admin'){
                echo' <a type="button" name="lend" href="../Admin/admin_add_lending.php?isbn='.$isbn. '"">Lend';
                echo '</a>';
                };
                echo' <a type="button" name="booking" href="./submit_booking.php?isbn='.$isbn. '"">Make a reservation';
                echo '</a>';
                echo' <a type="button" name="review" href="./review.php?isbn='.$isbn. '"">Add a review';
                echo '</a>';
            ?>
            <form method="post" action="./booking.php">
             
        </div>
    </div>

    <a href="./books.php">
        <button type="button">Back</button>
    </a>
    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>
</html>





