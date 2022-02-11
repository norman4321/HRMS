<?php
function ReservationList(){
    include "../../config/database.php";

    $sql = "SELECT reservation_id,profile_firstname,profile_address,confirm_code,quantity,status_description,status_id,A.transaction_id FROM hrms_reservation A INNER JOIN hrms_reservation_status ON reservation_status=status_id INNER JOIN hrms_transaction T ON A.transaction_id=T.transaction_id INNER JOIN hrms_user_profile ON T.client_id=profile_id" ;
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['reservation_id'] . "</td>";
    echo "<td>" . $row['profile_firstname'] . "</td>";
    echo "<td>" . $row['profile_address'] . "</td>";

    echo "<td>" . $row['confirm_code'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";

    echo "<td>" ."<span class='status $row[status_description]'>". $row['status_description']."</span>"."</td>";


    echo  "<td>";
    echo  "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#ReserveViewModal$row[transaction_id]' >View</button>";



if ($row['status_id']==1)
    echo  "<button class='btn btn-info'><a href='../../config/reservation_action.php?id=$row[reservation_id]&act=2' class='text-light'>Check-in</a></button>";
if ($row['status_id']==2)
    echo  "<button class='btn btn-danger'><a href='../../config/reservation_action.php?id=$row[reservation_id]&act=3' class='text-light'>Check-out</a></button>";
if ($row['status_id']!=4)
    echo  "<button class='btn btn-danger'><a href='../../config/reservation_action.php?id=$row[reservation_id]&act=4' class='text-light'>Cancel</a></button>";
    echo  "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#ReserveEditModal$row[transaction_id]'>Edit </button>";
    echo  "</td>";
    echo "</tr>";



    }

  }
  ?>
