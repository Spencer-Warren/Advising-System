<?php
// Initialize the session
session_start();
require_once "../config.php";

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: ../login.php");
	exit;
}
//make local variables of session variables 
$Student_First_Name = $_SESSION["Student_First_Name"];
$Student_Last_Name = $_SESSION["Student_Last_Name"];
$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION["Last_Name"];
$role = $_SESSION["Role"];
$id = $_SESSION["Advisor_ID"];

if ($role !="advisor") {
	header("location: ../logout.php");
}
$IsChair = $_SESSION["IsChair"];
if (!($IsChair)) {
	header("location: ../logout.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<link rel="stylesheet" href="main.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<div id="wrapper">
		<nav>
			<ul>
				 <li> <a href="chair_index.php"><img src="../images/cnu-initials.jpeg" height="35" width="120" /></a></li>
				<div class="dropdown">
					<li class="dropbtn"><a disabled="disabled" title="Advisor Actions">Advisor Actions</a></li>
					<div class="dropdown-content">
						<a href="chair_select_current_advisee.php">Select Active Advisee</a>
						<a href="chair_student_information.php">Advisee Information</a>
						<a href="chair_notes.php">Notes</a>
						<a href="chair_send_suggestions.php">Student Suggestions</a>
					</div>
				</div>
				<div class="dropdown">
					<li class="dropbtn"><a disabled="disabled" title="Chair Actions">Chair Actions</a></li>
					<div class="dropdown-content">
						<a href="chair_assign_new_students.php">Assign New Students to Advisor</a>
						<a href="chair_reassign_students.php">Reassign Students to Advisor</a>
						<a href="chair_accept_advisors.php">Accept/Decline Request for Advisor Role</a>
					</div>
				</div>
				<div class="dropdown">
                    <li class="dropbtn"><a disabled="disabled" title="Information">Information Station</a></li>
                    <div class="dropdown-content">
						<a href="chair_info.php">My Information</a>
						<a href="chair_list.php">Advisee List</a>
                        <a href="chair_class_information.php">Schedule of Classes</a>
                    </div>
					</div>
				<div class="dropdown">
					<li><a href="../logout.php">Logout</a></li>
					
				</div>
			</ul>
		</nav>