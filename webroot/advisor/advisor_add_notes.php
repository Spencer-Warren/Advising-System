<?php
// Initialize the session
session_start();
include "advisor_header.php";
 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//check that advisor has selected a student advise
if(!isset($_SESSION["activeadvisee"])){
    header("location: advisor_select_current_advisee.php");
    exit;
}

// Include config file
require_once "../config.php";
// check role 
$role = $_SESSION["Role"];
if ($role !="advisor") {
	header("location: logout.php");
}
// make local variables of session variables	
$Student_First_Name = $_SESSION["Student_First_Name"];
$Student_Last_Name = $_SESSION["Student_Last_Name"];
//grab advisor first + last
$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION["Last_Name"];
					
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>351 Project || Add Student Notes</title>
 <link rel="stylesheet" href="main.css">
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="wrapper">
        <?php include "advisor_header.html" ?>
<h1> Add Note to <?php echo $Student_First_Name . " " . $Student_Last_Name;?>:</h1>
<form class = "paddingbottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<p class="centeredbutton">Title</p>
				<input class="centeredbutton" type = "text" name="Title" placeholder="Enter Title">
				<br>
			<div>
                <textarea class="chunkybox" name="notes" rows="20" col = "15" placeholder = "Enter note here"></textarea>
            </div>
			 <div>
			<?php echo "<br>";?>
			</div>
			<button class="centeredbutton" type="submit">Add Note</button>
</form>
<div class="centered">
	<?php if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		// grab the submitted note 
		$newnotes = $_POST["notes"];
		// grab the title
		$Title = $_POST["Title"];
		$_SESSION["Title"] = $Title;
		// grab student id and advisor id 
		$Student_ID = $_SESSION["Student_ID"];
		$Advisor_ID = $_SESSION["Advisor_ID"];
		//insert note into note table
		$query = "INSERT INTO note (Student_ID, Advisor_ID, Note, Title) VALUES ('$Student_ID', '$Advisor_ID', '$newnotes', '$Title')";
		$result = mysqli_query($link, $query);
		// let user know the note has been added and where to find it
		echo "Note added to student profile. View the Note by navigating to Advisor Actions --> Notes.";
		
	}
	?>
	</div>
    </div>
</body>
</html>