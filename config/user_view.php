
<?php
function UserList(){
    include "../../config/database.php";

    $sql = "SELECT profile_id,profile_firstname,profile_lastname,role_description,status_description FROM hrms_user_profile INNER JOIN hrms_user_account ON user_id=profile_id INNER JOIN hrms_user_type ON user_type=role_id INNER JOIN hrms_user_status ON user_status=status_id";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['profile_id'] . "</td>";
    echo "<td>" . $row['profile_firstname'] . "</td>";
    echo "<td>" . $row['profile_lastname'] . "</td>";
    echo "<td>" . $row['role_description'] . "</td>";
    echo "<td>" ."<span class='status $row[status_description]'>". $row['status_description']."</span>"."</td>";
    echo "<td>". "<button class='btn btn-success'><a href='edit_user.php?id=$row[profile_id]' class='text-light'>Edit</a></button>" ."</td>";
    echo "</tr>";
    }

  }
  ?>
