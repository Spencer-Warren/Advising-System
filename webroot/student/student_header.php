<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: ../login.php");
	exit;
}

//check that advisor has selected a student advise
require_once "../config.php";

$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION["Last_Name"];
$id = $_SESSION["Student_ID"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<link rel="stylesheet" href="student.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Including jQuery is required. -->
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <!-- Including our scripting file. -->
   <script type="text/javascript" src="script.js"></script>
</head>
<nav>
    <ul>
        <li> <a href="student_index.php"><img src="../images/cnu-initials.jpeg" height="35" width="120" /></a></li>
		  <div class="dropdown">
    <li class="dropbtn"><a disabled="disabled" title="Student Information">Student Information</a></li>
            <div class="dropdown-content">
				<a href="student_information.php">My Information</a>
				<a href="student_four_year_plan.php">Four Year Plan</a>
				<a href="student_suggestions.php">Suggestions From Advisor</a>
            </div>
        </div>
		<div class="dropdown">
<li class="dropbtn"><a disabled="disabled" title="Contact Advisor">Contact Advisor</a></li>
            <div class="dropdown-content">
                <a href="student_advisor_info.php">Advisor Information</a>
                <a href="student_meeting.php">My Meetings</a>
                <a href="student_meeting_setup.php">Meeting Setup</a>
            </div>
        </div>
		<div class="dropdown">
<li class="dropbtn"><a disabled="disabled" title="Information Station">Information Station</a></li>
            <div class="dropdown-content">
            <a href="student_class_information.php">Class Information</a>
            </div>
        </div>
		<div class="dropdown">
        <li><a href="../logout.php" title="Logout">Logout</a></li>
		</div>
    </ul>
    </nav>