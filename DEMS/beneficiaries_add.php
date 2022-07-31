<?php
include_once "config.php";
require_once "controllerUserData.php"; 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'pyongcom_dems_admin');
define('DB_PASSWORD', 'rB+XtWau&4dI');
define('DB_NAME', 'pyongcom_demsDB');
 
$connection = mysqli_connect("localhost","pyongcom_dems_admin","rB+XtWau&4dI");
$db = mysqli_select_db($connection, 'pyongcom_demsDB');

//set user id
$email = $_SESSION['email'];
$sql = "SELECT * FROM usertable WHERE email = '$email'";
$run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $id=$fetch_info['id'];
        $_SESSION['id'] =$fetch_info['id'];
    }


if(isset($_POST['insertdata']))
{
    // $beneficiaries_name = $_POST['beneficiaries_name'];
    // $beneficiaries_ic = $_POST['beneficiaries_ic'];
    // $beneficiaries_email= $_POST['beneficiaries_email'];
    // $beneficiaries_phoneNo = $_POST['beneficiaries_phoneNo'];
    // $beneficiaries_relationship = $_POST['beneficiaries_relationship'];
    
    $beneficiaries_name = mysqli_real_escape_string($con, $_POST['beneficiaries_name']);
    $beneficiaries_ic = mysqli_real_escape_string($con,$_POST['beneficiaries_ic']);
    $beneficiaries_email= mysqli_real_escape_string($con,$_POST['beneficiaries_email']);
    $beneficiaries_relationship = mysqli_real_escape_string($con,$_POST['beneficiaries_relationship']);
    $beneficiaries_phoneNo = mysqli_real_escape_string($con,$_POST['beneficiaries_phoneNo']);
    
    
    $result = "INSERT INTO beneficiaries(user_id, beneficiaries_name, beneficiaries_ic, beneficiaries_relationship,beneficiaries_phoneNo,beneficiaries_id) VALUES('$id','$beneficiaries_name','$beneficiaries_ic','$beneficiaries_relationship','$beneficiaries_phoneNo',null)";
    if (!mysqli_query($con,$result)) 
    {
        echo '<script> alert("Data Not Saved"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        echo "<font color='green'>Data added successfully.";
        echo '<script> alert("Data Saved"); </script>';
        header('Location: beneficiaries.php');
    }
        
    
    
    
    // $beneficiaries_name = $_POST['beneficiaries_name'];
    // $beneficiaries_ic = $_POST['beneficiaries_ic'];
    // $beneficiaries_email= $_POST['beneficiaries_email'];
    // $beneficiaries_phoneNo = $_POST['beneficiaries_phoneNo'];
    // $beneficiaries_relationship = $_POST['beneficiaries_relationship'];


    //$query = "INSERT INTO beneficiaries (user_id, beneficiaries_id, beneficiaries_name, beneficiaries_ic, beneficiaries_email, beneficiaries_phoneNo, beneficiaries_relationship) VALUES ('$id',null,'$beneficiaries_name','$beneficiaries_ic','$beneficiaries_email','$beneficiaries_phoneNo','$beneficiaries_relationship')";
    //$query = "INSERT INTO beneficiaries (`user_id, beneficiaries_id`, `beneficiaries_name`, `beneficiaries_ic`, `beneficiaries_email`, `beneficiaries_phoneNo`, `beneficiaries_relationship`) VALUES ('$id',null,'$beneficiaries_name','$beneficiaries_ic','$beneficiaries_email','$beneficiaries_phoneNo','$beneficiaries_relationship')";
    //mysqli_query($con,"INSERT INTO beneficiaries (`user_id`,`beneficiaries_id`, `beneficiaries_name`, `beneficiaries_ic`, `beneficiaries_email`, `beneficiaries_phoneNo`,`beneficiaries_relationship`) VALUES ('".$id."',NULL,'".$_POST['beneficiaries_name']."','".$_POST['beneficiaries_ic']."','".$_POST['beneficiaries_phoneNo']."','".$_POST['beneficiaries_relationship']."')");
    
    //('$id','$beneficiaries_name','$beneficiaries_ic','$beneficiaries_email', '$beneficiaries_phoneNo', '$beneficiaries_relationship',null)";
    //$query_run = mysqli_query($connection, $query);

    // if($query_run)
    // {
    //     echo '<script> alert("Data Saved"); </script>';
    //     header('Location: beneficiaries.php');
    // }
    // else
    // {
    //     echo '<script> alert("Data Not Saved"); </script>';
    // }
}

?>