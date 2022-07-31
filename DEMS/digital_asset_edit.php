<?php
require "config.php";
require_once "controllerUserData.php"; 
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

//If submit form
if(isset($_POST['updatedata']))
{
    $digital_asset_id = $_POST['update_id'];
    $digital_asset_name = trim($_POST['digital_asset_name']);
    $digital_asset_category = trim($_POST['digital_asset_category']);
    $digital_asset_username  = trim($_POST['digital_asset_username']);
    $digital_asset_email = trim($_POST['digital_asset_email']);
    $digital_asset_password  = trim($_POST['digital_asset_password']);
    $digital_asset_beneficiary  = trim($_POST['digital_asset_beneficiary']);
    $digital_asset_notes = trim($_POST['digital_asset_notes']);

    
    
    $result = "UPDATE digital_asset SET digital_asset_name='$digital_asset_name', digital_asset_category='$digital_asset_category', digital_asset_username='$digital_asset_username', digital_asset_email='$digital_asset_email', digital_asset_password='$digital_asset_password', digital_asset_beneficiary='$digital_asset_beneficiary', digital_asset_notes='$digital_asset_notes' WHERE digital_asset_id='$digital_asset_id' ";
    
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
        header('Location: digital_asset.php');
    }

}