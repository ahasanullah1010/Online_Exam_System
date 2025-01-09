


<?php
session_start();
include 'includes/config.php';
//include 'includes/header.php';


if (isset($_SESSION['userID'])) {
    if ($_SESSION['role'] == 'admin') {
        header('Location:adminDashboard.php');
    } elseif ($_SESSION['role'] == 'student') {
        header('Location:studentDashboard.php');
    }
}
else{
    header('Location:register.php');
}



?>
