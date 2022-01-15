<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./partials/head.html"; ?>
</head>

<body id="signin-page">
    <!-- header -->
    <?php include "./partials/header.php"; ?>

    <!-- PHP -->
    <?php include "../config/database.php";

        // Check if user is logged in
        if (isset($_SESSION['user_id'])) {
            header('Location: home_page.php');
        }

        $email = '';
        $password = '';
        $error_message = '';
        if (isset($_POST['submit'])) {
            #var_dump($_POST);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Check if email exists 
            $sql = "SELECT user_email, user_password, user_id, user_type, user_status  FROM HRMS_user_account WHERE user_email='$email' LIMIT 1";
            if ($rs=$conn->query($sql)) {
                if ($rs->num_rows>0) { 
                    $user_data=$rs->fetch_assoc();

                    // Check if password matches
                    if(password_verify($password, $user_data['user_password']) && $user_data['user_status'] == 1) {
                        
                        // Set session variables
                        $_SESSION['user_id'] = $user_data['user_id'];
                        $_SESSION['user_type'] = $user_data['user_type'];

                        // Redirect user to their corresponding pages
                        if ($user_data['user_type'] == 1 || $user_data['user_type'] == 2) { 
                            header("Location: admin/dashboard_page.php");   // admin & receptionist
                        } elseif ($user_data['user_type'] == 3) {
                            header("Location: home_page.php");   // registered user
                        }
                        
                    } else {
                        $error_message = 'Invalid email or password.'; // Display Error Message
                    }

                } else {
                    $error_message = 'Invalid email or password.'; // Display Error Message
                }
            } else {
                echo $conn->error;  // display error for selecting data into database
            }
        }
    ?>

    <!-- sign in form -->
    <section class="signin">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body mt-1 p-4 p-md-4">
                            <h3 class="pb-md-0 mb-md-4">SIGN IN</h3>
                            <form action="" method="POST">
                                
                                <!---- error message - start ---->
                                <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger alert-dismissible mb-3">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error! </strong> <?php echo $error_message; ?>
                                </div>
                                <?php endif; ?>
                                <!---- error message - end ---->

                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control form-control-md" placeholder="e.g. juandelacruz@gmail.com" maxlength="320" required value="<?php echo $email ?>" />

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control form-control-md" maxlength="60" placeholder="••••••••" required value="<?php echo $password ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4 align-items-end">
                                        <input class="btn btn-md" name="submit" type="submit" value="SUBMIT" />
                                    </div>
                                </div>
                                <div class="text-center mb-2">
                                    Don't have an account?
                                    <a href="./signup_page.php">Sign up here</a>
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

</body>

</html>