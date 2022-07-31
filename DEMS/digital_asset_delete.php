<?php
require "config.php";
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

//If submit delete form
if(isset($_POST['deletedata']))
{
    $digital_asset_id = $_POST['delete_id'];

    $result = "DELETE FROM digital_asset WHERE digital_asset_id=$digital_asset_id";
    if (!mysqli_query($con,$result)) 
    {
        echo "id"+$digital_asset_id;
        //echo '<script> alert("Failed to delete data"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        //echo $digital_asset_id;
        echo "<font color='green'>Data deleted successfully.";
        echo '<script> alert("Data deleted successfully"); </script>';
        header('Location: digital_asset.php');
    }
}


//If click hyperlink
if(isset($_GET['digital_assetID']))
{
    $digital_asset_id = $_GET['digital_assetID'];

    $result = "DELETE FROM digital_asset WHERE digital_asset_id=$digital_asset_id";
    if (!mysqli_query($con,$result)) 
    {
        echo '<script> alert("Failed to delete data"); </script>';
        
    }else{
        mysqli_close($con);
		
        //display success message
        //echo ID+_SESSION(id);
        //echo ID+$id;
        //echo $digital_asset_id;
        echo "<font color='green'>Data deleted successfully.";
        echo '<script> alert("Data deleted successfully"); </script>';
        header('Location: digital_asset.php');
    }
    
}
?>