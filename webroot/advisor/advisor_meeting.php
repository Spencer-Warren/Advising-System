<?php
// Call default advisor header
$title = "351 Project || Advisor Meeting";
include "advisor_header.php";

// Establish and run default query for any meetings of current user
$meetingQuery = 'SELECT First_Name, Last_Name, CONVERT_TZ(DateTime, "UTC", "US/Eastern") AS DateTime, Location FROM advising_meeting a, student b WHERE Status="Set" AND a.Student_ID = b.Student_ID AND Advisor_ID = "' . $id . '" AND DateTime > CONVERT_TZ(NOW(), "UTC", "US/Eastern") ORDER BY DateTime DESC;';
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
    echo "<th>Student Name</th>";
    echo "<th>Date</th>";
    echo "<th>Time</th>";
    echo "<th>Location</th>";
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
        echo "</tr>";
    }
    echo "</table>";
}
echo "<br>";

// Give option to see meeting requests/setup meeting slots
echo "<center><a href='advisor_meeting_setup.php'>Schedule meetings</a></center>";
echo "</fieldset>";
include "footer.html";
?>
</body>
</html>