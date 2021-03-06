<!DOCTYPE html>
<html lang="en">

<head>


    <?php include "../partials/admin_head.html" ?>
    <?php include "../partials/admin_header.php" ?>
    <?php


    require "../../config/database.php";

    $id = $_GET["id"];


function GetID(){

      $id = $_GET["id"];
      return $id;
}


function FetchUserData($id){
    include "../../config/database.php";




  $sql = "SELECT P.profile_id,P.profile_firstname, P.profile_lastname, P.profile_address, P.profile_birthdate, P.profile_nationality, P.profile_contact, A.user_email, A.user_password , A.user_type, A.user_status FROM hrms_user_profile P INNER JOIN hrms_user_account A ON P.profile_id=A.user_id WHERE P.profile_id=" . $id;
    if ($rs = $conn->query($sql)) {
        if ($rs->num_rows > 0) {
            $profile_data = $rs->fetch_assoc();
        /*    $firstname = $profile_data['profile_firstname'];
            $lastname = $profile_data['profile_lastname'];
            $address = $profile_data['profile_address'];
            $birthdate = $profile_data['profile_birthdate'];
            $nationality = $profile_data['profile_nationality'];
            $contact = $profile_data['profile_contact'];
            $email = $profile_data['user_email']; */
        } else {
            echo 'No user found!';
        }
    } else {
        echo $conn->error;  // display error for selecting data into database
    }



      return $profile_data;
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
                        <h2>EDIT USER</h2>
                    </div>
                      <?php if (isset($_GET['id'])): $profile_data=FetchUserData($_GET['id'])?>
                    <form action="../../config/update_user.php?id=<?php echo $profile_data['profile_id'] ?>" method="post">
                        <div class="input-box">
                            <h5>USER ID:</h5>
                            <label><?php echo GetID() ?></label>
                        </div>
                        <div class="user-details">


                          <div class="input-box">
                                <span class="form-details">First Name: </span>
                                <input type="text" name="profile_firstname" value="<?php echo $profile_data['profile_firstname'] ?>" maxlength="50" required="true">
                          </div>

                            <div class="input-box">
                                <span class="form-details">Last Name: </span>
                                <input type="text" name="profile_lastname" value="<?php echo $profile_data['profile_lastname'] ?>" maxlength="50" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Password: </span>
                                <input type="password" name="profile_password" value="<?php echo $profile_data['user_password'] ?>" maxlength="20" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Verify Password: </span>
                                <input type="password" name="profile_verifypassword" value="Verify Password" maxlength="20" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Email: </span>
                                <input type="text" name="profile_email" value="<?php echo $profile_data['user_email'] ?>" maxlength="50" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Address: </span>
                                <input type="text" name="profile_address" value="<?php echo $profile_data['profile_address'] ?>" maxlength="100" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Birthdate: </span>
                                <input type="date" name="profile_birthdate" value="<?php echo $profile_data['profile_birthdate'] ?>"required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Nationality: </span>
                                <input type="text" name="profile_nationality" value="<?php echo $profile_data['profile_nationality'] ?>" maxlength="20" required>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Contact No.: </span>
                                <input type="text" name="profile_contact" value="<?php echo $profile_data['profile_contact'] ?>" maxlength="15" required>
                            </div>



                            <div class="input-box">
                                <span class="form-details">Role: </span>
                                <select name="CreateUserRole" class="form-control" >
                                    <option value="Admin" <?php if ($profile_data['user_type']==1) echo "selected"; ?> >Admin</option>
                                    <option value="Receptionist" <?php if ($profile_data['user_type']==2) echo "selected";?>>Receptionist</option>
                                </select>
                            </div>
                            <div class="input-box">
                                <span class="form-details">Status: </span>
                                <select name="CreateUserStatus" class="form-control" style="width: 90px;">
                                    <option value="Active" <?php if ($profile_data['user_status']==1) echo "selected"; ?>>Active</option>
                                    <option value="Inactive" <?php if ($profile_data['user_status']==2) echo "selected"; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>


                        <div class="add-button">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Confirm?')">Confirm</button>

                            <a class="btn btn-danger" href="user_page.php">Cancel</a>
                        </div>
                      </form>
                        <?php endif; ?>

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
