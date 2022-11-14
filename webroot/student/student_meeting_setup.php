<?php
// Create default header
$title = "351 Project || Meeting Signup";
include "student_header.php";

// Meeting cancellation first for up to date queries later
if (isset($_POST['meeting_edit'])) {
    $removed_meetings = 0;
    foreach ($_POST['meeting_edit'] as $meetingID) {
        $removeQuery = "UPDATE advising_meeting SET Student_ID = NULL, Status = 'Open' WHERE ID = $meetingID";
        $removeResult = mysqli_query($link, $removeQuery);
        $removed_meetings += 1;
    }
    // Mark for response later in file
    if ($removeResult) {
        $removeCheck = TRUE;
    }
    else {
        $removeCheck = FALSE;
    }
}

// Meeting request statement before advisor query to ensure advisor query has fresh data
if (isset($_POST['selectmeeting'])) {
    $meetingID = $_POST['selectmeeting'];
    $updateQuery = "UPDATE advising_meeting SET Status='Request', Student_ID='" . $_SESSION['Student_ID'] . "' WHERE ID=$meetingID";
    $updateResult = mysqli_query($link, $updateQuery);
    if ($updateResult) {
        $updateCheck = TRUE;
    }
    else {
        $updateCheck = FALSE;
    }
}

// Setup query for selecting an advisor to schedule a meeting with
$advisorQuery = 'SELECT Advisor_ID, First_Name, Last_Name FROM advisor WHERE Advisor_ID IN (SELECT DISTINCT(Advisor_ID) FROM advising_meeting WHERE Student_ID IS NULL AND DATE_SUB(DateTime, INTERVAL 1 HOUR) > NOW() ORDER BY DateTime ASC);';

// Store previous query result in variable
$advisorResult = mysqli_query($link, $advisorQuery);

// Beginning of form
echo "<fieldset>";
echo "<legend><h1>Schedule Meeting</h1></legend>";

// Evaluate result variable
// Connection successful but empty return
if (mysqli_num_rows($advisorResult) === 0) {
    echo "<center>No advisors have available meetings</center>";
}
// Connection failed/query failed
else if ($advisorResult === false) {
    echo "Error connecting to database, please contact an administrator";
}
// Connection successful and at least one advisor returned
else {
    // Form for selecting advisor
    echo "<form class='paddingbottom' action='" . htmlspecialchars($_SESSION["PHP_SELF"]) ."' method='post'>";
    echo "<center><label for='selectadvisor'><h3>Available Advisors:</h3></label></center>";
    echo "<select name='selectadvisor' class='centeredbutton'>";
    while ($advisors = mysqli_fetch_assoc($advisorResult)) {
		echo "<option value=" . $advisors["Advisor_ID"] . ">";
		echo $advisors["First_Name"] . " " . $advisors["Last_Name"];
		echo "</option>";
    }
    echo "</select>";
    echo "<button class='centeredbutton' type='submit'>Select Advisor</button>";
    echo "</form>";

    // Check for advisor select
    if (isset($_POST['selectadvisor'])) {
        // Query database using selected advisor for meeting
        $meetingQuery = "SELECT ID, CONVERT_TZ(DateTime, 'UTC', 'US/Eastern') AS DateTime, Location FROM advising_meeting WHERE Advisor_ID = " . $_POST["selectadvisor"] . " AND Student_ID IS NULL AND DATE_SUB(DateTime, INTERVAL 1 HOUR) > NOW() ORDER BY DateTime ASC;";
        $meetingResult = mysqli_query($link, $meetingQuery);

        // Display options for available meeting times
        echo "<form class='paddingbottom' action='" . htmlspecialchars(($_SESSION["PHP_SELF"])) . "' method='post'>";
        echo "<center><label for='selectmeeting'><h3>Available Meetings:</h3></label></center>";
        echo "<select name='selectmeeting' class='centeredbutton'>";
        while ($student_meetings = mysqli_fetch_assoc($meetingResult)) {
            $prepTime = new DateTime($student_meetings['DateTime']);
            $explodedTime = explode(" ", date_format($prepTime, "m-d g:iA"));
            $date = $explodedTime[0];
            $time = $explodedTime[1];
            echo "<option value='" . $student_meetings['ID'] . "'>";
            echo $date . " " . $time . " " . $student_meetings['Location'];
            echo "</option>";
        }
        echo "</select>";
        echo "<button class='centeredbutton' type='submit'>Request Meeting</button>";
        echo "</form>";
    }
}
echo "<br>";
// Check if meeting request was successful and display proper response
if ($updateCheck === TRUE) {
    echo "<center>Meeting successfully requested</center>";
}
else if ($updateCheck === FALSE){
    echo "<center>Meeting was not requested. Try again</center>";
}
echo "</fieldset>";

// Form allowing student to cancel meetings
echo "<fieldset>";
echo "<legend><h1>Cancel Meetings:</h1></legend>";
$edit_meeting_query = "SELECT ID, CONVERT_TZ(DateTime, 'UTC', 'US/Eastern') AS DateTime, Location, Status FROM advising_meeting WHERE Student_ID = '$id' AND DATE_SUB(DateTime, INTERVAL 1 HOUR) > CONVERT_TZ(Now(), 'UTC', 'US/Eastern') ORDER BY DateTime ASC;";
$edit_meeting_result = mysqli_query($link, $edit_meeting_query);

// edit_meeting_query successful but no data returned
if (mysqli_num_rows($edit_meeting_result) === 0) {
    echo "<center>No meetings available for edit.</center>";
}
// edit_meeting_query failed
else if ($edit_meeting_result === false) {
    echo "Error connecting to database, please contact an administrator.";
}
// edit_meeting_query successful and data returend
else {
    // Form for unset and unrequested meeting editing
    echo "<form class='paddingbottom' action='". htmlspecialchars($_SESSION["PHP_SELF"]) . "' method='post'>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Date</th>";
    echo "<th>Time</th>";
    echo "<th>Location</th>";
    echo "<th>Status</th>";
    echo "<th>Cancel</th>";
    echo "</tr>";

    // Populate table from query
    while ($edit = mysqli_fetch_assoc($edit_meeting_result)) {
        $editTime = new DateTime($edit['DateTime']);
        $editExploded = explode(" ", date_format($editTime, "m-d g:iA"));
        $editDate = $editExploded[0];
        $editTime = $editExploded[1];
        echo "<tr>";
        echo "<td>$editDate</td>";
        echo "<td>$editTime</td>";
        echo "<td>" . $edit['Location'] . "</td>";
        echo "<td>" . $edit['Status'] . "</td>";
        echo "<td><input type='checkbox' class='radio_size' name='meeting_edit[]' value='" . $edit['ID'] . "'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<button class='centeredbutton' type='submit'>Cancel Meetings</button>";
    echo "</form>";
}
    // Check if meetings were removed and display appropriate response
    if ($removeCheck === TRUE) {
        if ($removed_meetings > 1){
        echo "<center>Meetings successfully cancelled</center>";
        echo "<br>";
        }
        else if ($removed_meetings == 1) {
            echo "<center>Meeting successfully cancelled</center>";
            echo "<br>";
        }
    }
    else if ($removedCheck === FALSE) {
        echo "<center>Meetings were not successfully cancelled. Try again</center>";
        echo "<br>";
    }
echo "</fieldset>";
include "footer.html";
?>
</body>

</html>