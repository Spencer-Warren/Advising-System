<?php
// Create default header
$title = "351 Project || Meeting Setup";
include "advisor_header.php";

// Office query used for meeting creation
$officeQuery = "SELECT Office FROM advisor WHERE Advisor_ID = '" . $id . "';";
$officeResult = mysqli_query($link, $officeQuery);
$loc = mysqli_fetch_assoc($officeResult);

// Meeting set query before request query to ensure request query has fresh data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['meeting_authorize'])) {
        // Iterate through meetings to be set
        foreach ($_POST['meeting_authorize'] as $meetingID => $status) {
            // Check for if the meeting was accepted or denied and update table
            if ($status == 'accept') {
                $authorizeQuery = "UPDATE advising_meeting SET Status='Set' WHERE ID = " . $meetingID . ";";
                $authorizeResult = mysqli_query($link, $authorizeQuery);
            }
            else if ($status == 'deny') {
                $authorizeQuery = "UPDATE advising_meeting SET Status='Open', Student_ID = NULL WHERE ID = " . $meetingID . ";";
                $authorizeResult = mysqli_query($link, $authorizeQuery);
            }
        }
        // Mark for proper response later in file
        if ($authorizeResult) {
            $updateCheck = TRUE;
        }
        else {
            $updateCheck = FALSE;
        }
    }
    // Check for meeting creation form submission
    if (isset($_POST['meeting_create'])) {
        // Set initial start date
        $meetings = $_POST['meeting_create'];
        $prep = date_create_from_format("Y-m-d\TH:i", $meetings['start']);
        $format = date_format($prep, "Y-m-d H:i:s");
        $start = new DateTime($format);

        // Check for number of meetings
        if ($meetings['num_meetings'] > 1) {
            $total_meetings = $meetings['num_meetings'];
            // For loop that creates proper number of meetings
            for ($num_meetings; $num_meetings < $total_meetings; $num_meetings++) {
                $minutesToAdd = $meetings['length'];
                $prepAdd = date_interval_create_from_date_string("$minutesToAdd minutes");
                date_add($start, $prepAdd);
                $createQuery = "INSERT INTO advising_meeting (Advisor_ID, DateTime, Location, Status) VALUES('$id', CONVERT_TZ('" . date_format($start, 'Y-m-d H:i:s') . "', 'US/Eastern', 'UTC'), '" . $meetings['location'] . "', 'Open')";
                $createResult = mysqli_query($link, $createQuery);
            }
        }
        // Check if entry left empty, default 1
        else if ($meetings['num_meetings'] === "" || $meetings['num_meetings'] == 1) {
            $total_meetings = 1;
            $createQuery = "INSERT INTO advising_meeting (Advisor_ID, DateTime, Location, Status) VALUES('$id', CONVERT_TZ('" . date_format($start, 'Y-m-d H:i:s') . "', 'US/Eastern', 'UTC'), '" . $meetings['location'] . "', 'Open')";
            $createResult = mysqli_query($link, $createQuery);
        }

        // Mark for response later in file
        if ($createResult) {
            $createCheck = TRUE;
        }
        else {
            $createCheck = FALSE;
        }
    }
    // Remove meetings
    if (isset($_POST['meeting_edit'])) {
        $removed_meetings = 0;
        foreach ($_POST['meeting_edit'] as $meetingID) {
            $removeQuery = "DELETE FROM advising_meeting WHERE ID = $meetingID";
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
}

// Setup query for displaying students that have requested a meeting
$requestQuery = 'SELECT ID, First_Name, Last_Name, CONVERT_TZ(DateTime, "UTC", "US/Eastern") AS DateTime, Location FROM student a, advising_meeting b WHERE a.Student_ID = b.Student_ID AND Status = "Request" AND Advisor_ID = "' . $id . '" ORDER BY DateTime DESC;';

// Store previous query result in variable
$requestResult = mysqli_query($link, $requestQuery);

// Beginning of requested meetings form
echo "<fieldset>";
echo "<legend><h1>Requested Meetings:</h1></legend>";

// Evaluate result variable
// Connection successful but empty return
if (mysqli_num_rows($requestResult) === 0) {
    echo "<center>No students have requested a meeting</center>";
}
// Connection failed/query failed
else if ($requestResult === false) {
    echo "Error connecting to database, please contact an administrator";
}
else {
    // Form for accepting/denying
    echo "<form class='paddingbottom' action='" . htmlspecialchars($_SESSION["PHP_SELF"]) ."' method='post'>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Student Name</th>";
    echo "<th>Date</th>";
    echo "<th>Time</th>";
    echo "<th>Location</th>";
    echo "<th>Accept</th>";
    echo "<th>Deny</th>";
    echo "</tr>";
    // Create table with radio buttons for accepting and denying meeting requests
    while ($requests = mysqli_fetch_assoc($requestResult)) {
        $prepTime = new DateTime($requests['DateTime']);
        $explodedtime = explode(" ", date_format($prepTime, "m-d g:iA"));
        $date = $explodedtime[0];
        $time = $explodedtime[1];
        echo "<tr>";
		echo "<td>" . $requests['First_Name'] . " " . $requests['Last_Name'] . "</td>";
        echo "<td>" . $date . "</td>";
        echo "<td>" . $time . "</td>";
        echo "<td>" . $requests['Location'] . "</td>";
        echo "<td class='radio_size'><input type='radio' name='meeting_authorize[" . $requests['ID'] . "]' value='accept'>";
        echo "<td class='radio_size'><input type='radio' name='meeting_authorize[" . $requests['ID'] . "]' value='deny'>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<button class='centeredbutton' type='submit'>Submit Changes</button>";
    echo "</form>";
}
echo "<br>";
// Check if meeting request was successful and display proper response
if ($updateCheck === TRUE) {
    echo "<center>Meetings successfully updated</center>";
    echo "<br>";
}
else if ($updateCheck === FALSE){
    echo "<center>Meetings were not successfully set. Try again</center>";
    echo "<br>";
}
echo "</fieldset>";

echo "<br>";

// Meeting creation section
echo "<fieldset>";
echo "<legend><h1>Create Meetings:</h1></legend>";
echo "<center><form class='paddingbottom' action='". htmlspecialchars($_SESSION["PHP_SELF"]) . "' method='post'>";
    
    // Request meeting date and time
    echo "<label for='meeting_create[start]'>Meeting start time and date:</label>";
    echo "<input type='datetime-local' name='meeting_create[start]' required>";

    // Request whether online or in office
    echo "<label for='meeting_create[location]'>Location:</label>";
    echo "<select name='meeting_create[location]' class='meeting_location' required>";
        echo "<option value='" . $loc['Office'] . "'>" . $loc['Office'] . "</option>";
        echo "<option value='ONL'>Online</option>";
    echo "</select>";

    // Request meeting length
    echo "<label for='meeting_create[length]'>Meeting length:</label>";
    echo "<input type='number' name='meeting_create[length]' min='1' max='30' placeholder='Minutes' required>";

    // Optional number of meetings, allows batch creation
    echo "<label for='meeting_create[num_meetings]'>Number of meetings:</label>";
    echo "<input type='number' name='meeting_create[num_meetings]' min='1' max='15' placeholder='Optional'>";
    echo "<button class='centeredbutton' type='submit'>Create Meetings</button>";

    echo "<br>";

// Check if meetings were created and display appropriate response
if ($createCheck === TRUE) {
    if ($total_meetings > 1){
    echo "<center>Meetings successfully created</center>";
    echo "<br>";
    }
    else if ($total_meetings == 1) {
        echo "<center>Meeting successfully created</center>";
        echo "<br>";
    }
}
else if ($createCheck === FALSE) {
    echo "<center>Meetings were not successfully created. Try again</center>";
    echo "<br>";
}
echo "</form></center>";
echo "</fieldset>";

echo "<br>";

// Meeting editing
echo "<fieldset>";
echo "<legend><h1>Edit Meetings:</h1></legend>";
$edit_meeting_query = "SELECT ID, CONVERT_TZ(DateTime, 'UTC', 'US/Eastern') AS DateTime, Location FROM advising_meeting WHERE Advisor_ID = $id AND Student_ID IS NULL AND DateTime > Now() ORDER BY DateTime ASC;";
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
    echo "<th>Remove</th>";
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
        echo "<td><input type='checkbox' class='radio_size' name='meeting_edit[]' value='" . $edit['ID'] . "'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<button class='centeredbutton' type='submit'>Remove Meetings</button>";
    echo "</form>";
}
// Check if meetings were removed and display appropriate response
if ($removeCheck === TRUE) {
    if ($removed_meetings > 1){
    echo "<center>Meetings successfully removed</center>";
    echo "<br>";
    }
    else if ($removed_meetings == 1) {
        echo "<center>Meeting successfully removed</center>";
        echo "<br>";
    }
}
else if ($removedCheck === FALSE) {
    echo "<center>Meetings were not successfully removed. Try again</center>";
    echo "<br>";
}
echo "</fieldset>";
include "footer.html";
?>
</body>

</html>