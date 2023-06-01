<!DOCTYPE html>
<html>
<head>
    <title>Lending Rules</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Lending Rules</h2>
    <p>
        Blah blah blah... (Provide information about the lending rules here)
    </p>
    <p>
        More details... (Add additional information if needed)
    </p>
    <div class="button-container">
        <form method="post" action="lend.php">
            <button type="submit" name="lend">Proceed to Lending</button>
        </form>
    </div>
</body>
</html>
<?php
    // lend.php

    if (isset($_POST['lend'])) {
        include '../connection.php';
        $conn = OpenCon();
        session_start();
        $username = $_SESSION["username"];
        $isbn = $_SESSION['ISBN'];
        $query = "insert into Lending(Username, ISBN) values ('$username', '$isbn')" ;
        if (mysqli_query($conn, $query)) {
            header("Location: ./success.php");
            exit;
        } else {
           
            echo "Error: " . mysqli_error($conn);
        }

    }
?>
