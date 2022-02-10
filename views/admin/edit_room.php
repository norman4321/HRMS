<!DOCTYPE html>
<html lang="en">


<head>
    <?php include "../partials/admin-head.html";

    function FetchRoomData($id){
        include "../../config/database.php";




      $sql = "SELECT room_number,room_type,room_status FROM HRMS_room INNER JOIN HRMS_room_type ON room_type=type_id WHERE room_id=$id";
        if ($rs = $conn->query($sql)) {
            if ($rs->num_rows > 0) {
                $room_data = $rs->fetch_assoc();

            } else {
                echo 'No such room found!';
            }
        } else {
            echo $conn->error;  // display error for selecting data into database
        }



          return $room_data;
      }

  function FetchRoomType($room_type){
    include "../../config/database.php";

    $sql = "SELECT type_id,type_name FROM HRMS_room_type " ;
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result))
      {
        if($room_type==$row['type_id'])
        echo "<option value=$row[type_id] selected>$row[type_name]</option>";
        else
        echo "<option value=$row[type_id]>$row[type_name]</option>";
      }


    }

    function FetchRoomStatus($room_status){
      include "../../config/database.php";

      $sql = "SELECT status_id,status_description FROM HRMS_room_status " ;
      $result = mysqli_query($conn,$sql);

      while($row = mysqli_fetch_array($result))
        {
          if($room_status==$row['status_id'])
          echo "<option value=$row[status_id] selected>$row[status_description]</option>";
          else
          echo "<option value=$row[status_id]>$row[status_description]</option>";
        }


      }

      function Call(){
        echo "hi";
      }

       ?>


</head>



<body>

    <!-- header -->
    <div class="admin-container">
        <div class="admin-navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon-brand"><img src="../../public/images/home_logo2.png" width="60px" height="30px"></span>
                        <span class="title-name"><img src="../../public/images/name_logo2.png" width="180px" height="20px"></span>
                    </a>
                </li>
                <li>
                    <a href="dashboard_page.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="active">
                    <a href="room_page.php">
                        <span class="icon">
                            <ion-icon name="bed-outline"></ion-icon>
                        </span>
                        <span class="title">Rooms </span>
                    </a>
                </li>
                <li>
                    <a href="room_type_page.php">
                        <span class="icon">
                            <ion-icon name="options-outline"></ion-icon>
                        </span>
                        <span class="title">Room Type</span>
                    </a>
                </li>
                <li>
                    <a href="reservation_page.php">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Reservation</span>
                    </a>
                </li>
                <li>
                    <a href="report_page.php">
                        <span class="icon">
                            <ion-icon name="analytics-outline"></ion-icon>
                        </span>
                        <span class="title">Report</span>
                    </a>
                </li>
                <li>
                    <a href="user_page.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>


        <!-- Admin Main Menu -->
        <div class="admin-main">


            <!--Room Management-->
            <?php if (isset($_GET['id'])): $room_data=FetchRoomData($_GET['id'])?>
            <div class="details">
                <div class="add-room">
                    <div class="card-header">
                        <h2>EDIT ROOM</h2>
                    </div>
                    <form method="POST" action="../../config/update_room.php">

                        <div class="add-details">
                            <div class="input-box">
                                <span class="form-details">Room Number: </span>
                                <input type="text" name="room_number" placeholder="Room Number" maxlength="50" required value="<?php echo $room_data['room_number'] ?>">
                            </div>
                            <div class="input-box">
                                <span class="form-details">Room Type: </span>

                                <select name="room_type" class="form-control">
                              <?php  FetchRoomType($room_data['room_type']); ?>
                                </select>

                            </div>
                            <div class="input-box">
                                <span class="form-details">Status: </span>
                                <select name="room_status" class="form-control">
                                    <?php  FetchRoomStatus($room_data['room_status']); ?>
                                </select>
                            </div>
                        </div>

                    <div class="add-button">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Confirm?')">Confirm</button>

                        <button class="btn btn-danger" href="room_page.php">Cancel</button>
                    </div>

                </form>

                </div>
            </div>

        </div>

    </div>
    <?php if (isset($_POST['submit'])) : ?>
   <p>Thank you for subscribing!</p>
<?php endif; ?>
    <?php endif; ?>



    <script>
        // Menu Toggle
        let toggle = document.querySelector('.toggle');
        let admin_navigation = document.querySelector('.admin-navigation');
        let admin_main = document.querySelector('.admin-main');

        toggle.onclick = function() {
            admin_navigation.classList.toggle('active');
            admin_main.classList.toggle('active')
        }

        //hovered effect class in selected menu list item
        let list = document.querySelectorAll('.admin-navigation li');

        function activeLink() {
            list.forEach((item) =>
                item.classList.remove('hovered'));
            this.classList.add('hovered')
        }
        list.forEach((item) =>
            item.addEventListener('mouseover', activeLink))
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
