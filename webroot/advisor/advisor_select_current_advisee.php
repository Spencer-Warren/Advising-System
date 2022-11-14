<?php
$title = "351 Project || Select Advisee";
include "advisor_header.php";

// grab details of students who i am the advisor of
$query2 = "SELECT Student_ID FROM advising_table WHERE Advisor_ID = $id";
$result2 = mysqli_query($link, $query2);
?>

<body class="centered">
	<h1> Please Select a student as "Active Advisee" from the List of your advisees below:</h1>
	<form class="paddingbottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<select name="activeadviseeform" class="centeredbutton">

			<?php while ($row2 = mysqli_fetch_assoc($result2)) :; ?>

				<?php
				// grab student id and get first and last name of those students
				$sID = $row2["Student_ID"];
				$query3 = "SELECT First_Name, Last_Name FROM student WHERE Student_ID = $sID";
				$result3 = mysqli_query($link, $query3);
				if ($result3 = mysqli_query($link, $query3)) {
					while ($row3 = mysqli_fetch_row($result3)) {
						$S_First_Name = $row3[0];
						$S_Last_Name = $row3[1];
					}
				}
				?>

				<option><?php echo $S_First_Name . " " . $S_Last_Name . " (" . $row2["Student_ID"] . ")"; ?></option>
			<?php endwhile; ?>

		</select>
		<button class="centeredbutton" type="submit">Select Student</button>
	</form>
	</div>
	<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// grab first + last + (id)
		$activeadvisee = $_POST['activeadviseeform'];
		//set first + last + (id) for later use
		$_SESSION['activeadvisee'] = $activeadvisee;
		// tell user who they have selected
		printf("Active Advisee Selected: %s", $activeadvisee);
		// break the first + last + (id) into seperate variables and save them for later use
		$string = explode(" ", $_POST['activeadviseeform']);
		$_SESSION["Student_First_Name"] = $string[0];
		$_SESSION["Student_Last_Name"] = $string[1];
		$_SESSION["Student_ID"] = $string[2];
		$_SESSION["Student_ID"] = trim($_SESSION["Student_ID"], '()');
	}
	?>
</body>

</html>