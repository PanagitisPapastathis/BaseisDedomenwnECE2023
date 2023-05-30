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
        include 'connection.php';
        $conn = OpenCon();

        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT Password FROM Users WHERE Username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $storedPassword = $row['Password'];
            $status = $row['Status'];
        
            if ($password == $storedPassword) {
                // Redirect based on user's status
                switch ($status) {
                    case 'Student':
                        header("Location: student.php");
                        break;
                    case 'Teacher':
                        header("Location: teacher.php");
                        break;
                    case 'Admin':
                        header("Location: admin.php");
                        break;
                    case 'Central Admin':
                        header("Location: central_admin.php");
                        break;
                    default:
                        echo "Invalid user status.";
                }
                exit; // Make sure to exit after redirecting
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User does not exist.";
        }
        $conn -> close();
    ?>
</form>
</p>
    <?php if(isset($error)) { echo $error; } ?>
</body>
</html>