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
    echo "<td>" . $row['arrival_date'] . "</td>";
    echo "<td>" . $row['confirm_code'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";
    echo "<td>" . ($row['price']*$row['quantity']) . "</td>";
    echo "<td>" ."<span class='status $row[status_description]'>". $row['status_description']."</span>"."</td>";


    echo  "<td>";
    echo  "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#ReserveViewModal'>View</button>";
    echo  "<button class='btn btn-info'><a href=# class='text-light'>Confirm</a></button>";
    echo  "<button class='btn btn-danger'><a href=# class='text-light'>Cancel</a></button>";
    echo  "<button class='btn btn-info'><a href=# class='text-light'>Check-in</a></button>";
    echo  "<button class='btn btn-danger'><a href=# class='text-light'>Check-out</a></button>";
    echo  "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target=''#ReserveEditModal'>Edit </button>";
    echo  "</td>";




    echo "</tr>";
    }

  }
  ?>

  <!--
  <tr>
      <td>1</td>
      <td>Sample</td>
      <td>Hospisyo</td>
      <td>Deluxe Type</td>
      <td>otto</td>
      <td>24sqm</td>
      <td>PHP 11,000</td>
      <td><span class="status Check-Out">Check-Out</span></td>
      <td>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ReserveViewModal">
              View
          </button>
          <button class="btn btn-info"><a href="#" class="text-light">Confirm</a></button>
          <button class="btn btn-danger"><a href="#" class="text-light">Cancel</a></button>
          <button class="btn btn-info"><a href="#" class="text-light">Check-in</a></button>
          <button class="btn btn-danger"><a href="#" class="text-light">Check-out</a></button>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ReserveEditModal">
              Edit
          </button>
      </td>
  </tr>

  <td>1</td>
  <td>Sample</td>
  <td>Otto</td>
  <td>@mdo</td>
  <td>Otto</td>
  <td>Otto</td>
  <td>PHP 11,000</td>
  <td><span class="status Check-In">Check-In</span></td>
  <td>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ReserveViewModal">
          View
      </button>
      <button class="btn btn-info"><a href="#" class="text-light">Confirm</a></button>
      <button class="btn btn-danger"><a href="#" class="text-light">Cancel</a></button>
      <button class="btn btn-info"><a href="#" class="text-light">Check-in</a></button>
      <button class="btn btn-danger"><a href="#" class="text-light">Check-out</a></button>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ReserveEditModal">
          Edit
      </button>
  </td>
</tr>
<tr>
  <td>1</td>
  <td>Sample</td>
  <td>Otto</td>
  <td>@mdo</td>
  <td>otto</td>
  <td>Otto</td>
  <td>PHP 11,000</td>
  <td><span class="status Cancelled">Cancelled</span></td>
  <td>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ReserveViewModal">
          View
      </button>
      <button class="btn btn-info"><a href="#" class="text-light">Confirm</a></button>
      <button class="btn btn-danger"><a href="#" class="text-light">Cancel</a></button>
      <button class="btn btn-info"><a href="#" class="text-light">Check-in</a></button>
      <button class="btn btn-danger"><a href="#" class="text-light">Check-out</a></button>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ReserveEditModal">
          Edit
      </button>
  </td>
</tr>
<tr>
  <td>1</td>
  <td>Sample</td>
  <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
  <td>@mdo</td>
  <td>otto</td>
  <td>Otto</td>
  <td>PHP 11,000</td>
  <td><span class="status Pending">Pending</span></td>
  <td>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ReserveViewModal">
          View
      </button>
      <button class="btn btn-info"><a href="#" class="text-light">Confirm</a></button>
      <button class="btn btn-danger"><a href="#" class="text-light">Cancel</a></button>
      <button class="btn btn-info"><a href="#" class="text-light">Check-in</a></button>
      <button class="btn btn-danger"><a href="#" class="text-light">Check-out</a></button>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ReserveEditModal">
          Edit
      </button>
  </td>
</tr>
-->
