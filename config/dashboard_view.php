<?php
function DashboardList(){
    include "../../config/database.php";

    $sql = "SELECT * FROM HRMS_room INNER JOIN HRMS_room_type ON room_type=type_id  INNER JOIN HRMS_room_status ON room_status=status_id ORDER BY room_number";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['room_number'] . "</td>";
    echo "<td>" . $row['type_name'] . "</td>";
    echo "<td>" ."<span class='status $row[status_description]'>". $row['status_description']."</span>"."</td>";

    echo "</tr>";
    }

  }
  ?>
<!--
  <tr>
      <td>1</td>
      <td>Sun and Moon</td>
      <td>2nd Class</td>
      <td><span class="status Vacant">Vacant</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Stars</td>
      <td>3rd Class</td>
      <td><span class="status Vacant">Vacant</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Stars</td>
      <td>3rd Class</td>
      <td><span class="status Occupied">Occupied</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Sun and Moon</td>
      <td>2nd Class</td>
      <td><span class="status Occupied">Occupied</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Earth</td>
      <td>1st Class</td>
      <td><span class="status Booked">Booked</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Earth</td>
      <td>1st Class</td>
      <td><span class="status Booked">Booked</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Earth</td>
      <td>1st Class</td>
      <td><span class="status Booked">Booked</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Earth</td>
      <td>1st Class</td>
      <td><span class="status Booked">Booked</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Earth</td>
      <td>1st Class</td>
      <td><span class="status Booked">Booked</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Earth</td>
      <td>1st Class</td>
      <td><span class="status Booked">Booked</span></td>
  </tr>
  <tr>
      <td>1</td>
      <td>Earth</td>
      <td>1st Class</td>
      <td><span class="status Booked">Booked</span></td>
  </tr>


-->
