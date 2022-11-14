<?php
$title = "351 Project || Student Info";
include "chair_header.php";
if(!isset($_SESSION['Student_ID'])) {
	header("Location: chair_select_current_advisee.php");
}
$studentQuery  = "SELECT * FROM student WHERE Student_ID = ".$_SESSION['Student_ID'];
$studentResult = mysqli_query($link, $studentQuery);
if($studentResult) $student = mysqli_fetch_assoc($studentResult);
if(!isset($student)) echo "Please select a student <a href='chair/chair_select_current_advisee.php>here</a>";
?>
<h1>Selected Student's Information</h1>
<table>
    <tr>
        <td>Name (First, Last)</td>
        <td><?php echo $student["First_Name"] . " " . $student["Last_Name"]; ?></td>
    </tr>
    <tr>
        <td>Student's ID</td>
        <td><?php echo $student["Student_ID"] ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td>
            <?php
            echo "<a href='mailto:".$student["EmailAddress"]."'>";
            echo $student["EmailAddress"]."</a>";
            ?>
        </td>
    </tr>
    
    <tr>
        <td>Major</td>
        <td><?php echo $student["Major"] ?></td>
    </tr>
    <tr>
        <td>Entrance Year</td>
        <td><?php echo $student["Year"] ?></td>
    </tr>
</table>
</body>
</html>