<?php
$title = "351 Project || Send Suggestions";
include "advisor_header.php";

//check that advisor has selected a student advise
if (!isset($_SESSION["activeadvisee"])) {
	header("location: advisor_select_current_advisee.php");
	exit;
}
$Student_ID = $_SESSION["Student_ID"];
$query = "SELECT First_Name, Last_Name, EmailAddress, Advisor_ID FROM advisor WHERE Advisor_id = $id";
if ($result = mysqli_query($link, $query)) {
	while ($row = mysqli_fetch_row($result)) {
		$_SESSION["first_name"] = $row[0];
		$_SESSION["last_name"] = $row[1];
		$_SESSION["emailaddress"] = $row[2];
		$_SESSION["advisorid"] = $row[3];
	}
}


$advisorid = $_SESSION["Advisor_ID"];

//$query2 = "SELECT Suggestion FROM student WHERE Student_ID = '$Student_ID'"; 
//$result2 = mysqli_query($link, $query2);

?>
<div class="content">
	<h1>Send Suggestion to <?php echo $Student_First_Name . " " . $Student_Last_Name; ?> </h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<form name="activeadviseeform" class="centeredbutton">

			<div>
				<div>
					<textarea class="chunkybox" name="suggestion" rows="10" col="15" placeholder="Enter Suggestion Here"></textarea>
				</div>
			</div>

			<button class="centeredbutton" type="submit">Submit Suggestion</button>
		</form>
</div>
</div>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($student_notes == null) {
		$suggestion =  $time . " " . $_POST['suggestion'];
	}
	if ($suggestion != null) {
		$suggestion = $student_suggestions . "\r\n" . $time . " " . $_POST['suggestion'];
	}
	$update = "UPDATE student SET Suggestions = '$suggestion' WHERE Student_ID = '$Student_ID'";
	// update in database 
	$rs = mysqli_query($link, $update);

	if ($rs) {
		header("Refresh:0");
		//printf("Notes Added to : %s Notes", $_SESSION["activeadvisee"]);
	}
}
?>
</body>
</html>