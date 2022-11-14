<?php
$title = "351 Project || 4 Year Plan";
include "student_header.php";
$studentQuery = "SELECT Major, Minors, Year FROM student WHERE Student_ID = '$id'";
$studentResult = mysqli_query($link, $studentQuery);
if ($studentResult) {
	$resultMajorMinor = mysqli_fetch_assoc($studentResult);
}
$delim1 = ";";
$delim2 = ",";
$numQuery = "SELECT NumSem, NumClass FROM FourYearPlan WHERE Student_ID = '$id'";
$numResult = mysqli_fetch_assoc(mysqli_query($link, $numQuery));
$numOfSemesters = $numResult["NumSem"];
$classesPerSem = $numResult["NumClass"];

// make changes to database if post BEFORE loading classes so changes are shown.
if($_SERVER["REQUEST_METHOD"] == "POST") {
	

	foreach(range(1, $numOfSemesters) as $semNum){
		foreach(range(1, $classesPerSem) as $classNum) {
			$setslot = "sem@class,".$semNum.",".$classNum;
			if(isset($_POST[$setslot])){
				$_SESSION[$setslot] = $_POST[$setslot];
			}
		}
	}
	$updatestring = "";
	// Write classes to database
	foreach(range(1, $numOfSemesters) as $semNum){
		foreach(range(1, $classesPerSem) as $classNum) {
			// check & return which slot it should go into
			$setslot = "sem@class,".$semNum.",".$classNum;
			if(isset($_SESSION[$setslot]) && $_SESSION[$setslot] != null){
				// Format is 1,1,CPSC 150;1,2,CPSC 250;
				$updatestring.= $semNum. $delim2. $classNum . $delim2 . $_SESSION[$setslot] . $delim1;
			}
		}
	}
	// echo $updatestring;
	
	
	if(isset($_POST["params"])){
		$numOfSemesters = $_POST["params"][0];
		$classesPerSem = $_POST["params"][1];
	}
	$sqlupdatequery = "UPDATE FourYearPlan SET ClassArray = '$updatestring', NumSem = '$numOfSemesters', NumClass = '$classesPerSem' WHERE Student_ID = '$id'";
	$sqlupdateresult = mysqli_query($link, $sqlupdatequery);
}

echo "
<div id='border'>
	<main>
		<h1>Four Year Plan</h1>
		<p>Major(s):"; 
		$Major = $resultMajorMinor["Major"];
			if (isset($Major)) echo $Major;
			if (!isset($Major)) echo "N/A";
		echo "</p>";
		echo "<p>Minor(s):";
		$Minor = $resultMajorMinor["Minors"];
			if (isset($Minor)) echo $Minor;
			if (!isset($Minor)) echo "N/A";
			echo "</p>";
			echo"<br><br><br>";
			
			// Read classes from database
			$sqlquery = "SELECT ClassArray FROM FourYearPlan WHERE Student_ID = '$id'";
			$sqlresult = mysqli_query($link, $sqlquery);
			if ($sqlresult) {
				$resultFourYearPlan = mysqli_fetch_assoc($sqlresult);
				$FYPstring = $resultFourYearPlan["ClassArray"];
				$splitFYP = explode($delim1, $FYPstring);
				foreach($splitFYP as $savedClass){
					$classEx = explode($delim2, $savedClass);
					$setClass = "sem@class,".$classEx[0].",".$classEx[1];
					// echo "set: ".$setClass. " to: " . $classEx[2]. "<br>";
					$_SESSION[$setClass] = $classEx[2];
				}
			}
	?>
<div class="centeredbutton">
    <!-- Tells user what classes are in their array of avaliable classes to select for their four year plan -->
    <p>Current Class Selection Options:</p>
    <?php 
		if (isset($_SESSION['classselection'])) {
			foreach ($_SESSION['classselection'] as $fruits) echo $fruits . ", ";;
		}
	?>
</div>
<div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <form name="form" class="centeredbutton">
            <!-- Search box. -->
            <input type="text" class="search" placeholder="Enter Class to Add to Options" />
            <!-- Suggestions will be displayed in below div. -->
            <div class="display"></div>
            <button class="centeredbutton" type="submit">Submit</button>
        </form>
    </form>
</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <form name="form" class="centeredbutton">
        <button onclick="resetclass('clearme');resetclass('clearme');resetclass('clearme');resetclass('clearme')" class="centeredbutton" type="submit">Clear</button>
    </form>
</form>
    <h3 class="centeredbutton">After Adding all classes to options, proceed to creating schedule.</h2>
        <?php
			// Creating array of years
			$currentYear = $resultMajorMinor["Year"];
			$years = array();
			// -1 to account for 0 being the first semester
			foreach (range(0, $numOfSemesters - 1) as $num) {
				if ($num % 2 == 0) {
					$yearTemp = "Fall " . $currentYear;
					$currentYear++;
				} else $yearTemp = "Spring " . $currentYear;
				$years[$num] = $yearTemp;
				// echo "Year ".$num." is ".$yearTemp."\n";
			}
			echo "
			<form name='mainform' action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='POST'>
				<div class='fouryeartable'>
					";
					$count = 1;
					// Outer loop for each semester
					foreach ($years as $semNum => $year) :
						// for having two tables next to eachother
						if ($semNum % 2 == 0) echo "<table class = 'hiddentable'><tbody><tr class = 'hiddenrow'>";
						echo "<td class='hiddenitem'>";
						$totalHours = 0;
						echo "
						<table>
							<thead><th colspan = '2'>".$year."</th></thead>
							<tbody>
							<tr>
								<td>Class</td>
								<td>Credit Hours</td>
							</tr>";

							// Inner loop for each class input
							foreach(range(1, $classesPerSem) as $classNum) :
								echo "<tr><td>";
								$slot = "sem@class," . ($semNum + 1) . "," . $classNum;
								echo "<select name='" . $slot . "'class = 'fullselect'>";
								$isSet = isset($_SESSION[$slot]) && $_SESSION[$slot] != null;
								// add null value so no class is an option instead of it defaulting to a class(for later input) -->
								if ($isSet) {
									echo "<option>" . $_SESSION[$slot] . "</option>";
								} else {
									echo "<option>" . null . "</option>";
								}
								$temparray = array();
								//go through session variable and create options from avaliable class array
								foreach ($_SESSION['classselection'] as $class) {
									array_push($temparray, $class);
								}
								$uniquearray = array_unique($temparray);
								if ($isSet && ($key = array_search($_SESSION[$slot], $uniquearray)) !== false) {
									unset($uniquearray[$key]);
								}
								foreach ($uniquearray as $class) {
									echo "<option>";
									echo $class;
									echo "</option>";
								}
								// add a blank one at the bottom if we do have it set
								if ($isSet) {
									echo "<option>" . null . "</option>";
								}
								echo "</select>";
								echo "</td>
								<td>";
								// Fetch credit hours for course
								if ($isSet) {
									$hoursQuery = "SELECT Credit_Hours FROM course WHERE Course = '" . $_SESSION[$slot] . "'";
									$hoursResult = mysqli_query($link, $hoursQuery);
									$hours =  mysqli_fetch_array($hoursResult)[0];
									$totalHours += $hours;
									echo $hours;
								}
								echo "</td>
								</tr>";
							endforeach;
							echo "<tr>
								<td>Total Hours:</td>
								<td>".$totalHours."</td>
							</tr>
						</tbody>	
						</table>";
						// End surrounding table
						if ($semNum % 2 == 0) echo "</td>";
						else echo "</td></tr></tbody></table>";
						// Increase class + 1 to fix a bug
					endforeach;
					?>
        </div>
        <button class="centeredbutton" type="submit" value="Submit">Submit Edits</button>
</main>
</div>
</div>
</body>

</html>