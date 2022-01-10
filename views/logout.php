<?php 
    session_start();
    if (isset($_SESSION['user_id'])) {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_type']);
        unset($_SESSION['message']);
    }
    session_destroy();
    header("Location: signin_page.php");
    die;
?>