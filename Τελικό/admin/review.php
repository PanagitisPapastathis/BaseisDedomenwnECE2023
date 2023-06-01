<!DOCTYPE html>
<html>
<head>
    <title>Review</title>
    <style> </style>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION["username"])) {
        echo '<h2>Add a review for this book, ' . $_SESSION["username"] . '</h2>';
        echo '<div class="rating">
                <input type="radio" name="rating" value="5" id="5"><label for="5">5☆</label>
                <input type="radio" name="rating" value="4" id="4"><label for="4">4☆</label>
                <input type="radio" name="rating" value="3" id="3"><label for="3">3☆</label>
                <input type="radio" name="rating" value="2" id="2"><label for="2">2☆</label>
                <input type="radio" name="rating" value="1" id="1"><label for="1">1☆</label>
            </div>';
        echo "<p>Please enter a paragraph of text.</p>"; 
    } else {
        echo '<h2>You aren\'t logged in, m8</h2>';
    }
    ?>

    <form method="POST" action="">
        <textarea name="text" rows="4" cols="50" placeholder="Enter your paragraph"></textarea>
        <br><br>
        <input type="submit" value="Submit">
    </form>

</body>
</html>
