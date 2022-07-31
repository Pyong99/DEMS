<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'pyongcom_dems_admin');
define('DB_PASSWORD', 'rB+XtWau&4dI');
define('DB_NAME', 'pyongcom_demsDB');
 
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>