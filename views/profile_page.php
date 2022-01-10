<!DOCTYPE html>
<html lang="en">

<head>
    <!--Created on 12/10/2021-->
    <?php include "./partials/head.html"; ?>
</head>

<body id="profile-page">
    <!-----header----->
    <?php include "./partials/header.php"; ?>

    <!-- PHP -->
    <?php include "../config/database.php";

    // Check if user is not logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: signin_page.php');
    }

    $error_message = '';
    $success_message = '';
    $form='';

    $firstname = '';
    $lastname = '';
    $address = '';
    $birthdate = '';
    $nationality = '';
    $contact = '';
    $email = '';

    $oldpassword = '';
    $newpassword = '';
    $repassword = '';

    // Display User Profile
    $sql = "SELECT P.profile_firstname, P.profile_lastname, P.profile_address, P.profile_birthdate, P.profile_nationality, P.profile_contact, A.user_email FROM HRMS_user_profile P INNER JOIN HRMS_user_account A ON P.profile_id=A.user_id WHERE P.profile_id=" . $_SESSION['user_id'];
    if ($rs = $conn->query($sql)) {
        if ($rs->num_rows > 0) {
            $profile_data = $rs->fetch_assoc();
            $firstname = $profile_data['profile_firstname'];
            $lastname = $profile_data['profile_lastname'];
            $address = $profile_data['profile_address'];
            $birthdate = $profile_data['profile_birthdate'];
            $nationality = $profile_data['profile_nationality'];
            $contact = $profile_data['profile_contact'];
            $email = $profile_data['user_email'];
        } else {
            echo 'No user found!';
        }
    } else {
        echo $conn->error;  // display error for selecting data into database
    }

    // Function for query execution
    function executeQuery($conn, $sql, $form) {
        if ($conn->query($sql)) {
            return "Your ".$form." is updated.";
        } else {
            echo $conn->error;  // display error for updating data into database
            return '';
        }
    }

    // Check what form is sumbmitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Check if profile information form is set or password form
        if (isset($_POST['save-profile'])) {
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $address = trim($_POST['address']);
            $birthdate = $_POST['birthdate'];
            $nationality = trim($_POST['nationality']);
            $contact = trim($_POST['contact']);
            $email = trim($_POST['email']);

            // Check if email already exists
            $sql = "SELECT user_email FROM HRMS_user_account WHERE user_email='$email' AND user_id!=".$_SESSION['user_id'];
            if ($rs = $conn->query($sql)) {
                if ($rs->num_rows < 1) {

                    // Update data in user_profile & user_account tables
                    $sql = "UPDATE HRMS_user_profile P JOIN HRMS_user_account A ON P.profile_id=A.user_id SET P.profile_firstname='$firstname', P.profile_lastname='$lastname', P.profile_address='$address', P.profile_birthdate='$birthdate', P.profile_nationality='$nationality', P.profile_contact='$contact', P.profile_email='$email', A.user_email='$email' WHERE P.profile_id=".$_SESSION['user_id'];
                    $success_message = executeQuery($conn, $sql, "profile");
                    $_SESSION['form'] = 'profile';
                    $_SESSION['message'] = $success_message;
                    header("Location: profile_page.php");
                    die;

                } else {
                    $error_message = 'This email already exists. Please use another one.'; // Error Message
                    $form = 'profile';
                }
            } else {
                echo $conn->error;  // display error for getting matched emails from user_account table
            }
        } else {

            $oldpassword = $_POST['oldpassword'];
            $newpassword = $_POST['newpassword'];
            $repassword = $_POST['repassword'];

            // Check if new & re-type passwords are matched
            if ($newpassword == $repassword) {
                
                // Get user password on database
                $sql = "SELECT user_password FROM HRMS_user_account WHERE user_id=".$_SESSION['user_id'];
                if ($rs = $conn->query($sql)) {
                    if ($rs->num_rows > 0) {
                        $data = $rs->fetch_assoc();

                        // Check if old password is valid (plain,hash)
                        if (password_verify($oldpassword, $data['user_password'])) {
                            $hashed = password_hash($newpassword, PASSWORD_DEFAULT); // encrypt new password

                            // Check if new & old passwords are not matched
                            if ($newpassword != $oldpassword) {

                                // Update user password in user_account table
                                $sql = "UPDATE HRMS_user_account SET user_password='$hashed' WHERE user_id=".$_SESSION['user_id'];
                                $success_message = executeQuery($conn, $sql, "password");
                                $_SESSION['form'] = 'password';
                                $_SESSION['message'] = $success_message;
                                header("Location: profile_page.php");
                                die;
                            } else {
                                $error_message = 'Your new password must not be your old password .'; // Error Message
                                $form = 'password';
                            }
                        } else {
                            $error_message = 'Incorrect old password'; // Error Message
                            $form = 'password';
                        }
                    } else {
                        echo 'No record found!';
                    }
                } else {
                    echo $conn->error;  // display error for getting user_password from user_account table
                }
            } else {
                $error_message = 'New and Re-type Passwords do not match.'; // Error Message
                $form = 'password';
            }
        }
    
    }
    var_dump($_SESSION);
    ?>

    <section class="account">
        <div class="container-fluid py-2 px-5" id="account-header">
            <h1 class="ml-3 ">Account</h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-9 col-xl-7">
                    <!---personal info---->
                    <div class="card ml-5" style="border-radius: 10px; width: 60rem;">
                        <div class="card-body py-4 p-md-4">

                            <!---- error message ---->
                            <?php if ($form == 'password' && !empty($error_message)): ?>
                                <div class="alert alert-danger alert-dismissible mb-3">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error! </strong> <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>

                            <!---- success message ---->
                            <?php if (isset($_SESSION['form']) && isset($_SESSION['message']) && $_SESSION['form'] == 'profile'): ?>
                                <div class="alert alert-success alert-dismissible mb-3">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success! </strong> <?php echo $_SESSION['message']; ?>
                                </div>
                                <?php unset($_SESSION['form']); unset($_SESSION['message']); ?>
                            <?php endif; ?>
                            
                            <?php if (isset($_GET['edit']) && $_GET['edit'] == 'profile-info') : ?>
                                <!---edit personal info--->
                                <form class="account-form" action="" method="POST">
                                    <h4 class="mb-4">Edit Personal Information</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="firstname">First Name</label>
                                                <input type="text" name="firstname" id="firstname" class="form-control form-control-md" placeholder="e.g. Juan" maxlength="50" required value="<?php echo $firstname ?>" />

                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="lastname">Last Name</label>
                                                <input type="text" name="lastname" class="form-control form-control-md" placeholder="e.g Dela Cruz" maxlength="50" required value="<?php echo $lastname ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="address">Address</label>
                                                <input type="address" name="address" class="form-control form-control-md" placeholder="e.g. Lot 1 Blk 2, Brgy. 33, Manila City" maxlength="100" required value="<?php echo $address ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="birthdate">Birthdate</label>
                                                <input type="Date" name="birthdate" class="form-control form-control-md" required value="<?php echo $birthdate ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="nationality">Nationality</label>
                                                <input type="text" name="nationality" class="form-control form-control-md" placeholder="e.g. Filipino" maxlength="20" required value="<?php echo $nationality ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="contact">Contact Number</label>
                                                <input type="tel" name="contact" class="form-control form-control-md" placeholder="e.g. 09053922400" minlength="8" maxlength="15" pattern="^[+]?[\d]+([\-][\d]+)*\d$" required value="<?php echo $contact ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control form-control-md" maxlength="320" placeholder="e.g. juandelacruz@gmail.com" required value="<?php echo $email ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-md mt-4" name="save-profile" type="submit"></i>SAVE</button>
                                    <!--<a class="btn btn-md mt-4 btn-cancel" href="profile_page.php">CANCEL</a>-->
                                    <button class="btn btn-md mt-4 btn-cancel" type="button" onclick="location.href='profile_page.php'">CANCEL</button>
                                </form>
                            <?php else : ?>
                                <!---display personal info---->
                                <table class="table table-borderless">
                                    <thead>
                                        <th>
                                            <h4>Personal Information</h4>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr class="border-bottom">
                                            <td class="font-weight-bold" style="width: 30%;">First Name</td>
                                            <td class="text-muted"><?php echo $profile_data['profile_firstname'] ?></td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="font-weight-bold" style="width: 30%;">Last Name</td>
                                            <td class="text-muted"><?php echo $profile_data['profile_lastname'] ?></td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="font-weight-bold">Address</td>
                                            <td class="text-muted"><?php echo $profile_data['profile_address'] ?></td>
                                        </tr>

                                        <tr class="border-bottom">
                                            <td class="font-weight-bold">Birthdate</td>
                                            <td class="text-muted"><?php echo $profile_data['profile_birthdate'] ?></td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="font-weight-bold">Nationality</td>
                                            <td class="text-muted"><?php echo $profile_data['profile_nationality'] ?></td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="font-weight-bold">Contact Number</td>
                                            <td class="text-muted"><?php echo $profile_data['profile_contact'] ?></td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="font-weight-bold">Email</td>
                                            <td class="text-muted"><?php echo $profile_data['user_email'] ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pb-0"> <button class="btn btn-md mt-3 primary-btn" type="button" onclick="location.href='profile_page.php?edit=profile-info'">EDIT DETAILS</button> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!---password--->
                    <div class="card ml-5 mt-3" style="border-radius: 10px; width: 60rem; margin-bottom:200px">
                        <div class="card-body py-4 p-md-4">

                            <!---- error message ---->
                            <?php if ($form == 'password' && !empty($error_message)): ?>
                                <div class="alert alert-danger alert-dismissible mb-3">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error! </strong> <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>

                            <!---- success message ---->
                            <?php if (isset($_SESSION['form']) && isset($_SESSION['message']) && $_SESSION['form'] == 'password'): ?>
                                <div class="alert alert-success alert-dismissible mb-3">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success! </strong> <?php echo $_SESSION['message']; ?>
                                </div>
                                <?php unset($_SESSION['form']); unset($_SESSION['message']); ?>
                            <?php endif; ?>

                            <?php if (isset($_GET['edit']) && $_GET['edit'] == 'password') : ?>
                                <!---edit password--->
                                <form class="account-form" action="" method="POST">
                                    <h4 class="mb-4">Change Password</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="oldpassword">Old Password</label>
                                                <input type="password" name="oldpassword" class="form-control form-control-md" maxlength="60" required value="<?php echo $oldpassword ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="newpassword">New Password</label>
                                                <input type="password" name="newpassword" class="form-control form-control-md" minlength="8" maxlength="60" required value="<?php echo $newpassword ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="repassword">Re-type New Password</label>
                                                <input type="password" name="repassword" class="form-control form-control-md" minlength="8" maxlength="60" required value="<?php echo $repassword ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-md mt-4" name="save-password" id="save-password" type="submit">SAVE</button>
                                    <!--<a class="btn btn-md mt-4 btn-cancel" href="profile_page.php">CANCEL</a>-->
                                    <button class="btn btn-md mt-4 btn-cancel" type="button" onclick="location.href='profile_page.php'">CANCEL</button>

                                </form>
                            <?php else : ?>
                                <!---display password--->
                                <table class="table table-borderless mb-5">
                                    <thead>
                                        <th>
                                            <h4 class="mb-2">Password</h4>
                                            <p class="m-0">It's a good idea to use a strong password that you're not using elsewhere</p>
                                        </th>
                                        <th>
                                            <button class="btn btn-md mt-3 primary-btn" onclick="location.href='profile_page.php?edit=password'">CHANGE PASSWORD</button>
                                        </th>
                                    </thead>
                                </table>
                            <?php endif; ?>
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
    
</body>

</html>