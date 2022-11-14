<?php
$title = "351 Project || Reassign Advisor";
include "chair_header.php";
?>

<body class="centered">
	<h1> Select a Student to Reassign an Advisor to:</h1>
	<form class="paddingbottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<select name="selectstudent" class="centeredbutton">
			<?php // Select all students that have a row in the advising table
			$studentQuery = "SELECT Student_ID, First_Name, Last_Name FROM student WHERE Student_ID IN (SELECT Student_ID FROM advising_table WHERE Advisor_ID IS NOT NULL)";
			$studentResult = mysqli_query($link, $studentQuery);
			while ($row2 = mysqli_fetch_assoc($studentResult)) :;
				echo "<option>";
				echo $row2["First_Name"] . " " . $row2["Last_Name"] . " (" . $row2["Student_ID"] . ")";
				echo "</option>";
			endwhile;
			?>
		</select>

		<form class="paddingbottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<select name="selectadvisor" class="centeredbutton">
				<?php // Select all advisors
				$advisorQuery = "SELECT First_Name, Last_Name, Advisor_ID FROM advisor WHERE Role != 'unverifiedadvisor'";
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
	</form>
	<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Clean and assign Variables
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
		$reassignQuery = "UPDATE advising_table SET Advisor_ID = '$aID' WHERE Student_ID = '$sID'";
		$reassignResult = mysqli_query($link, $reassignQuery);
		if ($reassignResult) {
			echo "Student: $S_First_Name $S_Last_Name $sID has been assigned to Advisor: $A_First_Name $A_Last_Name $aID<br>";
			echo "<br>";
		} else {
			echo "Error. Contact System Admin.";
		}
	}
	?>
	</div>
</body>

</html>