<?php
if(isset($_POST['current'])){
session_start();
$_SESSION["currentlyselected"] = $_POST;
//^^ if findvariable in script.js completes properly, start session and set session variable equal to array

//create new array equal to session variable
$newarray = $_SESSION['classselection'];
//go through session variable and push contents to new array(adds new array items to end of old array items)
foreach($_SESSION['currentlyselected'] as $fruits){
	array_push($newarray, $fruits);
}
//set session variable equal to old+new array	
$_SESSION['classselection'] = $newarray;
}
?>