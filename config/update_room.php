
<?php

    include "database.php";



    $r_num=$_POST['room_number'];
    $r_type=$_POST['room_type'];
    $r_status=$_POST['room_status'];


    $sql = "UPDATE HRMS_room SET room_number = $r_num , room_type=$r_type, room_status=$r_status WHERE room_number=$r_num";


    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully redirecting you back";
      header("refresh:5; ../views/admin/room_page.php");
    } else {
      echo "Error updating record: " . $conn->error;
    }


  ?>
