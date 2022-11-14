<?php
$id = $_SESSION["Advisor_ID"];
$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION["Last_Name"];
//$advisorid = $_SESSION["advisorid"];

$title = "351 Project || Assign Advisor";
include "chair_header.php"
?>

<body class="centered">
	<h1> Select a Student to Assign an Advisor to:</h1>
	<form class="paddingbottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<select name="selectstudent" class="centeredbutton">
			<?php
			$studentQuery = "SELECT First_Name, Last_Name, Student_ID FROM student WHERE Student_ID NOT IN (SELECT Student_ID FROM advising_table)";
			$studentResult = mysqli_query($link, $studentQuery);
			while ($row2 = mysqli_fetch_assoc($studentResult)) :;
				echo "<option>";
				echo $row2["First_Name"] . " " . $row2["Last_Name"] . " (" . $row2["Student_ID"] . ")";
				echo "</option>";
			endwhile;
			?>
		</select>
		<select name="selectadvisor" class="centeredbutton">
			<?php
			$advisorQuery = "SELECT First_Name, Last_Name, Advisor_ID, Role FROM advisor WHERE Role != 'unverifiedadvisor'";
			$advisorResult = mysqli_query($link, $advisorQuery);
			while ($advisor = mysqli_fetch_assoc($advisorResult)) :;
				echo "<option>";
				echo $advisor["First_Name"] . " " . $advisor["Last_Name"] . " (" . $advisor["Advisor_ID"] . ")";
				echo "</option>";
				
			endwhile;
			?>
		</select>
		<div class="paddinglastbutton">
			<button class="centeredbutton" type="submit">Assign Selected Student to Selected Advisor</button>
		</div>
	</form>
	<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$studentInfo = explode(" ", $_POST["selectstudent"]);
		$S_First_Name = $studentInfo[0];
		$S_Last_Name = $studentInfo[1];
		$sID = trim($studentInfo[2], '()');
		$advisorInfo = $_POST["selectadvisor"];
		$advisorInfo = explode(" ", $_POST["selectadvisor"]);
		$A_First_Name = $advisorInfo[0];
		$A_Last_Name = $advisorInfo[1];
		$aID = trim($advisorInfo[2], '()');
		// Assign Advisor Selected to the Student Selected 
		$assignQuery = "INSERT INTO advising_table (Advisor_ID, Student_ID) Values('" . $aID . "', '" . $sID . "')";
		$assignResult = mysqli_query($link, $assignQuery);
		if ($assignResult) {
		echo "Student: $S_First_Name $S_Last_Name $sID has been assigned to Advisor: $A_First_Name $A_Last_Name $aID<br>";
		//echo $assignQuery;
		} else {
			echo "Error. Contact System Admin.";
		}
	}
	?>

</body>
</html>