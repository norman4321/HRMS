        <?php

        require "database.php";
       
        $first_name =  $_REQUEST['profile_firstname'];
        $last_name = $_REQUEST['profile_lastname'];
      //  $password =  $_REQUEST['profile_password'];
        $email = $_REQUEST['profile_email'];
        $address =  $_REQUEST['profile_address'];
        $birthdate = $_REQUEST['profile_birthdate'];
        $nationality =  $_REQUEST['profile_nationality'];
        $contact = $_REQUEST['profile_contact'];
      //  $role = $_REQUEST['CreateUserRole'];
      //  $status = $_REQUEST['CreateUserStatus'];



        $sql = "INSERT INTO hrms_user_profile (profile_firstname,profile_lastname,profile_email,profile_address,profile_birthdate,profile_nationality,profile_contact) VALUES ('$first_name','$last_name','$email','$address','$birthdate','$nationality','$contact')";

        if(mysqli_query($conn, $sql)){
            echo "User Created";
        } else{
            echo "Something went wrong ". mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
        ?>
