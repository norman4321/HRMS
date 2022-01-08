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
            <!-- <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="grid-outline"></ion-icon>
                    </div>
                </div> -->

            <!--Room Management-->
            <div class="details">
                <div class="room-manage">
                    <div class="card-header">
                        <h2>Room Management</h2>
                        <a href="add_room.php"><button class="btn btn-primary">Add Room</button></a>
                    </div>
                    <table id="roomPage" class="table">
                        <thead align="center">
                            <tr>
                                <th scope="col">Room No.</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Description</th>
                                <th scope="col">Size</th>
                                <th scope="col">Amenities</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="../../public/images/room_sample.jpg" width="200px" height="120px">
                                </td>
                                <td>Hospisyo</td>
                                <td>Deluxe Type</td>
                                <td>12pax</td>
                                <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</td>
                                <td>24sqm</td>
                                <td>Toiletries, Free WIFI, Entertainment, Jacuzzi</td>
                                <td>PHP 11,000</td>
                                <td>Booked</td>
                                <td>
                                    <button class="btn btn-success"><a href="edit_room.php" class="text-light">Edit</a></button>
                                    <button class="btn btn-danger"><a href="#" class="text-light">Delete</a></button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="../../public/images/room_sample.jpg">
                                </td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Occupied</td>
                                <td>
                                    <button class="btn btn-success"><a href="edit_room.php" class="text-light">Edit</a></button>
                                    <button class="btn btn-danger"><a href="#" class="text-light">Delete</a></button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="../../public/images/room_sample.jpg" width="200px" height="120px">
                                </td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Otto</td>
                                <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Booked</td>
                                <td>
                                    <button class="btn btn-success"><a href="edit_room.php" class="text-light">Edit</a></button>
                                    <button class="btn btn-danger"><a href="#" class="text-light">Delete</a></button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</t>
                                <td>
                                    <img src="../../public/images/room_sample.jpg" width="200px" height="120px">
                                </td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Otto</td>
                                <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>Vacant</td>
                                <td>
                                    <button class="btn btn-success"><a href="edit_room.php" class="text-light">Edit</a></button>
                                    <button class="btn btn-danger"><a href="#" class="text-light">Delete</a></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>

    </div>





    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>