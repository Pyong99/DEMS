<?php
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'digital_asset';
 
// Table's primary key
$primaryKey = 'digital_asset_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
    array( 'db' => 'digital_asset_name', 'dt' => 'digital_asset_name' ),
    array( 'db' => 'digital_asset_category',  'dt' => 'digital_asset_category' ),
    array( 'db' => 'digital_asset_username',   'dt' => 'digital_asset_username' ),
    array( 'db' => 'digital_asset_email',     'dt' => 'digital_asset_email' ),
    array( 'db' => 'digital_asset_password',     'dt' => 'digital_asset_password' ),
    array( 'db' => 'digital_asset_beneficiary',     'dt' => 'digital_asset_beneficiary' ),
    array( 'db' => 'digital_asset_notes',     'dt' => 'digital_asset_notes' )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'pyongcom_dems_admin',
    'pass' => 'rB+XtWau&4dI',
    'db'   => 'pyongcom_demsDB',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);