<?php
include_once "config.php";
require_once "controllerUserData.php";
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'pyongcom_dems_admin');
define('DB_PASSWORD', 'rB+XtWau&4dI');
define('DB_NAME', 'pyongcom_demsDB');

$connection = mysqli_connect("localhost", "pyongcom_dems_admin", "rB+XtWau&4dI");
$db = mysqli_select_db($connection, 'pyongcom_demsDB');

//set user id
$email = $_SESSION['email'];
$sql = "SELECT * FROM usertable WHERE email = '$email'";
$run_Sql = mysqli_query($con, $sql);
if ($run_Sql)
{
    $fetch_info = mysqli_fetch_assoc($run_Sql);
    $id = $fetch_info['id'];
    $_SESSION['id'] = $fetch_info['id'];
}

if (isset($_POST['insertdata']))
{
    // $digital_asset_name = $_POST['digital_asset_name'];
    // $digital_asset_ic = $_POST['digital_asset_ic'];
    // $digital_asset_email= $_POST['digital_asset_email'];
    // $digital_asset_phoneNo = $_POST['digital_asset_phoneNo'];
    // $digital_asset_state = $_POST['digital_asset_state'];
    $digital_asset_name = mysqli_real_escape_string($con, $_POST['digital_asset_name']);
    $digital_asset_category = mysqli_real_escape_string($con, $_POST['digital_asset_category']);
    $digital_asset_username = mysqli_real_escape_string($con, $_POST['digital_asset_username']);
    $digital_asset_email = mysqli_real_escape_string($con, $_POST['digital_asset_email']);
    $digital_asset_password = mysqli_real_escape_string($con, $_POST['digital_asset_password']);
    $digital_asset_beneficiary = mysqli_real_escape_string($con, $_POST['digital_asset_beneficiary']);
    $digital_asset_notes = mysqli_real_escape_string($con, $_POST['digital_asset_notes']);

    // $result = "INSERT INTO digital_asset(user_id, digital_asset_name, digital_asset_ic, digital_asset_email, digital_asset_phoneNo,digital_asset_state,digital_asset_id) VALUES('$id','$digital_asset_name','$digital_asset_ic','$digital_asset_email', '$digital_asset_phoneNo', '$digital_asset_state',null)";
    $result = "INSERT INTO digital_asset(user_id, digital_asset_id, digital_asset_name, digital_asset_category, digital_asset_username, digital_asset_email, digital_asset_password, digital_asset_beneficiary, digital_asset_notes) VALUES ('$id', null, '$digital_asset_name', '$digital_asset_category', '$digital_asset_username', '$digital_asset_email', '$digital_asset_password', '$digital_asset_beneficiary', '$digital_asset_notes')";
    if (!mysqli_query($con, $result))
    {
        echo '<script> alert("Data Not Saved"); </script>';

    }
    else
    {
        mysqli_close($con);

        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        echo "<font color='green'>Data added successfully.";
        echo '<script> alert("Data Saved"); </script>';
        header('Location: digital_asset.php');
    }

    // $digital_asset_name = $_POST['digital_asset_name'];
    // $digital_asset_ic = $_POST['digital_asset_ic'];
    // $digital_asset_email= $_POST['digital_asset_email'];
    // $digital_asset_phoneNo = $_POST['digital_asset_phoneNo'];
    // $digital_asset_state = $_POST['digital_asset_state'];
    

    //$query = "INSERT INTO digital_asset (user_id, digital_asset_id, digital_asset_name, digital_asset_ic, digital_asset_email, digital_asset_phoneNo, digital_asset_state) VALUES ('$id',null,'$digital_asset_name','$digital_asset_ic','$digital_asset_email','$digital_asset_phoneNo','$digital_asset_state')";
    //$query = "INSERT INTO digital_asset (`user_id, digital_asset_id`, `digital_asset_name`, `digital_asset_ic`, `digital_asset_email`, `digital_asset_phoneNo`, `digital_asset_state`) VALUES ('$id',null,'$digital_asset_name','$digital_asset_ic','$digital_asset_email','$digital_asset_phoneNo','$digital_asset_state')";
    //mysqli_query($con,"INSERT INTO digital_asset (`user_id`,`digital_asset_id`, `digital_asset_name`, `digital_asset_ic`, `digital_asset_email`, `digital_asset_phoneNo`,`digital_asset_state`) VALUES ('".$id."',NULL,'".$_POST['digital_asset_name']."','".$_POST['digital_asset_ic']."','".$_POST['digital_asset_phoneNo']."','".$_POST['digital_asset_state']."')");
    //('$id','$digital_asset_name','$digital_asset_ic','$digital_asset_email', '$digital_asset_phoneNo', '$digital_asset_state',null)";
    //$query_run = mysqli_query($connection, $query);
    // if($query_run)
    // {
    //     echo '<script> alert("Data Saved"); </script>';
    //     header('Location: digital_asset.php');
    // }
    // else
    // {
    //     echo '<script> alert("Data Not Saved"); </script>';
    // }
    
}

?>
