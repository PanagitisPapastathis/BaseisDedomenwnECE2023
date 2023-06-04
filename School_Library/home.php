<?php
session_start();
$status = isset($_SESSION['status'])?$_SESSION['status']:'';

switch ($status) {
    case 'Student': 
        header('Location: Student/student.php');
        exit;
    case 'Teacher': 
        header('Location: Teacher/teacher.php');
        exit;
    case 'Admin': 
        header('Location: Admin/admin.php');
        exit;
    case 'Central Admin': 
        header('Location: Central_admin/central_admin.php');
        exit;
    default:
        header('Location: index.php');
        exit;
}
?>