<!DOCTYPE html>
<html lang="en">

<head>
    <!--Created on 12/10/2021-->
    <?php include "./partials/head.html" ?>
</head>

<body id="profile-page">
    <!-----header----->
    <?php include "./partials/header.php" ?>

    <!-- PHP -->
    <?php include "../config/database.php" ;

        // Check if user is not logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: signin_page.php');
        }

        $firstname = '';
        $lastname = '';
        $address = '';
        $birthdate = '';
        $nationality = '';
        $contact = '';
        $email = '';
        $error_message = '';
        $success_message = '';
        $oldpassword = '';
        $newpassword = '';
        $repassword = '';

        // When Submitting Form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            #var_dump($_POST);
            $isnew = trim($_POST['email']) != $email;
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $address = trim($_POST['address']);
            $birthdate = $_POST['birthdate'];
            $nationality = trim($_POST['nationality']);
            $contact = trim($_POST['contact']);
            $email = trim($_POST['email']);
            $oldpassword = $_POST['oldpassword'];
            $newpassword = $_POST['newpassword'];
            $repassword = $_POST['repassword'];
            
            // Validate if new & re-type passwords are matched
            if ($newpassword == $repassword) {

                // Get email and password on database
                $sql = "SELECT user_email, user_password FROM HRMS_user_account WHERE user_id=".$_SESSION['user_id'];
                if ($rs=$conn->query($sql)) {
                    if ($rs->num_rows>0) {
                        $data=$rs->fetch_assoc();

                        // Check if old password is valid (plain,hash)
                        if (password_verify($oldpassword,$data['user_password'])) {
                            $hashed = password_hash($newpassword, PASSWORD_DEFAULT); // encrypt new password
                            
                            // Check if email is changed
                            if ($email != $data['user_email']) {

                                // Check if email already exists
                                $sql = "SELECT user_email FROM HRMS_user_account WHERE user_email='$email' LIMIT 1";
                                if ($rs=$conn->query($sql)) {
                                    if ($rs->num_rows<1) {
                                                                                
                                        // Update data in user_profile & user_account tables with email
                                        $sql = "UPDATE HRMS_user_profile P JOIN HRMS_user_account A ON P.profile_id=A.user_id SET P.profile_firstname='$firstname', P.profile_lastname='$lastname', P.profile_address='$address', P.profile_birthdate='$birthdate', P.profile_nationality='$nationality', P.profile_contact='$contact', P.profile_email='$email', A.user_email='$email', A.user_password='$hashed' WHERE P.profile_id=".$_SESSION['user_id'];
                                        $success_message = executeQuery($conn,$sql);

                                    } else {
                                        $error_message = 'This email already exists. Please use another one.'; // Error Message
                                    }
                                } else {
                                    echo $conn->error;  // display error for getting matched emails from user_account table
                                }
                            } else {

                                // Update data in user_profile & user_account tables without email
                                $sql = "UPDATE HRMS_user_profile P JOIN HRMS_user_account A ON P.profile_id=A.user_id SET P.profile_firstname='$firstname', P.profile_lastname='$lastname', P.profile_address='$address', P.profile_birthdate='$birthdate', P.profile_nationality='$nationality', P.profile_contact='$contact', A.user_password='$hashed' WHERE P.profile_id=".$_SESSION['user_id'];
                                executeQuery($conn,$sql);
                            }
                            
                            

                        } else {
                            $error_message = 'Incorrect old password'; // Error Message
                        }
                    } else {
                        echo 'No record found!';
                    }
                } else {
                    echo $conn->error;  // display error for getting user_password from user_account table
                }
            } else {
                $error_message = 'New and Re-type Passwords do not match.'; // Error Message
            }            
        }

        // Display User Profile
        $sql = "SELECT P.profile_id, P.profile_firstname, P.profile_lastname, P.profile_address, P.profile_birthdate, P.profile_nationality, P.profile_contact, A.user_email, A.user_password FROM HRMS_user_profile P INNER JOIN HRMS_user_account A ON P.profile_id=A.user_id WHERE P.profile_id=".$_SESSION['user_id'];
        if ($rs=$conn->query($sql)) {
            if ($rs->num_rows>0) { 
                $profile_data=$rs->fetch_assoc();
                $firstname = $profile_data['profile_firstname'];
                $lastname = $profile_data['profile_lastname'];
                $address = $profile_data['profile_address'];
                $birthdate = $profile_data['profile_birthdate'];
                $nationality = $profile_data['profile_nationality'];
                $contact = $profile_data['profile_contact'];
                $email = $profile_data['user_email'];
                $password = $profile_data['user_password'];
                $oldpassword = '';
                $newpassword = '';
                $repassword = '';
            } else {
                echo 'No user found!';
            }
        } else {
            echo $conn->error;  // display error for selecting data into database
        }

        // Function for query execution
        function executeQuery($conn, $sql) {
            if ($conn->query($sql)) { 
                return 'Your profile is updated';
            } else {
                echo $conn->error;  // display error for updating data into database
                return '';
            }
        }
    ?>

    <!-----landing----->
    <section class="account">
        <div class="container-fluid py-2 px-5" id="account-header">
            <h1 class="ml-3 ">Account</h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card ml-5" style="border-radius: 10px; width: 60rem;">
                        <div class="card-body py-4 p-md-4">
                            <form class="account-form" action="" method="POST">

                                <!---- error/success message - start ---->
                                <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger alert-dismissible mb-3">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error! </strong> <?php echo $error_message; ?>
                                </div>
                                <?php elseif (!empty($sucess_message)): ?>
                                    <div class="alert alert-success alert-dismissible mb-3">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Success! </strong> <?php echo $success_message; ?>
                                    </div>
                                <?php endif; ?>
                                <!---- error/success message - end ---->

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="firstname">First Name</label>
                                            <input type="text" name="firstname" class="form-control form-control-md" placeholder="e.g. Juan" maxlength="50" required readonly value="<?php echo $firstname ?>" />

                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="lastname">Last Name</label>
                                            <input type="text" name="lastname" class="form-control form-control-md" placeholder="e.g Dela Cruz" maxlength="50" required readonly value="<?php echo $lastname ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="address">Address</label>
                                            <input type="address" name="address" class="form-control form-control-md" placeholder="e.g. Lot 1 Blk 2, Brgy. 33, Manila City" maxlength="100" required readonly value="<?php echo $address ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="birthdate">Birthdate</label>
                                            <input type="Date" name="birthdate" class="form-control form-control-md" required readonly value="<?php echo $birthdate ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="nationality">Nationality</label>
                                            <input type="text" name="nationality" class="form-control form-control-md" placeholder="e.g. Filipino" maxlength="20" required readonly value="<?php echo $nationality ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="contact">Contact Number</label>
                                            <input type="tel" name="contact" class="form-control form-control-md" placeholder="e.g. 09053922400" minlength="8" maxlength="15" pattern="^[+]?[\d]+([\-][\d]+)*\d$" required readonly value="<?php echo $contact ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control form-control-md" maxlength="320" placeholder="e.g. juandelacruz@gmail.com" required readonly value="<?php echo $email ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="oldpassword">Password</label>
                                            <input type="password" name="oldpassword" id="oldpassword" class="form-control form-control-md" maxlength="60" placeholder="****************" required readonly value="<?php echo $oldpassword ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="div-password" style="display:none;">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="newpassword">New Password</label>
                                                <input type="password" name="newpassword" id="newpassword" class="form-control form-control-md" maxlength="60" value="<?php echo $newpassword ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="repassword">Re-type New Password</label>
                                                <input type="password" name="repassword" id="repassword" class="form-control form-control-md" maxlength="60" value="<?php echo $repassword ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button class="btn btn-md mt-4" id="primary-btn"></i>EDIT DETAILS</button>

                                <button class="btn btn-md mt-4 btn-cancel hidden" id="secondary-btn">CANCEL</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php include "./partials/footer.html" ?>

    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#primary-btn').click(function(e) {
                if (e.target.innerHTML=="EDIT DETAILS") {
                    e.preventDefault();
                    $("input").removeAttr("readonly");
                    $('button').css('display', 'block');
                    $(this).text("SUMBIT");
                    $("#primary-btn").attr("type", "submit");
                    $("#oldpassword").removeAttr("placeholder");
                    $(".div-password").css('display', 'block');
                    $("#oldpassword").removeAttr("placeholder");
                }                
            });
        });

        $(document).ready(function() {
            $('#secondary-btn').click(function(e) {
                e.preventDefault();
                $("input").attr("readonly", true);
                $(this).css('display', 'none');
                $('#primary-btn').text("EDIT DETAILS");
                $(".div-password").css('display', 'none');
                $("#oldpassword").attr("placeholder", "****************");
            });
        });
    </script>
</body>

</html>