<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/admin-head.html" ?>


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
                        <h2>ADD ROOM TYPE</h2>
                    </div>
                  <form action="../../config/insert_room_type.php" method="post" enctype="multipart/form-data">
                        <div class="add-room-type-details">
                            <div class="input-box">
                                <span class="form-details">Room Name: </span>
                                <input type="text" name="room_type_name" placeholder="Room Name" maxlength="50" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Capacity: </span>
                                <input type="text" name="room_capacity" placeholder="Capacity" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Price (per night): </span>
                                <input type="text" name="room_price" placeholder="Price" required>
                            </div>
                            <div class="input-box-area">
                                <span class="form-details">Description: </span>
                                <textarea class="description" name="room_description" placeholder="Description" required maxlength="500"></textarea>
                            </div>

                        </div>
                        <div class="add-predetails">
                            <div class="input-box">
                                <div id="img-preview"><img src="../../public/images/upload-logo.png" onclick="triggerClick()" id="roomDisplay"></div>
                                <input type="file" accept="image/*" id="roomImage" name="room_image" onchange="displayImage(this)" required>
                            </div>

                        </div>


                    <div class="add-button">
                        <button class="btn btn-primary" type="submit">Confirm</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                      </form>
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
