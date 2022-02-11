<?php
function ReportList(){
    include "../../config/database.php";

    $sql = "SELECT * FROM hrms_rooms_reserved A INNER JOIN hrms_reservation B ON A.reservation_id=B.reservation_id INNER JOIN hrms_transaction T ON B.transaction_id=T.transaction_id INNER JOIN hrms_user_profile ON T.client_id=profile_id INNER JOIN hrms_room D ON A.room_id=D.room_id " ;
    $result = mysqli_query($conn,$sql);
    $total = 0;
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['profile_firstname']." ".$row['profile_lastname']. "</td>";
    echo "<td>" . $row['room_number'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['arrival_date'] . "</td>";
    echo "<td>" . $row['departure_date'] . "</td>";

    $A_date=strtotime($row['arrival_date']);
    $D_date=strtotime($row['departure_date']);
    $diff=$D_date-$A_date;
    $days=round($diff / 86400);
    $subtotal=$row['price']*$days;
    echo "<td>" . $subtotal . "</td>";


    $total= $total + $subtotal;
    echo "</tr>";

    }
    echo  "</tbody>";
    echo  "</table>";
    echo  "<div class='card-footer'>";
    echo  "<h4>Total Amount</h4>";
    echo  "<span>Total Amount: $$total </span>";
    echo  "</div>";
  }

  ?>
