<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../partials/admin_head.html" ?>
<?php include "../partials/admin_header.php" ?>
    <?php 


function DashboardData($id){
    include "../../config/database.php";


  $sql = "SELECT COUNT(1) AS total FROM HRMS_room WHERE room_status =" . $id;
  $result=mysqli_query($conn,$sql);
  $data=mysqli_fetch_assoc($result);
  echo $data['total'];
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
                <li class="active">
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
                    <a href="../logout.php">
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


            <!--Vacant (1), Occupied(4) and Booked (3)Cards-->
            <div class="card-box">
                <div class="card">
                    <div>
                        <div class="card-numbers"><?php echo DashboardData(1)?></div>
                        <div class="card-name">Vacants</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="bed-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="card-numbers"><?php echo DashboardData(4)?></div>
                        <div class="card-name">Occupied</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="checkmark-circle-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="card-numbers"><?php echo DashboardData(3)?></div>
                        <div class="card-name">Booked</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="calendar-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!--Recent Room Update details-->
            <div class="details">
                <div class="recent-update">
                    <div class="card-header">
                        <h2>Room Details</h2>
                        <div class="form-group">
                            <select name="state" id="maxRows" class="form-control" style="width: 150px;">
                                <option value="5000">Show All</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>
                    <table id="adminPage">
                        <thead>
                            <tr>
                                <td>Room No.</td>
                                <td>Room Type</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                          <?php include "../../config/dashboard_view.php";
                              DashboardList();
                          ?>

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
