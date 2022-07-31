<?php
require "config.php";
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

//If submit delete form
if(isset($_POST['deletedata']))
{
    $executor_id = $_POST['delete_id'];

    $result = "DELETE FROM executor WHERE executor_id=$executor_id";
    if (!mysqli_query($con,$result)) 
    {
        echo "id"+$executor_id;
        //echo '<script> alert("Failed to delete data"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        //echo $executor_id;
        echo "<font color='green'>Data deleted successfully.";
        echo '<script> alert("Data deleted successfully"); </script>';
        header('Location: executor.php');
    }
}


//If click hyperlink
if(isset($_GET['executorID']))
{
    $executor_id = $_GET['executorID'];

    $result = "DELETE FROM executor WHERE executor_id=$executor_id";
    if (!mysqli_query($con,$result)) 
    {
        echo '<script> alert("Failed to delete data"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        //echo $executor_id;
        echo "<font color='green'>Data deleted successfully.";
        echo '<script> alert("Data deleted successfully"); </script>';
        header('Location: executor.php');
    }
    
}
?>