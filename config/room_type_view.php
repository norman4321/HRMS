
<?php
function RoomTypeList(){
    include "../../config/database.php";

    $sql = "SELECT * FROM HRMS_room_type";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['type_id'] . "</td>";

    echo "<td>";
    echo "<img src="."../". $row['room_image']." width='200px' height='120px'>";
    echo "</td>";

    echo "<td>". $row['type_name'] ."</td> ";
    echo "<td>". $row['room_capacity'] ."</td> ";
    echo "<td>". $row['room_description'] ."</td> ";
    echo "<td>". $row['room_price'] ."</td> ";

    echo "<td>". "<button class='btn btn-success'><a href='edit_room_type.php?id=$row[type_id]' class='text-light'>Edit</a></button>" ;

    echo "</td>";
    echo "</tr>";
    }

  }
  ?>

  <!--

      <td>12pax</td>
      <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</td>
      <td>₱11,000.00</td>
      <td>
          <button class="btn btn-success"><a href="edit_room_type.php" class="text-light">Edit</a></button>
          <button class="btn btn-danger"><a href="#" class="text-light">Delete</a></button>
      </td>
  </tr>
  <tr>
      <td>1</td>
      <td>
          <img src="../../public/images/cozy_room.jpg" width="200px" height="120px">
      </td>
      <td>Cozy Room</td>
      <td>12pax</td>
      <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</td>
      <td>₱11,000.00</td>
      <td>
          <button class="btn btn-success"><a href="edit_room_type.php" class="text-light">Edit</a></button>
          <button class="btn btn-danger"><a href="#" class="text-light">Delete</a></button>
      </td>
  </tr>

</tbody>
!-->
