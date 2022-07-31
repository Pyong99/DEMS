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
    //Get the uploaded file information
    $file_name =
    basename($_FILES['file_sent']['name']);
    $upload_folder="upload/";
    
    $file_path = $upload_folder . $file_name;
    $tmp_path = $_FILES["file_sent"]["tmp_name"];
    
    if(is_uploaded_file($tmp_path))
    {
      if(!copy($tmp_path,$file_path))
      {
        $errors .= '\n error while copying the uploaded file';
      }
    }

    $email_sent = mysqli_real_escape_string($con, $_POST['email_sent']);
    $email_received = mysqli_real_escape_string($con, $_POST['citySelect']);
    $user_id = mysqli_real_escape_string($con,$_POST['user_id']);
    $date_sent= mysqli_real_escape_string($con,$_POST['date_sent']);
    $file_sent = "pdf/990207015716_10052022.pdf";
    $file=$_FILES['file_sent']['name']; 
    
    
    $result = "INSERT INTO submit(`email_sent`,`email_received`,`user_id`,`date_sent`,`file_sent`) VALUES('$email_sent','$email_received','$user_id','$date_sent','$file_path')";
//     $result = "INSERT INTO submit (submit_id, date_sent, file_sent, status,	file_received,	date_received,	email_sent,	email_received,	notes,	user_id
// ) VALUES(null,$date_sent,null,null,null,null,$email_sent,$email_received,null,$user_id)";
    if (!mysqli_query($con,$result)) 
    {
        echo "Query Failed! SQL: $sql - Error: ".mysqli_error($con), E_USER_ERROR;
        echo $email_sent;
        echo "id:" +$user_id;
        echo $email_received;
        echo $date_sent;
        echo $file_path;
        echo '<script> alert("Data Not Saved"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        echo "<font color='green'>Data added successfully.";
        echo '<script> alert("Data Saved"); </script>';
        header('Location: will.php');
    }
        
    
    
    
}

?>