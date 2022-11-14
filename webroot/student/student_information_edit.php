<?php
$title = "351 Project || Edit My Information";
include "student_header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $setInfoQuery ="UPDATE student SET 
    First_Name = '".$_POST['First_Name']."',
    Last_Name = '".$_POST['Last_Name']."',
    EmailAddress = '".$_POST['Email']."',
    Major = '".$_POST['Major']."',
    Minors = '".$_POST['Minors']."',
    Year = ".$_POST['Year']."
    WHERE Student_ID = '$id'";
    $editResult = mysqli_query($link, $setInfoQuery);
}

$query = "SELECT * FROM student WHERE Student_ID = $id";
$result = mysqli_query($link, $query);
$studentinfo = mysqli_fetch_assoc($result);
?>
<div class="wrapper">
    <h1>Student Information</h1>
    <h2>Enter your Information:</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table style='font-size:25px'>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="First_Name" value="<?php echo $studentinfo["First_Name"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="Last_Name" value="<?php echo $studentinfo["Last_Name"]; ?>">
                </td>
            </tr>
            <tr>
                <td>CNU ID</td>
                <td><?php echo $studentinfo["Student_ID"]; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="Email" value="<?php echo $studentinfo["EmailAddress"];?>">
                </td>
            </tr>
            <tr>
                <td>Major(s)</td>
                <td>
                    <input type="text" name="Major" value="<?php echo $studentinfo["Major"];?>">
                </td>
            </tr>
            <tr>
                <td>Minor(s)</td>
                <td>
                    <input type="text" name="Minors" value="<?php echo  $studentinfo["Minors"];?>">
                </td>
            </tr>
            <tr>
                <td>Entrance Year</td>
                <td>
                    <input type="text" name="Year" value="<?php echo $studentinfo["Year"]; ?>">
                </td>
            </tr>

        </table>
        <p class = "centeredbutton" >If your student ID is incorrect, please contact the administrator</p>
        <?php if($editResult) echo"<p style='text-align: center;'>" . "Successfully updated your information";?><br>
        <button class = "centeredbutton" formaction="student_information.php">Back</button>
		<br>
        <button class = "centeredbutton" formaction="student_information_edit.php">Submit Changes</button>
    </form>
</div>