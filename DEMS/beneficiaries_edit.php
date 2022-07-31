<?php
require "config.php";
require_once "controllerUserData.php"; 
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

//If submit form
if(isset($_POST['updatedata']))
{
    $beneficiaries_id = $_POST['update_id'];
    $beneficiaries_name = trim($_POST['beneficiaries_name']);
    $beneficiaries_ic = trim($_POST['beneficiaries_ic']);
    $beneficiaries_phoneNo = trim($_POST['beneficiaries_phoneNo']);
    $beneficiaries_relationship = trim($_POST['beneficiaries_relationship']);
    

    $result = "UPDATE beneficiaries SET beneficiaries_name='$beneficiaries_name',beneficiaries_ic='$beneficiaries_ic',beneficiaries_phoneNo='$beneficiaries_phoneNo',beneficiaries_relationship='$beneficiaries_relationship' WHERE beneficiaries_id='$beneficiaries_id' LIMIT 1";
    if (!mysqli_query($con,$result)) 
    {
        echo '<script> alert("Failed to update data"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        //echo $beneficiaries_id;
        echo "<font color='green'>Data deleted successfully.";
        echo '<script> alert("Data updated successfully"); </script>';
        header('Location: beneficiaries.php');
    }

}