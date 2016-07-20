<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');

$mslink = mssql_connect('DATAWAREHOUSE URL', 'USERNAME', 'PASSWORD');

if (!$mslink || !mssql_select_db('DATABASE', $mslink)) {
    die('Unable to connect or select database!');
}

$account_id = $_GET['id'];

if (is_numeric($account_id)) { 
    
    // The extension apparently runs a few times in wrong places, checking if its a number fixes this
    // mssql_query(): message: The multi-part identifier &quot;ww3.au&quot; could not be bound. (severity 16)
    // mssql_query(): Query failed
    // mssql_query(): General SQL Server error: Check messages from the SQL Server (severity 16)
    
    $lookup_account_id_query = "SELECT email_address FROM dbo.wh_task
JOIN dbo.wh_account_contact ON dbo.wh_task.account_contact_id = dbo.wh_account_contact.account_contact_id
WHERE task_id = $account_id";

    $lookup_account_id = mssql_query($lookup_account_id_query) or die("Error Query [" . $lookup_account_id_query . "]");
    $objResult1 = mssql_fetch_array($lookup_account_id);
    $data = $objResult1['email_address'];

    echo "<a href='mailto:$data'>$data</a>";
} else {
    echo "";
}