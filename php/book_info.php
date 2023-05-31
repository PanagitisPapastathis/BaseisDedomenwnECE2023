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
        include 'connection.php';
        $conn = OpenCon();
        $isbn = $_GET['isbn'];

        $query = "SELECT B.*, A.Name AS AuthorName, P.Name AS PublisherName,
            CASE WHEN C.Available_copies > 0 THEN 'available' ELSE 'not available' END AS av_c,
            GROUP_CONCAT(S.subject_name SEPARATOR ', ') AS SubjectNames
            FROM Books B
            JOIN book_author BA ON B.ISBN = BA.ISBN
            JOIN Author A ON BA.Author_id = A.Author_id
            JOIN book_publisher BP ON B.ISBN = BP.ISBN
            JOIN Publisher P ON BP.Publisher_id = P.Publisher_id
            LEFT JOIN Copies C ON B.ISBN = C.ISBN
            JOIN book_subject BS ON B.ISBN = BS.ISBN
            JOIN Subject S ON BS.Subject_id = S.Subject_id
            WHERE B.ISBN = '$isbn'
            GROUP BY B.ISBN";
            $result = mysqli_query($conn, $query);

            if ($row = mysqli_fetch_assoc($result)) {
                // Retrieve the data and assign it to variables
                $ISBN = $row['ISBN'];
                $title = $row['Title'];
                $image = $row['Image']; // Replace with the actual image path
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
        <div class="button">
            <button>Lend</button>
            <button>Make a Reservation</button>
            <button>Make a Review</button>
        </div>
    </div>
</body>
</html>





