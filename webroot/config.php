<?php
/* Database credentials. Assuming you are running MySQL*/
define('DB_SERVER', 'database-1.csg4rlfrt84b.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'Lizard13245%');
define('DB_NAME', 'nodemysql');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>