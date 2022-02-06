<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "cozyhome@ite4-bsit-ab.com";
$to = "jann.ltr.13@gmail.com";
$subject = "Checking PHP mail";
$message = "PHP mail works just fine";
$headers = "From:" . $from;
if(mail($to,$subject,$message, $headers)) {
    echo "The email message was sent.";
} else {
    echo "The email message was not sent.";
}
?>