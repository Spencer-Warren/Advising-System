<?php
$title = "351 Project || Advisor Notes";
include "student_header.php";
$advisorQuery = "SELECT First_Name, Last_Name, EmailAddress, Department, Office, OfficeHours FROM advisor WHERE Advisor_ID IN (SELECT Advisor_ID FROM advising_table WHERE Student_ID = '$id')";
// echo $advisorQuery;
$advisorResult = mysqli_query($link, $advisorQuery);
if($advisorResult) $advisor = mysqli_fetch_assoc($advisorResult);
?>
<div class="wrapper">
    <h1>Advisor Information</h1>
    <table style='font-size:25px'>
        <tr>
            <td>Name (First, Last)</td>
            <td><?php if(isset($advisor["First_Name"]) && isset($advisor["Last_Name"])){echo $advisor["First_Name"] . " " . $advisor["Last_Name"];} else {echo "N/A";}?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <?php if(isset($advisor["EmailAddress"])){
                echo "<a href='mailto:".$advisor["EmailAddress"]."'>";
                echo $advisor["EmailAddress"]."</a>";}
				else{ echo "N/A";}
                ?>
            </td>
        </tr>
        <tr>
            <td>Office Location</td>
            <td><?php if(isset($advisor["Office"])){echo $advisor["Office"];} else{echo "N/A";}?></td>
        </tr>
        <tr>
            <td>Department</td>
            <td><?php if(isset($advisor["Department"])){echo $advisor["Department"];} else{echo "N/A";}?></td>
        </tr>
        <tr>
            <td>Office Hours</td>
            <td><?php if(isset($advisor["OfficeHours"])){ echo $advisor["OfficeHours"];} else{echo "N/A";}?></td>
        </tr>
    </table>
</div>