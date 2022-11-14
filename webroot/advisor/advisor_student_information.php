<?php
$title = "351 Project || Student Info";
include "advisor_header.php";

if(!isset($_SESSION["Student_ID"])) {
	header("location: advisor_select_current_advisee.php");
}

$studentQuery  = "SELECT First_Name, Last_Name, Student_ID, EmailAddress, Major, Minors, Year FROM student WHERE Student_ID = ".$_SESSION['Student_ID'];
$student = mysqli_fetch_assoc(mysqli_query($link, $studentQuery));
$Major = $student["Major"];
$Minors = $student["Minors"];
?>
</div>
<h1>Selected Student's Information</h1>
<table>
    <?php
    foreach ($student as $key => $value){
        echo "<tr>";
        if($key == "EmailAddress"){
            $value = "<a href='mailto:".$value."'>".$value."</a>";
        }
        echo "<td>".$key."</td>";
        echo "<td>".$value."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>