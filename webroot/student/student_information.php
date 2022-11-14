<?php
$title = "351 Project || My Information";
include "student_header.php";

$query = "SELECT * FROM student WHERE Student_ID = $id";
$result = mysqli_query($link, $query);
$studentinfo = mysqli_fetch_assoc($result);

$First_Name = $studentinfo["First_Name"];
$Last_Name = $studentinfo["Last_Name"];
$ID = $studentinfo["Student_ID"];
$EmailAddress = $studentinfo["EmailAddress"];
$Major = $studentinfo["Major"];
$Minors = $studentinfo["Minors"];
$Entry_Year = $studentinfo["Year"];
?>
<div class="wrapper">
    <h1>Student Information</h1>
    <table style='font-size:25px'>
        <tr>
            <td>First Name</td>
            <td><?php echo $First_Name; ?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><?php echo $Last_Name; ?></td>
        </tr>
        <tr>
            <td>CNU ID</td>
            <td><?php echo $ID; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <?php
                echo "<a href='mailto:".$EmailAddress."'>";
                echo $EmailAddress."</a>";
                ?>
            </td>
        </tr>
        <tr>
            <td>Major(s)</td>
            <td><?php echo $Major; if($Major === null) {echo "N/A";}?></td>
        </tr>
        <tr>
            <td>Minor(s)</td>
            <td><?php echo $Minors; if($Minors === null) {echo "N/A";}?></td>
        </tr>
        <tr>
            <td>Entrance Year</td>
            <td><?php echo $Entry_Year; ?></td>
        </tr>

    </table>
    <form>
        <button class = "centeredbutton" formaction="student_information_edit.php">Edit your Information</button>
    </form>
</div>