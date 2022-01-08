<?php 
    $server="localhost";        // server name
    $user="root";		        // user name
    $pass="";			        // user password
    $db_name="CozyHome_DB";    // database name
    
    // Create Connection
    $conn = new mysqli($server,$user,$pass,$db_name);
    
    // Check Connection
    if ($conn->connect_error) {
        die('Connection Failed! '.$conn->connect_error);
    }
?>
