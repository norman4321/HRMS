<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../partials/admin_head.html" ?>
<?php include "../partials/admin_header.php" ?>


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
                <li class="active">
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
                <div class="report-manage">
                    <div class="card-header">
                        <h2>Report Details</h2>
                        <div class="card-header-sort">
                            <span class="sortText">Sort:</span>
                            <select class="form-sort">
                                <option value="" disabled selected>Choose Here</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Pending">Pending</option>
                                <option value="Checked-In">Checked-In</option>
                                <option value="Checked-Out">Checked-Out</option>
                            </select>
                            <input type="date" placeholder="Check In Date"></input>
                            <input type="date" placeholder="Check Out Date"></input>
                            <span class="sortText">Search:</span>
                            <input type="text" placeholder="Search Here"></input>
                        </div>
                    </div>
                    <table id="ReportPage" class="table">
                        <thead align="center">
                            <tr>
                                <th scope="col">Guest Name</th>
                                <th scope="col">Room Number</th>
                                <th scope="col">Price</th>
                                <th scope="col">Arrival Date/Time</th>
                                <th scope="col">Departure Date/Time</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody align="center">

                          <?php include "../../config/report_view.php";
                            ReportList();
                          ?>



                    <div class="card-btn">
                        <button class="gen-btn btn-primary">Generate Print</button>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>

    </script>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
