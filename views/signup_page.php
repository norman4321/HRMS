<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./partials/head.html"; ?>
</head>

<body id="signin-page">
    <!-- header -->
    <?php include "./partials/header.php"; ?>

    <!-- PHP -->
    <?php include "../config/database.php" ;
        $firstname = '';
        $lastname = '';
        $address = '';
        $birthdate = '';
        $nationality = '';
        $contact = '';
        $email = '';
        $password = '';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            #var_dump($_POST);
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $address = trim($_POST['address']);
            $birthdate = $_POST['birthdate'];
            $nationality = trim($_POST['nationality']);
            $contact = trim($_POST['contact']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Set User Details
            $type = 3; // role_id 3 = Registered User
            $status = 1; // status_id 1 = Active
            $date = date('Y-m-d H:i:s'); // mysql needed 2022-12-31 23:59:59
            $hashed = password_hash($password, PASSWORD_DEFAULT); // encrypt password
        
            // Validate if email already exists 
            $sql = "SELECT user_email FROM HRMS_user_account WHERE user_email='$email'";
            if ($rs=$conn->query($sql)) {
                if ($rs->num_rows<1) { 

                    // Insert data to  user_profile table
                    $sql = "INSERT INTO HRMS_user_profile SET profile_firstname='$firstname', profile_lastname='$lastname', profile_address='$address', profile_birthdate='$birthdate', profile_nationality='$nationality', profile_contact='$contact', profile_email='$email'";
                    #echo $sql.'<br>';
                    if ($conn->query($sql)) { 
                        #echo '<br> Data Inserted in user_profile table <br>';

                        // Get profile_id from user_profile table
                        $sql = "SELECT profile_id FROM HRMS_user_profile WHERE profile_email='$email' limit 1";
                        #echo $sql.'<br>';
                        if ($rs=$conn->query($sql)) {
                            if ($rs->num_rows>0) {
                                $profile_data=$rs->fetch_assoc();
                                $profile_id= $profile_data['profile_id'];
                                #echo '<br> profile_id is Retrieved in user_profile table <br>';
                                
                                // Insert data to user_account table
                                $sql = "INSERT INTO HRMS_user_account SET user_id=".$profile_id.", user_email='$email', user_password='$hashed', user_type=".$type.", user_status=".$status.", user_signup_date='$date'";
                                #echo $sql.'<br>';
                                if ($conn->query($sql)) { 
                                    #echo '<br>  Data Inserted in in user_account table <br>';
                                    $_SESSION['user_id'] = $profile_id;
                                    $_SESSION['user_type'] = $type;
                                    $_SESSION['message'] = 'Success! Your account has been created.';
                                    header("Location: home_page.php");
                                    die;
                                } else {
                                    echo $conn->error;  // display error for inserting data into database
                                }
                            } else {
                                echo 'No user found!';
                            }
                        } else {
                            echo $conn->error;  // display error for getting profile_id from user_profile table
                        }
                    } else {
                        echo $conn->error;  // display error for inserting data into database
                    }
                } else {
                    $error_message = 'This email already exists. Please use another one.'; // Error Message
                }
            } else {
                echo $conn->error;  // display error for selecting data into database
            }
        }
    ?>

    <!-- sign up form -->
    <section class="signup">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body mt-1 p-4 p-md-4">
                            <h3 class="pb-md-0 mb-md-4">SIGN UP</h3>

                            <form action="" method="POST">

                                <!---- error message - start ---->
                                <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger alert-dismissible mb-3">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Sorry! </strong> <?php echo $error_message; ?>
                                </div>
                                <?php endif; ?>
                                <!---- error message - end ---->

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="firstname">First Name</label>
                                            <input type="text" name="firstname" class="form-control form-control-md" placeholder="e.g. Juan" maxlength="50" required value="<?php echo $firstname ?>" />

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
                                            <input type="Date" name="birthdate" id="birthdate" class="form-control form-control-md" required value="<?php echo $birthdate ?>" />
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
                                            <input type="tel" name="contact" class="form-control form-control-md" placeholder="e.g. 09053922400" minlength="8" maxlength="15" pattern="^[+]?[\d]+([\-][\d]+)*\d$" required value="<?php echo $contact ?>" /> <!-- [0-9]+ -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control form-control-md" maxlength="320" placeholder="e.g. juandelacruz@gmail.com" required value="<?php echo $email ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control form-control-md" minlength="8" maxlength="60" placeholder="••••••••" required value="<?php echo $password ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3 mb-2">
                                        <input class="btn btn-md" name="submit" type="submit" value="SUBMIT" />
                                    </div>
                                </div>
                                <div class="text-center mb-2">
                                    Already have an account?
                                    <a href="./signin_page.php">Sign in here</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        // When document ready... Set age limit by setting max birthdate
        $(function() {
            var today = new Date();
            var mm = today.getMonth()+1;
            mm = mm<10 ? '0'+mm : mm;
            var dd = today.getDate();
            dd = dd<10 ? '0'+dd : dd;
            var yyyy = today.getFullYear()-18;
            var date = yyyy+'-'+mm+'-'+dd;
            var input = document.getElementById("birthdate").max = date;
        });
    </script>
</body>

</html>