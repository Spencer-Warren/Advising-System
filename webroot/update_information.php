<?php

// Initialize the session
include "config.php";
session_start();
 

require_once "config.php";

if (isset($_SESSION["Student_ID"])) {
	$Student_ID = $_SESSION["Student_ID"];
}
if (isset($_SESSION["Advisor_ID"])) {
	$Advisor_ID = $_SESSION["Advisor_ID"];
}
$role = $_SESSION["Role"];
											
mysqli_close($link);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["First_Name"] . " " . $_SESSION["Last_Name"]); ?></b>. Welcome. Click the button below to navigate to our homepage.</h1>
<?php
	switch ($role) {
    case 'student':
        $redirect = 'student/student_index.php';
		header('Location: ' . $redirect);
    break;
    case 'advisor':
		if ($_SESSION["IsChair"]) {
			$redirect = 'chair/chair_index.php';
		}
		else {
        $redirect = 'advisor/advisor_index.php';
		}
	header('Location: ' . $redirect);
	break;
}

if(isset($_POST['button1'])) {
            header('Location: ' . $redirect);
        }

?>
<form method="post">   
        <input type="submit" name="button1"
                class="centeredbutton" value="Go to Homepage"/>
</form>
    <p class="centered">
        <a href="change-password.php" class="btn btn-warning">Change Your Password || </a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>