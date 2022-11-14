<?php
$title = "351 Project || My Information";
include "chair_header.php";
$advisorQuery = "SELECT First_Name, Last_Name, EmailAddress, Department, Office, OfficeHours FROM advisor WHERE Advisor_ID = '$id'";
// echo $advisorQuery;
$advisorResult = mysqli_query($link, $advisorQuery);
if($advisorResult) $advisor = mysqli_fetch_assoc($advisorResult);
?>
</div>
<div class="wrapper">
    <h1>Advisor Information</h1>
    <table style='font-size:25px'>
        <tr>
            <td>Name (First, Last)</td>
            <td><?php echo $advisor["First_Name"] . " " . $advisor["Last_Name"]; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <?php
                echo "<a href='mailto:".$advisor["EmailAddress"]."'>";
                echo $advisor["EmailAddress"]."</a>";
                ?>
            </td>
        </tr>
        <tr>
            <td>Office Location</td>
            <td><?php echo $advisor["Office"]?></td>
        </tr>
        <tr>
            <td>Department</td>
            <td><?php echo $advisor["Department"]?></td>
        </tr>
        <tr>
            <td>Office Hours</td>
            <td><?php echo $advisor["OfficeHours"]?></td>
        </tr>
    </table>
	<form action="chair_info_edit.php">
		<button class="centeredbutton" type="submit">Edit Information</button>
	</form>
</div>