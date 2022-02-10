<?php


function ReservationModalView(){
    include "../../config/database.php";


  //  $sql = "SELECT * FROM HRMS_rooms_reserved A INNER JOIN HRMS_reservation B ON A.reservation_id=B.reservation_id INNER JOIN HRMS_transaction T ON B.transaction_id=T.transaction_id INNER JOIN HRMS_user_profile ON T.client_id=profile_id INNER JOIN HRMS_room D ON A.room_id=D.room_id " ;
$sql = "SELECT DISTINCT transaction_id FROM HRMS_transaction";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result))
    {

      //modal
      echo  "<div class='modal fade' id='ReserveViewModal$row[transaction_id]' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='ViewModal' aria-hidden='true'>";
      echo      "<div class='modal-dialog modal-dialog-scrollable modal-xl'>";
      echo         " <div class='modal-content'>";

      echo              "<div class='modal-header'>";
      echo                 "<h5 class='modal-title' id='ViewModal'>Booked Details</h5>";
      echo             "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
      echo              "</div>";
      echo              " <div class='modal-body'>";
      echo                    "<table id='reservationPage' class='table'>";
      echo                        "<thead align='center'>";
      echo                            "<tr>";
      echo                                "<th scope='col'>Room No.</th>";
      echo                                "<th scope='col'>Room Name</th>";
      echo                                "<th scope='col'>Room Image</th>";
      echo                                "<th scope='col'>Arrival Date&Time</th>";
      echo                                "<th scope='col'>Departure Date&Time</th>";
      echo                                "<th scope='col'>Price/Rate</th>";
      echo                            "</tr>";
      echo                        "</thead>";
      echo                        "<tbody align='center'>";



      echo                      ViewModalContents($row['transaction_id']);



      echo                        "</tbody>";
      echo                    "</table>";
      echo                "</div>";
      echo                "<div class='modal-footer'>";
      echo                    "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
      echo                "</div>";
      echo            "</div>";
      echo      "</div>";
      echo  "</div>";


    }
  }




function ViewModalContents($trans_id){
  include "../../config/database.php";
    $sql = "SELECT * FROM HRMS_rooms_reserved A INNER JOIN HRMS_reservation B ON A.reservation_id=B.reservation_id INNER JOIN HRMS_transaction T ON B.transaction_id=T.transaction_id INNER JOIN HRMS_user_profile ON T.client_id=profile_id INNER JOIN HRMS_room D ON A.room_id=D.room_id INNER JOIN HRMS_room_type ON room_type=type_id WHERE B.transaction_id=$trans_id" ;

echo $trans_id;
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result))
    {
    echo                            "<tr>";
    echo                                "<td>"."$row[room_number]"."</td>";
    echo                                "<td>"."$row[type_name]"."</td>";
    echo                                "<td><img src="."../". $row['room_image']."></td>";
    echo                                "<td>"."$row[arrival_date]"."</td>";
    echo                                "<td>"."$row[departure_date]"."</td>";
    echo                                "<td>"."$row[room_price]"."</td>";
    echo                          "</tr>";
  }
}



  ?>


<!--
  <div class="modal fade" id="ReserveViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ViewModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-xl">
          <div class="modal-content">


              <div class="modal-header">
                  <h5 class="modal-title" id="ViewModal">Booked Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <table id="reservationPage" class="table">
                      <thead align="center">
                          <tr>
                              <th scope="col">Room No.</th>
                              <th scope="col">Room Name</th>
                              <th scope="col">Room Image</th>
                              <th scope="col">Arrival Date&Time</th>
                              <th scope="col">Departure Date&Time</th>
                              <th scope="col">Price/Rate</th>
                          </tr>
                      </thead>
                      <tbody align="center">
                          <tr>
                              <td>1</td>
                              <td>Sample</td>
                              <td><img src="../../public/images/room_sample.jpg"></td>
                              <td>02/25/25 11:00:00</td>
                              <td>02/25/25 11:00:00</td>
                              <td>PHP 11,000</td>
                          </tr>

                      </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
-->
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
