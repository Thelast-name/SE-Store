<?php 
    session_start();

    if(isset($_GET['logout'])){
        session_unset();
        header('location: login.php');
    }
?>