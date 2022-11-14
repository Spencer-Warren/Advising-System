<?php
// Initialize the session
session_start();
 // Include config file
require_once "../config.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

// check role 
$role = $_SESSION["Role"];
if ($role !="advisor") {
	header("location: ../logout.php");
}
//make local variables of session variables 
$Student_First_Name = $_SESSION["Student_First_Name"];
$Student_Last_Name = $_SESSION["Student_Last_Name"];
$Student_ID = $_SESSION["Student_ID"];
$id = $_SESSION["Advisor_ID"];

//grab advisor first and last name			
$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION["Last_Name"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php if (isset($title)) echo $title; ?></title>
    <link rel="stylesheet" href="main.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

        <nav>
            <ul>
                <li> <a href="advisor_index.php"><img src="../images/cnu-initials.jpeg" height="35" width="120" /></a></li>
                <div class="dropdown">
                    <li class="dropbtn"><a disabled="disabled" title="Advisor Actions">Advisor Actions</a></li>
                    <div class="dropdown-content">
                        <a href="advisor_select_current_advisee.php">Select Active Advisee</a>
                        <a href="advisor_student_information.php">Advisee Information</a>
                        <a href="advisor_notes.php">Notes</a>
						<a href="advisor_send_suggestions.php">Suggestions</a>
                    </div>
                </div>
                <div class="dropdown">
                    <li class="dropbtn"><a disabled="disabled" title="Meetings">Meetings</a></li>
                    <div class="dropdown-content">
                        <a href="advisor_meeting.php">My Meetings</a>
                        <a href="advisor_meeting_setup.php">Meeting Setup</a>
                    </div>
                </div>
                <div class="dropdown">
                    <li class="dropbtn"><a disabled="disabled" title="Information">Information Station</a></li>
                    <div class="dropdown-content">
						<a href="advisor_info.php">My Information</a>
						<a href="advisee_list.php">Advisee List</a>
                        <a href="advisor_class_information.php">Schedule of Classes</a>
                    </div>
                </div>
                <div class="dropdown">
                        <li><a href="../logout.php" title="Logout">Logout</a></li>
                    </div>
                </div>
            </ul>
        </nav>