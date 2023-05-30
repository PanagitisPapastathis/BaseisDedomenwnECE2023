<?php
    function OpenCon() {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "school_lib";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
        //echo "Connected successfully";
        return $conn;
    }

    function CloseCon($conn) {
            $conn -> close();
    }

    function check_login($conn) {
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $query = "SELECT * FROM Users WHERE Username = '$username' AND Password = '$password' limit 1";
        }
    }
?>
