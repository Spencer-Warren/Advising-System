<?php
$title = "351 Project || Suggestions";
include "student_header.php";

$result = mysqli_query($link, "SELECT Advisor_ID from advising_table WHERE Student_ID = '$id'");
while ($row = mysqli_fetch_array($result)) {
	$Advisors_ID = $row["Advisor_ID"];
}
$resultsuggestion = mysqli_query($link, "SELECT Suggestions from student WHERE Student_ID = '$id'");


while ($row3 = mysqli_fetch_array($resultsuggestion)) {
	$suggestions = $row3["Suggestions"];
}

$result2 = mysqli_query($link, "SELECT First_Name, Last_Name FROM advisor WHERE Advisor_ID = '$Advisors_ID'");
while ($row2 = mysqli_fetch_array($result2)) {
	$advisor_first = $row2["First_Name"];
	$advisor_last = $row2["Last_Name"];
}

?>

<div>
	<h1><?php if(isset($advisor_first) && isset($advisor_last)) {echo "Suggestions from " . $advisor_first . " " . $advisor_last . ". You can delete and save them. They are there for you.";} else{ echo "Error: You have no advisor";} ?></h1>
	<h3 class="centered">Suggestions</h3>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<form name="suggestionsform" class="centeredbutton">

			<div>
				<div>
					<textarea class="chunkybox" name="suggestions" rows="10" col="15"><?php echo $suggestions; ?></textarea>
				</div>
			</div>

			<button class="centeredbutton" type="submit">Submit Edits</button>
		</form>
		<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$newsuggestions = $_POST['suggestions'];
			$update = "UPDATE student SET Suggestions = '$newsuggestions' WHERE Student_ID = '$id'";
			
			// update in database 
			$rs = mysqli_query($link, $update);

			if ($rs) {
				header("Refresh:0");
			}
		}
		?>
</div>
<?php include "footer.html" ?>
</body>

</html>