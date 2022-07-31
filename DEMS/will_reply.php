<?php
require "config.php";
require_once "controllerUserData.php"; 
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

//If submit form
if(isset($_POST['updatedata']))
{
    $dt = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur'));
    $date_received = $dt->format('d/m/Y');
    
    //Get the uploaded file information
    $file_name = basename($_FILES['file_received']['name']);
    $download_folder="download/";
    
    $file_path = $download_folder.$file_name;
    $tmp_path = $_FILES["file_received"]["tmp_name"];
    
    if(is_uploaded_file($tmp_path))
    {
      if(!copy($tmp_path,$file_path))
      {
          echo '<script> alert("Cannot upload"); </script>';
        $errors .= '\n error while copying the uploaded file';
      }
    }
    
    $submit_id = $_GET['id'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $result = "UPDATE submit SET status='$status',file_received='$file_path',date_received='$date_received',notes='$notes' WHERE submit_id='$submit_id' LIMIT 1";
    if (!mysqli_query($con,$result)) 
    {
        echo '<script> alert("Failed to update data"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        echo $submit_id;
        echo $file_path;
        echo $date_received;
        echo $status;
        echo "<font color='green'>Data deleted successfully.";
        echo '<script> alert("Data updated successfully"); </script>';
        header('Location: home-mt.php');
    }

}