<?php 
    // unset session and logout user
    session_start();
    $_SESSION['user'] = null;

    header("location:../index.php");
    exit();


?>