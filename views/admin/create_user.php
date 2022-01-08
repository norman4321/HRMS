<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/admin-head.html";



function LastId(){
    include "../../config/database.php";
    $query = "SELECT profile_id FROM hrms_user_profile ORDER BY profile_id DESC LIMIT 1 ";

    if ($result = mysqli_query($conn, $query)) {
      $data=mysqli_fetch_array($result);
      echo $data[0]+1;

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
                <li class="active">
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
                <div class="create-user">
                    <div class="card-header">
                        <h2>CREATE USER</h2>
                    </div>
                    <form action="../../config/add_user.php" method="post">
                        <div class="input-box">
                            <h5>USER ID:</h5>
                            <label><?php echo LastId() ?></label>
                        </div>
                        <div class="user-details">
                            <div class="input-box">
                                <span class="form-details">First Name: </span>
                                <input type="text" name="profile_firstname" placeholder="First Name" maxlength="50" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Last Name: </span>
                                <input type="text" name="profile_lastname" placeholder="Last Name" maxlength="50" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Password: </span>
                                <input type="password" name="profile_password" placeholder="Password" maxlength="20" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Verify Password: </span>
                                <input type="password" name="profile_verifypassword" placeholder="Verify Password" maxlength="20" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Email: </span>
                                <input type="text" name="profile_email" placeholder="Email" maxlength="50" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Address: </span>
                                <input type="text" name="profile_address" placeholder="Address" maxlength="100" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Birthdate: </span>
                                <input type="date" name="profile_birthdate" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Nationality: </span>
                                <input type="text" name="profile_nationality" placeholder="Nationality" maxlength="20" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Contact No.: </span>
                                <input type="text" name="profile_contact" placeholder="Contact No." maxlength="15" required>
                            </div>

                            <div class="input-box">
                                <span class="form-details">Role: </span>
                                <select id="CreateUserRole" class="form-control">
                                    <option value="Admin">Admin</option>
                                    <option value="Receptionist">Receptionist</option>
                                </select>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Status: </span>
                                <select id="CreateUserStatus" class="form-control" style="width: 90px;">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="add-button">
                            <button type= submit class="btn btn-primary">Confirm</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>



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
