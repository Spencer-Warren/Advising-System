<?php
$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION["Last_Name"];
$id = $_SESSION["Advisor_ID"];

$title = "351 Project || Verify Advisors";
include "chair_header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Assign given advisor's information to variables
	// and check if not defualt option (to eliminate a bug)
	if (isset($_POST["selectunverified"]) && $_POST["selectunverified"] != "Select an Advisor...") {
		$explodedunverifiedinfo = (explode(" ", $_POST["selectunverified"]));
		//echo "assigning to: " . $_POST["selectunverified"];
		$_SESSION["UnverifiedID"] = trim($explodedunverifiedinfo[2], '()');
		$_SESSION["selectunverified"] = $_POST["selectunverified"];
	}
	if (isset($_POST["accept"])) {
		// If accept is chosen set role to advisor and clear variables
		$acceptQuery = "UPDATE advisor SET Role = 'advisor' WHERE Advisor_ID = '" . $_SESSION["UnverifiedID"] . "'";
		$accpetResult = mysqli_query($link, $acceptQuery);
		// echo $acceptQuery;
		if ($accpetResult) {
			$accepted = TRUE;
			$_SESSION["advisoracct"] = $_SESSION["selectunverified"];
		} else {
			echo "Error. Contact System Admin.";
		}
		$_SESSION["UnverifiedID"] = null;
		$_SESSION["selectunverified"] = null;
	}

	if (isset($_POST["deny"])) {
		// If deny is chosen clear row and variables
		$rejectQuery = "DELETE FROM advisor WHERE Advisor_ID = '" . $_SESSION["UnverifiedID"] . "'";
		// echo $rejectQuery;
		$rejectResult = mysqli_query($link, $rejectQuery);
		if ($rejectResult) {
			$accepted = FALSE;
			$_SESSION["advisoracct"] = $_SESSION["selectunverified"];
		} else {
			echo "Error. Contact System Admin.";
		}
		$_SESSION["UnverifiedID"] = null;
		$_SESSION["selectunverified"] = null;
	}
}
?>

<body class="centered">
	<h1> Accept/Deny Unverified Advisors:</h1>
	<form class="paddingbottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<select name="selectunverified" class="centeredbutton">
			<option>Select an Advisor...</option>
			<?php
			// display and let user choose an unverified advisor
			$unverQuery = "SELECT First_Name, Last_Name, Advisor_ID FROM advisor WHERE Role = 'unverifiedadvisor'";
			$unverResult = mysqli_query($link, $unverQuery);
			while ($advisor = mysqli_fetch_assoc($unverResult)) :
				echo "<option>";
				echo $advisor["First_Name"] . " " . $advisor["Last_Name"] . " (" . $advisor["Advisor_ID"] . ")";
				echo "</option>";
			endwhile;
			?>
		</select>
		<div class="paddingtop">
			<button class="centeredbutton" type="submit">Select Account</button>
		</div>
		<div>
		<h1><?php 
		if(isset($_POST["selectunverified"]) && $_POST["selectunverified"] != "Select an Advisor..."){echo "Selected Account: " . $_POST["selectunverified"];}
		if(isset($accepted) && $accepted == FALSE && $_SESSION["advisoracct"] != NULL){ echo "Advisor Account: " . $_SESSION["advisoracct"] . " has been Rejected and Deleted<br>"; $accepted = NULL; $_SESSION["advisoracct"] = NULL;}
		if(isset($accepted) && $accepted == TRUE && $_SESSION["advisoracct"] != NULL){ echo "Advisor Account: " . $_SESSION["advisoracct"] . " has been Accepted<br>"; $accepted = NULL; $_SESSION["advisoracct"] = NULL;}?></h1>
		<button name="accept" class="buttonaccept" type="submit">Accept Selected Account: <?php echo $_SESSION["selectunverified"]; ?></button>
		<button name="deny" class="buttondeny" type="submit">Deny Selected Account: <?php echo $_SESSION["selectunverified"]; ?></button>
	</form>
	</div>
</body>
</body>

</html>