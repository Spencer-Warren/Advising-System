<?php
$title = "351 Project || Delete Notes";
include "chair_header.php";

//check that advisor has selected a student advise
if(!isset($_SESSION["activeadvisee"])){
    header("location: chair_select_current_advisee.php");
    exit;
}
							
$IDOFNote = $_SESSION["IDOFNote"];

$query = "DELETE FROM note WHERE ID = '$IDOFNote'";
$result = mysqli_query($link, $query);
$_SESSION["IDOFNOTE"] = null; 
$_SESSION["Notes"] = null; 
header("location: chair_notes.php");
die();
?>