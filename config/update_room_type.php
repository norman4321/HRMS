<?php
include "database.php";

if(isset($_POST['room_type_name']))
 $type=$_POST['room_type_name'];
 $price=$_POST['room_price'];
 $capacity=$_POST['room_capacity'];
 $description=$_POST['room_description'];
 $tmp_name=$_FILES['room_image']['tmp_name'];
 $file_name=$_FILES['room_image']['name'];
 $file_size=$_FILES['room_image']['size'];


 //
 $file_location="../../public/images/upload";
 $file_to_upload="../public/images/upload".'/'.basename($file_name);

 //FILE VALIDATION
   if($file_size>0){
     if($file_size<2400000){
       $ext=strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
       if($ext=='jpg' || $ext=='png'|| $ext=='jpeg'|| $ext=='gif'||$ext=='bmp'){
           //uploading
           if(move_uploaded_file($tmp_name,$file_to_upload)){
               $sql="UPDATE hrms_room_type SET room_image='$file_to_upload', type_name='$type', room_description='$description',room_capacity='$capacity',room_price='$price' WHERE type_name='$type'";
               if($conn->query($sql)){
                 echo "Record updated successfully redirecting you back";
                 header("refresh:1; ../views/admin/room_type_page.php");
               }else{
                 echo $conn->error;
               }
           }else{
             $err_msg='Encounter Error Problem upon Uploading';
           }
       }else{
           $err_msg='Invalid File Type';
       }
     }else{
         $err_msg='File size exceeds at 24MB maximum file size';
     }

   }
   else{// no selected file

  $sql="UPDATE hrms_room_type SET type_name='$type', room_description='$description',room_capacity='$capacity',room_price='$price' WHERE type_name='$type'";
     if($conn->query($sql)){
        echo "Record updated successfully redirecting you back";
        header("refresh:1; ../views/admin/room_type_page.php");
     }else{
       echo $conn->error;
     }
 //END OF FILE VALIDATION
/*  */
}

?>
