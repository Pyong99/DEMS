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


if(isset($_POST['sig-dataUrl']))
{
    $data = $_POST["sig-dataUrl"];       
    $data = explode(",", $data)[1];
    $decoded_image = base64_decode($data);
    $temp_name = 'images/'.$id.".png";
    file_put_contents($temp_name, $decoded_image);
    // Store this $file to table.
    $file = basename($temp_name);
    header("Location: will.php");
        
}

?>