
<?php

    include "database.php";

    $id = $_GET['id'];
    $status = $_GET['act'];
    $sql = "UPDATE hrms_reservation SET reservation_status=$status WHERE reservation_id=$id";


    if ($conn->query($sql) === TRUE) {
      echo "Action done succesfully";
      header("refresh:1; ../views/admin/reservation_page.php");
    } else {
      echo "Error  " . $conn->error;
    }


  ?>
