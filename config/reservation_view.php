<?php
function ReservationList(){
    include "../../config/database.php";

    $sql = "SELECT * FROM HRMS_reservation A INNER JOIN HRMS_reservation_status ON reservation_status=status_id INNER JOIN HRMS_transaction T ON A.transaction_id=T.transaction_id INNER JOIN HRMS_user_profile ON T.client_id=profile_id" ;
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['reservation_id'] . "</td>";
    echo "<td>" . $row['profile_firstname'] . "</td>";
    echo "<td>" . $row['profile_address'] . "</td>";
    echo "<td>" . $row['transaction_date'] . "</td>";
    echo "<td>" . $row['confirm_code'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";
    echo "<td>" . $row['total_amount'] . "</td>";
    echo "<td>" ."<span class='status $row[status_description]'>". $row['status_description']."</span>"."</td>";


    echo  "<td>";
    echo  "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#ReserveViewModal$row[transaction_id]' >View</button>";



if ($row['status_id']==1)
    echo  "<button class='btn btn-info'><a href=# class='text-light'>Check-in</a></button>";
if ($row['status_id']==2)
    echo  "<button class='btn btn-danger'><a href=# class='text-light'>Check-out</a></button>";
    echo  "<button class='btn btn-danger'><a href=# class='text-light'>Cancel</a></button>";
    echo  "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#ReserveEditModal$row[transaction_id]'>Edit </button>";
    echo  "</td>";

  echo "</tr>";



    }

  }
  ?>
