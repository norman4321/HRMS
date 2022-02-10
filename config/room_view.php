
<?php
function RoomList(){
    include "../../config/database.php";

    $sql = "SELECT * FROM HRMS_room INNER JOIN HRMS_room_type ON room_type=type_id  INNER JOIN HRMS_room_status ON room_status=status_id ORDER BY room_number";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['room_number'] . "</td>";

    echo "<td>" . $row['type_name'] . "</td>";
    echo "<td>" ."<span class='status $row[status_description]'>". $row['status_description']."</span>"."</td>";



    echo "<td>". "<button class='btn btn-success'><a href='edit_room.php?id=$row[room_id]' class='text-light'>Edit</a></button>" ;
    //echo "<button class='btn btn-danger'><a href='#' class='text-light' onclick='return confirm(Are you sure to delete this room?')';>Delete</a></button>";
    echo "</td>";
    echo "</tr>";
    }

  }
  ?>
  <!--
    <tr>
        <td>1</td>
        <td>Deluxe Type</td>
        <td><span class="status Booked">Booked</span></td>
        <td>
            <button class="btn btn-success"><a href="edit_room.php" class="text-light">Edit</a></button>
            <button class="btn btn-danger"><a href="#" class="text-light">Delete</a></button>
        </td>
    </tr>
    <tr>
        <td>1</td>
        <td>@mdo</td>
        <td><span class="status Maintenance">Maintenance</span></td>
        <td>
            <button class="btn btn-success"><a href="edit_room.php" class="text-light">Edit</a></button>
            <button class="btn btn-danger"><a href="#" class="text-light">Delete</a></button>
        </td>
    </tr>
    -->
