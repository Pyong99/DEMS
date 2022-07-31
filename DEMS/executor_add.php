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
    // $executor_name = $_POST['executor_name'];
    // $executor_ic = $_POST['executor_ic'];
    // $executor_email= $_POST['executor_email'];
    // $executor_phoneNo = $_POST['executor_phoneNo'];
    // $executor_state = $_POST['executor_state'];
    
    $executor_name = mysqli_real_escape_string($con, $_POST['executor_name']);
    $executor_ic = mysqli_real_escape_string($con,$_POST['executor_ic']);
    $executor_email= mysqli_real_escape_string($con,$_POST['executor_email']);
    $executor_phoneNo = mysqli_real_escape_string($con,$_POST['executor_phoneNo']);
    $executor_state = mysqli_real_escape_string($con,$_POST['executor_state']);
    
    $result = "INSERT INTO executor(user_id, executor_name, executor_ic, executor_email, executor_phoneNo,executor_state,executor_id) VALUES('$id','$executor_name','$executor_ic','$executor_email', '$executor_phoneNo', '$executor_state',null)";
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
        header('Location: executor.php');
    }
        
    
    
    
    // $executor_name = $_POST['executor_name'];
    // $executor_ic = $_POST['executor_ic'];
    // $executor_email= $_POST['executor_email'];
    // $executor_phoneNo = $_POST['executor_phoneNo'];
    // $executor_state = $_POST['executor_state'];


    //$query = "INSERT INTO executor (user_id, executor_id, executor_name, executor_ic, executor_email, executor_phoneNo, executor_state) VALUES ('$id',null,'$executor_name','$executor_ic','$executor_email','$executor_phoneNo','$executor_state')";
    //$query = "INSERT INTO executor (`user_id, executor_id`, `executor_name`, `executor_ic`, `executor_email`, `executor_phoneNo`, `executor_state`) VALUES ('$id',null,'$executor_name','$executor_ic','$executor_email','$executor_phoneNo','$executor_state')";
    //mysqli_query($con,"INSERT INTO executor (`user_id`,`executor_id`, `executor_name`, `executor_ic`, `executor_email`, `executor_phoneNo`,`executor_state`) VALUES ('".$id."',NULL,'".$_POST['executor_name']."','".$_POST['executor_ic']."','".$_POST['executor_phoneNo']."','".$_POST['executor_state']."')");
    
    //('$id','$executor_name','$executor_ic','$executor_email', '$executor_phoneNo', '$executor_state',null)";
    //$query_run = mysqli_query($connection, $query);

    // if($query_run)
    // {
    //     echo '<script> alert("Data Saved"); </script>';
    //     header('Location: executor.php');
    // }
    // else
    // {
    //     echo '<script> alert("Data Not Saved"); </script>';
    // }
}

?>