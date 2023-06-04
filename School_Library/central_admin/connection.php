<?php
function OpenCon(){
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="library_network";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
    if ($conn -> connect_errno){
        echo "Failed to connect to MySQL:" .$conn -> connect_error;
        exit();
    }
    return $conn;
}

function CloseCon($conn){
    $conn -> close();
}
?>