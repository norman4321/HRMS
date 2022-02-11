<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../partials/admin_head.html" ?>
<?php include "../partials/admin_header.php" ?>


</head>

<body>
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
            <div class="details">
                <div class="add-room">
                    <div class="card-header">
                        <h2>ADD A ROOM</h2>
                    </div>
                    <form action="#">

                        <div class="add-details">

                            <div class="input-box">
                                <span class="form-details">Room Number: </span>
                                <input type="text" name="room_name" placeholder="Room Number" maxlength="50" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Room Type: </span>
                                <select id="CreateRoomType" class="form-control">
                                    <option value="Cozy Room">Cozy Room</option>
                                    <option value="Cozy Junior Suite">Cozy Junior Suite</option>
                                    <option value="Cozy Executive Room">Cozy Executive Room</option>
                                    <option value="Cozy Fort Suite">Cozy Fort Suite</option>
                                    <option value="Cozy Commerce Suite">Cozy Commerce Suite</option>
                                    <option value="Cozy Home Suite">Cozy Home Suite</option>
                                </select>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Status: </span>
                                <select id="CreateRoom" class="form-control">
                                    <option value="Available">Available</option>
                                    <option value="Occupied">Occupied</option>
                                    <option value="Booked">Booked</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                    </form>
                    <div class="add-button">
                        <button class="btn btn-primary">Confirm</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
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
