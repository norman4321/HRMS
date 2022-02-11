        <?php

        require "database.php";

        $firstname =  $_REQUEST['profile_firstname'];
        $lastname = $_REQUEST['profile_lastname'];
        $password =  $_REQUEST['profile_password'];
        $email = $_REQUEST['profile_email'];
        $address =  $_REQUEST['profile_address'];
        $birthdate = $_REQUEST['profile_birthdate'];
        $nationality =  $_REQUEST['profile_nationality'];
        $contact = $_REQUEST['profile_contact'];
        $type = $_POST['CreateUserRole'];
        $status = $_POST['CreateUserStatus'];
        $typeid = "";
        $statusid = "";


/*
        $sql = "INSERT INTO hrms_user_profile (profile_firstname,profile_lastname,profile_email,profile_address,profile_birthdate,profile_nationality,profile_contact) VALUES ('$first_name','$last_name','$email','$address','$birthdate','$nationality','$contact')";

        if(mysqli_query($conn, $sql)){
            echo "User Created";
        } else{
            echo "Something went wrong ". mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
*/
if ($status=="Active")
      $statusid=1;
    else
      $statusid=2;
if ($type=="Admin")
      $typeid=1;
    else
      $typeid=2;



$date = date('Y-m-d H:i:s'); // mysql needed 2022-12-31 23:59:59
$hashed = password_hash($password, PASSWORD_DEFAULT);



$sql = "SELECT user_email FROM hrms_user_account WHERE user_email='$email'";
if ($rs=$conn->query($sql)) {
    if ($rs->num_rows<1) {

        // Insert data to  user_profile table
        $sql = "INSERT INTO hrms_user_profile SET profile_firstname='$firstname', profile_lastname='$lastname', profile_address='$address', profile_birthdate='$birthdate', profile_nationality='$nationality', profile_contact='$contact', profile_email='$email'";
        #echo $sql.'<br>';
        if ($conn->query($sql)) {
            #echo '<br> Data Inserted in user_profile table <br>';

            // Get profile_id from user_profile table
            $sql = "SELECT profile_id FROM hrms_user_profile WHERE profile_email='$email' limit 1";
            #echo $sql.'<br>';
            if ($rs=$conn->query($sql)) {
                if ($rs->num_rows>0) {
                    $profile_data=$rs->fetch_assoc();
                    $profile_id= $profile_data['profile_id'];
                    #echo '<br> profile_id is Retrieved in user_profile table <br>';

                    // Insert data to user_account table
                    $sql = "INSERT INTO hrms_user_account SET user_id=".$profile_id.", user_email='$email', user_password='$hashed', user_type=".$typeid.", user_status=".$statusid.", user_signup_date='$date'";
                    #echo $sql.'<br>';
                    if ($conn->query($sql)) {
                        #echo '<br>  Data Inserted in in user_account table <br>';
                        $_SESSION['message'] = 'Success! Account has been created.';
                        header("Location: ../views/admin/user_page.php");
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
}
        ?>
