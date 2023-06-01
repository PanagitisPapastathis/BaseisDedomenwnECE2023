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

<?php
        include '../connection.php';
        $conn = OpenCon();
        $isbn = $_GET['isbn'];

        $query = "SELECT * from Book_Info bi
        where bi.ISBN = '$isbn'";
            $result = mysqli_query($conn, $query);
            if ($row = mysqli_fetch_assoc($result)) {
                $ISBN = $row['ISBN'];
                session_start();
                $_SESSION["ISBN"] = $isbn;
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
            <form method="post" action="./lend.php">
                <button type="submit" name="lend">Lend</button>
            </form>
            <form method="post" action="./booking.php">
                <button type="submit" name="lend">Make a reservation</button>
            </form>
            <form method="post" action="./review.php">
                <button type="submit" name="lend">Make a review</button>
            </form>
        </div>


    </div>
</body>
</html>





