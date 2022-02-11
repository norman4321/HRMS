<!DOCTYPE html>
<html lang="en">


<head>
    <?php include "../partials/admin_head.html";

    function RoomList(){
        include "../../config/database.php";

      if (isset($_GET['date'])){

        $date = $_POST['room_date'];
        $sql = "SELECT * FROM HRMS_room INNER JOIN HRMS_room_type ON room_type=type_id  INNER JOIN HRMS_room_status ON room_status=status_id ORDER BY room_number";
        echo "sorting " . $date;
      }
      else
        $sql = "SELECT * FROM HRMS_room INNER JOIN HRMS_room_type ON room_type=type_id  INNER JOIN HRMS_room_status ON room_status=status_id ORDER BY room_number";




        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_array($result))
        {
        echo "<tr>";
        echo "<td>" . $row['room_number'] . "</td>";

        echo "<td>" . $row['type_name'] . "</td>";
        echo "<td>" ."<span class='status $row[status_description]'>". $row['status_description']."</span>"."</td>";



        echo "<td>". "<button class='btn btn-success'><a href='edit_room.php?id=$row[room_id]' class='text-light'>Edit</a></button>" ;
        //echo "<button class='btn btn-danger'><a href='#' class='text-light' onclick='return confirm(Are you sure to delete this room?')';>Delete</a></button>";
        echo "</td>";
        echo "</tr>";
        }

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
            <!-- <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="grid-outline"></ion-icon>
                    </div>
                </div> -->

            <!--Room Management-->

            <div class="details">
                <div class="room-manage">
                    <div class="card-header">
                        <div class="head">
                            <h2>Room Management</h2>
                            <!--
                              <form method="POST" action="?date=1">
                                <input type="date" id="RoomDate" name="room_date" required>
                              <button class="btn btn-primary">Sort</button>
                            </form>-->
                        </div>
                        <a href="add_room.php"><button class="btn btn-primary">Add Room</button></a>
                    </div>
                    <table id="roomPage" class="table">
                        <thead align="center">
                            <tr>
                                <th scope="col">Room No.</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody align="center">

                          <?php


                                RoomList();
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
