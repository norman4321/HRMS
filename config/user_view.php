
<?php
function UserList(){
    include "../../config/database.php";

    $sql = "SELECT * FROM hrms_user_profile";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['profile_id'] . "</td>";
    echo "<td>" . $row['profile_firstname'] . "</td>";
    echo "<td>" . $row['profile_lastname'] . "</td>";
    echo "<td>" . "Admin" . "</td>";
    echo "<td>". "<span class='status Active'>Active</span>" . "</td>";
    echo "<td>". "<button class='btn btn-success'><a href='edit_user.php?id=$row[profile_id]' class='text-light'>Edit</a></button>" ."</td>";
    echo "</tr>";
    }

  }
  ?>
