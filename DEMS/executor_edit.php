<?php
require "config.php";
require_once "controllerUserData.php"; 
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

//If submit form
if(isset($_POST['updatedata']))
{
    $executor_id = $_POST['update_id'];
    $executor_name = trim($_POST['executor_name']);
    $executor_ic = trim($_POST['executor_ic']);
    $executor_phoneNo = trim($_POST['executor_phoneNo']);
    $executor_email = trim($_POST['executor_email']);
    $executor_state = trim($_POST['executor_state']);

    $result = "UPDATE executor SET executor_name='$executor_name',executor_ic='$executor_ic',executor_phoneNo='$executor_phoneNo',executor_email='$executor_email',executor_state='$executor_state' WHERE executor_id='$executor_id' LIMIT 1";
    if (!mysqli_query($con,$result)) 
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
        header('Location: executor.php');
    }

}