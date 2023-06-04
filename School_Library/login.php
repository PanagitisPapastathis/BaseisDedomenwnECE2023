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

        $username = isset($_POST["username"]) ? $_POST["username"] : '';
        $password = isset($_POST["password"]) ? $_POST["password"] : '';
        
        $query = "SELECT * FROM Users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $storedPassword = $row['Password'];
            $status = $row['Status'];
        
            if ($password == $storedPassword) {
                
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["school_name"]= $row['School_Name'];
                $_SESSION["status"] = $row['Status'];
                
                // Redirect based on user's status
                switch ($status) {
                    case 'Student':
                        header("Location: ./Student/Student.php");
                        break;
                    case 'Teacher':
                        header("Location: ./Teacher/teacher.php");
                        break;
                    case 'Admin':
                        header("Location: ./Admin/admin.php");
                        break;
                    case 'Central Admin':
                        header("Location: ./Central_admin/central_admin.php");
                        break;
                    default:
                        echo "Invalid user status.";
                }
                exit; // Make sure to exit after redirecting
            } else {
                echo "Incorrect password.";
            }
        } else if (isset($_POST["username"])) {
            echo "User does not exist.";
        }
        $conn -> close();
    ?>
</form>
</p>
    <?php if(isset($error)) { echo $error; } ?>
</body>
</html>