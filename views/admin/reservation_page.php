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
                <li>
                    <a href="room_type_page.php">
                        <span class="icon">
                            <ion-icon name="options-outline"></ion-icon>
                        </span>
                        <span class="title">Room Type</span>
                    </a>
                </li>
                <li class="active">
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

        <!-- Admin Screen -->
        <div class="admin-main">
            <!--Room Management-->
            <div class="details">
                <div class="reservation-manage">
                    <div class="card-header">
                        <h2>Reservation Details</h2>
                    </div>
                    <table id="reservationPage" class="table">
                        <thead align="center">
                            <tr>
                                <th scope="col">Reservation No.</th>
                                <th scope="col">Guest Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Confirmation Code</th>
                                <th scope="col">Total Rooms</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody align="center">

                            <tr>
                              <?php include "../../config/reservation_view.php";
                                ReservationList();
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
    <!--VIEW MODAL-->
    <div class="modal fade" id="ReserveViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ViewModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ViewModal">Booked Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="reservationPage" class="table">
                        <thead align="center">
                            <tr>
                                <th scope="col">Room No.</th>
                                <th scope="col">Room Name</th>
                                <th scope="col">Room Image</th>
                                <th scope="col">Arrival Date&Time</th>
                                <th scope="col">Departure Date&Time</th>
                                <th scope="col">Price/Rate</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--EDIT MODAL-->
    <div class="modal fade" id="ReserveEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModal" >Booked Details</h5>
                    <select class="reserveStatus">
                        <option value="Confirmed">Confirmed</option>
                        <option value="Pending">Pending</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Check-In">Check-In</option>
                        <option value="Check-Out">Check-Out</option>
                    </select>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="reservationPage" class="table">
                        <thead align="center">
                            <tr>
                                <th scope="col">Room No.</th>
                                <th scope="col">Room Name</th>
                                <th scope="col">Room Image</th>
                                <th scope="col">Arrival Date&Time</th>
                                <th scope="col">Departure Date&Time</th>
                                <th scope="col">Price/Rate</th>
                                <th scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                                <td>
                                    <button class="reserve-btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                                <td>
                                    <button class="reserve-btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                                <td>
                                    <button class="reserve-btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                                <td>
                                    <button class="reserve-btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                                <td>
                                    <button class="reserve-btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                                <td>
                                    <button class="reserve-btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td><img src="../../public/images/room_sample.jpg"></td>
                                <td>02/25/25 11:00:00</td>
                                <td>02/25/25 11:00:00</td>
                                <td>PHP 11,000</td>
                                <td>
                                    <button class="reserve-btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
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
