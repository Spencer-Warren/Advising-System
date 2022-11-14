<?php
//Database connection.
$con = MySQLi_connect(
   "database-1.csg4rlfrt84b.us-east-1.rds.amazonaws.com", //Server host name.
   "admin", //Database username.
   "Lizard13245%", //Database password.
   "nodemysql" //Database name or anything you would like to call it.
);
//Check connection
if (MySQLi_connect_errno()) {
   echo "Failed to connect to MySQL: " . MySQLi_connect_error();
}
?>