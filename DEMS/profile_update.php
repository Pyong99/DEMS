<?php 
require "config.php";
require_once "controllerUserData.php";

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $user_id = $_GET['id'];
    $user_name = $_POST['fullname'];
    $user_ic = $_POST['user_ic'];
    $user_phoneNo = $_POST['user_phoneNo'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    
    $update_user = "UPDATE usertable SET name='$user_name', user_ic='$user_ic', user_phoneNo='$user_phoneNo',user_address='$user_address' WHERE id='$user_id'";
    
    if (!mysqli_query($con,$update_user)) 
    {
        echo '<script> alert("Failed to update data"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        //echo $executor_id;
        echo "<font color='green'>Data deleted successfully.";
        echo '<script> alert("Data updated successfully"); </script>';
        header('Location: profile.php');
    }
}


?>