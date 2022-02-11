<?php

require "database.php";
$id=$_GET['id'];
$firstname =  $_POST['profile_firstname'];
$lastname = $_POST['profile_lastname'];
$password =  $_POST['profile_password'];
$email = $_POST['profile_email'];
$address =  $_POST['profile_address'];
$birthdate = $_POST['profile_birthdate'];
$nationality =  $_POST['profile_nationality'];
$contact = $_POST['profile_contact'];
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




$sql = "UPDATE hrms_user_profile SET profile_firstname = '$firstname', profile_lastname='$lastname', profile_address='$address', profile_birthdate='$birthdate', profile_nationality='$nationality',profile_contact='$contact',profile_email='$email' WHERE profile_id='$id'";

if ($conn->query($sql) === TRUE) {

} else {
  echo "Error updating record: " . $conn->error;
}

$sql = "UPDATE hrms_user_account SET user_email = '$email', user_password='$hashed', user_type='$typeid',user_status='$statusid' WHERE user_id='$id'";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully redirecting you back";
  header("refresh:1; ../views/admin/user_page.php");
} else {
  echo "Error updating record: " . $conn->error;
}
?>
