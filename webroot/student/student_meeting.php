<?php
$title = "351 Project || Advisor Meetings";
// Call default header
include "student_header.php";

// Establish and run default query for any meetings of current user
$meetingQuery = 'SELECT First_Name, Last_Name, CONVERT_TZ(DateTime, "UTC", "US/Eastern") AS DateTime, Location, Status FROM advising_meeting a, advisor b WHERE Student_ID = "'.$_SESSION["Student_ID"].'" AND a.Advisor_ID = b.Advisor_ID AND DateTime > CONVERT_TZ(Now(), "UTC", "US/Eastern") ORDER BY DateTime DESC;';
// echo $date_default_timezone_get();
$meetingResult = mysqli_query($link, $meetingQuery);

// Prep meeting display
echo "<fieldset>";
echo "<legend><h1>Scheduled Meetings:</h1></legend>";

// Check for results
if (mysqli_num_rows($meetingResult) === 0) {
    echo "<center>No meetings have been scheduled yet</center>";
}
else if ($meetingResult === false) {
    echo "Error connecting to database, please contact an administrator";
}
else {
    // Create table headers
    echo "<table>";
    echo "<tr>";
    echo "<th>Advisor Name</th>";
    echo "<th>Date</th>";
    echo "<th>Time</th>";
    echo "<th>Location</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    // Fill table rows with query data
    while ($meeting = mysqli_fetch_assoc($meetingResult)) {
        $prepTime = new DateTime($meeting['DateTime']);
        $explodedtime = explode(" ", date_format($prepTime, "m-d g:iA"));
        $date = $explodedtime[0];
        $time = $explodedtime[1];
        echo "<tr>";
        echo "<td>" . $meeting["First_Name"] . " " . $meeting["Last_Name"] . "</td>";
        echo "<td>" . $date . "</td>";
        echo "<td>" . $time . "</td>";
        echo "<td>" . $meeting["Location"] . "</td>";
        if ($meeting['Status'] == "Request") {
            echo "<td>Requested</td>";
        }
        else {
            echo "<td>" . $meeting['Status'] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
echo "<br>";

// Give option for schedule meeting page
echo "<center><a href='student_meeting_setup.php'>Schedule a meeting</a></center>";
echo "</fieldset>";
include "footer.html";
?>