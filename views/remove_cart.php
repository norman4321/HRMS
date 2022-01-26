<?php
    session_start();
    #unset($_SESSION['cart']);
    #unset($_SESSION['unavailable']);
    #header("Location: cart_page.php");
    if (isset($_GET['action']) && isset($_SESSION['cart'])) {
        if ($_GET['action'] == 'remove') {
            if (isset($_GET['item'])) {
                unset($_SESSION['cart'][$_GET['item']]);
            } elseif (isset($_GET['unavailable'])) {
                unset($_SESSION['cart'][$_GET['unavailable']]);
            }
            header("Location: cart_page.php");
        } elseif ($_GET['action'] == 'clear') {
            unset($_SESSION['cart']);
            header("Location: cart_page.php");
        }
    }
?>
