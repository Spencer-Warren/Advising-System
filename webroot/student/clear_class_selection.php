<?php
session_start();
if(isset($_POST['clearme'])){
	$_SESSION['classselection'] = array();
	header("Refresh:0");
}
?>
