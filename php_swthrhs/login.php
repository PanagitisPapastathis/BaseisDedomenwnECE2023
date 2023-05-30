<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
<h2> Login Page </h2>
<p>
    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" value="Login"> <br> <br>
        <?php
            include 'db_connection.php';
            $conn = OpenCon();

            $username = $_POST["username"];
            $password = $_POST["password"];

            $query = "SELECT Password FROM Users WHERE Username = '$username'";
            $result = mysqli_query($conn, $query);

            if ($fetched_password = mysqli_fetch_row($result)) {
                if ($password == $fetched_password[0]){
                    header("Location: /school_library_htdocs/success.php");
                    exit();
                }
                else {
                    echo "Incorrect password.";
                }
            }
            else {
                echo "User does not exist.";
            }
            CloseCon($conn);
        ?>
    </form>
</p>
<p> Don't have an account? <br>
    <a href="signup.php">Sign up</a>
</p>
</body>
</html>
