<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../partials/admin_head.html" ?>
<?php include "../partials/admin_header.php" ?>
    <?php
    require "../../config/database.php";

    function GetID(){

          $id = $_GET["id"];
          return $id;
    }


    function FetchRoomTypeData($id){
        include "../../config/database.php";




      $sql = "SELECT type_id, type_name, room_description, room_capacity, room_price, room_image FROM hrms_room_type WHERE type_id =" . $id;
        if ($rs = $conn->query($sql)) {
            if ($rs->num_rows > 0) {
                $room_type_data = $rs->fetch_assoc();

            } else {
                echo 'No room found!';
            }
        } else {
            echo $conn->error;  // display error for selecting data into database
        }



          return $room_type_data;
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
                <li>
                    <a href="room_page.php">
                        <span class="icon">
                            <ion-icon name="bed-outline"></ion-icon>
                        </span>
                        <span class="title">Rooms </span>
                    </a>
                </li>
                <li class="active">
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
            <div class="details">
                <div class="add-room-type">
                    <div class="card-header">
                        <h2>EDIT ROOM TYPE</h2>
                    </div>
                      <?php if (isset($_GET['id'])): $room_type_data=FetchRoomTypeData($_GET['id'])?>
                    <form action="../../config/update_room_type.php" method="post" enctype="multipart/form-data">
                        <div class="add-room-type-details">

                            <div class="input-box">
                                <span class="form-details">Room Name: </span>
                                <input type="text" name="room_type_name" value="<?php echo $room_type_data['type_name'] ?>" maxlength="50" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Capacity: </span>
                                <input type="text" name="room_capacity" value="<?php echo $room_type_data['room_capacity'] ?>" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Price (per night): </span>
                                <input type="text" name="room_price" value="<?php echo $room_type_data['room_price'] ?>" required>
                            </div>
                            <div class="input-box-area">
                                <span class="form-details">Description: </span>
                                <textarea class="description" name="room_description" <?php echo $room_type_data['room_description'] ?> required maxlength="500"><?php echo $room_type_data['room_description'] ?></textarea>
                            </div>
                        </div>
                        <div class="add-predetails">
                            <div class="input-box">
                                <div id="img-preview"><img src="../../public/images/upload-logo.png" onclick="triggerClick()" id="roomDisplay"></div>
                                <input type="file" accept="image/*" id="roomImage" name="room_image" onchange="displayImage(this)" >
                            </div>
                        </div>
                        <div class="add-button">
                            <button class="btn btn-primary">Confirm</button>
                            <a class="btn btn-danger" href="room_type_page">Cancel</a>
                        </div>
                    </form>

                      <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
    <script>
        function triggerClick(e) {
            document.querySelector('#roomImage').click();
        }

        function displayImage(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#roomDisplay').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>




    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
