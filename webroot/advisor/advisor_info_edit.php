<?php
$title = "351 Project || Edit My Information";
include "advisor_header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $setInfoQuery ="UPDATE advisor SET 
    First_Name = '".$_POST['First_Name']."',
    Last_Name = '".$_POST['Last_Name']."',
	EmailAddress = '".$_POST['Email']."',
    Department = '".$_POST['Department']."',
    Office = '".$_POST['Office']."',
    OfficeHours = '".$_POST['OfficeHours']."'
    WHERE Advisor_ID = '$id'";
    $editResult = mysqli_query($link, $setInfoQuery);
}

$query = "SELECT * FROM advisor WHERE Advisor_ID = '$id'";
$result = mysqli_query($link, $query);
$advisorinfo = mysqli_fetch_assoc($result);
?>
<div class="wrapper">
    <h1>Advisor Information</h1>
    <h2>Enter your Information:</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table style='font-size:25px'>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="First_Name" value="<?php echo $advisorinfo["First_Name"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="Last_Name" value="<?php echo $advisorinfo["Last_Name"]; ?>">
                </td>
            </tr>
			<tr>
                <td>CNUID</td>
                <td> <?php echo $advisorinfo["Advisor_ID"]; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="Email" value="<?php echo $advisorinfo["EmailAddress"];?>">
                </td>
            </tr>
			 <tr>
                <td>Chair</td>
                <td>
                    <?php if($advisorinfo["IsChair"] == 0){echo "False";} else{echo "True";} ?>
                </td>
            </tr>
			<tr>
                <td>Department</td>
                <td>
                    <input type="text" name="Department" value="<?php echo $advisorinfo["Department"];?>">
                </td>
            </tr>
            <tr>
                <td>Office Location</td>
                <td>
                    <input type="text" name="Office" value="<?php echo $advisorinfo["Office"];?>">
                </td>
            </tr>
            <tr>
                <td>Office Hours</td>
                <td>
                    <input type="text" name="OfficeHours" value="<?php echo $advisorinfo["OfficeHours"]; ?>">
                </td>
            </tr>

        </table>
		<?php if($editResult) echo"<p style='text-align: center;'>" . "Successfully updated your information";?><br>
        <button class = "centeredbutton" formaction="advisor_info.php">Back</button>
		<br>
        <button class = "centeredbutton" formaction="advisor_info_edit.php">Submit Changes</button>
    </form>
</div>