<?php
//Database connection.
$con = MySQLi_connect(
   "", //Server host name.
   "admin", //Database username.
   "", //Database password.
   "nodemysql" //Database name or anything you would like to call it.
);
//Check connection
if (MySQLi_connect_errno()) {
   echo "Failed to connect to MySQL: " . MySQLi_connect_error();
}
?>
