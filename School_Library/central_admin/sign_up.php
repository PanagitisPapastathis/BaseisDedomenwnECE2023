<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Central Admin View Schools
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>
    <body>
        <article id="sign_up">
            <fieldset>
                <legend>Sign Up</legend>
                <form method="post">
                <p>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="on" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </p>
                <p>
                    <form method="post">
                        <label for="First_Name">First Name</label>
                        <input type="text" name="First_Name" id="First_Name"
                        required>                   
                </p>
                <p>
                    <label for="Last_Name">Last Name</label>
                    <input type="text" name="Last_Name" id="Last_Name"
                    required>
                </p>
                <p>
                    <label for="Birth_Date">Birth Date</label>
                    <input type="date" name="Birth_Date" id="Birth_Date"
                    required>
                </p>
                <p>
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </p>
                <p>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" pattern="[0-9]{10}" required> 
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </p>
                <p>
                    <label for="school_name">School Name</label>
                    <input type="text" name="school_name" id="school_name" required>
                </p>
                <br>
                <a href="log_in.html">
                    <button type="submit">Done</button>
                </a>
                </form> 
            </fieldset>  
        </article>
        <?php
        include 'connection.php';
        $conn=OpenCon();
        session_start();
        $username=(isset($_POST["username"])) ? $_POST["username"] : '';
        $pass=(isset($_POST["password"])) ? $_POST["password"] : '';
        $fname=(isset($_POST["First_Name"])) ? $_POST["First_Name"] : '';
        $lname=(isset($_POST["Last_Name"])) ? $_POST["Last_Name"] : '';
        $bdate=(isset($_POST["Birth_Date"])) ? $_POST["Birth_Date"] : '';
        $status=(isset($_POST["status"])) ? $_POST["status"] : '';
        $phone=(isset($_POST["phone"])) ? $_POST["phone"] : '';
        $email=(isset($_POST["email"])) ? $_POST["email"] : '';
        $sname=(isset($_POST["school_name"])) ? $_POST["school_name"] : '';
        $status2='Pending';
        $query="insert into Users (Username, Password, First_Name, Last_Name, Birth_Date, Status, Status2, Phone_number, Email, School_Name) values ('$username', '$pass', '$fname', '$lname', '$bdate', '$status', '$status2', '$phone', '$email', '$sname')";
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            if (isset($_POST["new_email"])){
                echo '<hr>Invalid email format, please try again';
            }
        }
if($username!=''){
    if(mysqli_query($conn, $query)){
        if($status=="teacher"){
            //echo '<h2>Successful Sign up as teacher!</h2>';
            //header("Location:./teacher.php");//εδώ να μπει το link για τη σελιδα του student
            //exit();
            echo '<h2>You are now Signed up as Teacher!</h2>';
        }
        else if($status="student"){
            //echo '<h2>Successful Sign up as student!</h2>';
            //header("Location:./Student.php");//εδώ να μπει το link για τη σελιδα του teacher
            //exit();
            echo '<h2>You are now Signed up as Student!</h2>';
        }
        
        else if (isset($_POST["username"])){
            echo '<h2>Sign Up Did Not Succeed!</h2>';
        }
    }
}
        ?>
    </body>
</html>