<?php
require "config.php";
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

//If submit delete form
if(isset($_POST['deletedata']))
{
    $beneficiaries_id = $_POST['delete_id'];

    $result = "DELETE FROM beneficiaries WHERE beneficiaries_id=$beneficiaries_id";
    if (!mysqli_query($con,$result)) 
    {
        echo "id"+$beneficiaries_id;
        //echo '<script> alert("Failed to delete data"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        //echo $beneficiaries_id;
        echo "<font color='green'>Data deleted successfully.";
        echo '<script> alert("Data deleted successfully"); </script>';
        header('Location: beneficiaries.php');
    }
}


//If click hyperlink
if(isset($_GET['beneficiariesID']))
{
    $beneficiaries_id = $_GET['beneficiariesID'];

    $result = "DELETE FROM beneficiaries WHERE beneficiaries_id=$beneficiaries_id";
    if (!mysqli_query($con,$result)) 
    {
        echo '<script> alert("Failed to delete data"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        //echo $beneficiaries_id;
        echo "<font color='green'>Data deleted successfully.";
        echo '<script> alert("Data deleted successfully"); </script>';
        header('Location: beneficiaries.php');
    }
    
}
?>