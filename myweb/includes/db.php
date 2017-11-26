<?php
$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = 'wgh';
$db['db_name'] = 'MyWeb';

foreach($db as $key => $value){
    
    define(strtoupper($key),$value);
    
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if(!$connection){
    die("Database connection failed.");
}
//else{
    //echo "Database connected.";
//}

?>