<?php
// initiate default student header
$title = "351 Project || Class Information";
include "chair_header.php";

	$classQuery1 = "SELECT CRN, Course, Days, Time, Instructor, Open_Seats, Semester FROM class";
    // query database and store result in variable
    $classResult1 = mysqli_query($link, $classQuery1);
    $new = TRUE;
	$classtype = array();
?>
<html>
<body class="centered">
<h1> Please Select a class area below:</h1>
<form class = "paddingbottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<select name="selectclasstype" class="centeredbutton">

		<?php while($classInfo = mysqli_fetch_assoc($classResult1)):;?>
		
		<?php   
				$explodedcourse = explode(" ", $classInfo["Course"]);
				$Course = $explodedcourse[0];
				array_push($classtype, $Course);
				
		?>
	
	  <?php endwhile;?>
	  <?php
	  $uniqueclasstype = array_unique($classtype);
	  foreach($uniqueclasstype as $key=>$value){
		  echo "<option>";
			  echo $value;
		  echo "</option>";
	  }
	  ?>
	  
		</select>
	<button class="centeredbutton" type="submit">Select Class Type</button>
</form>
</div>
	<?php if($_SERVER["REQUEST_METHOD"] == "POST"){
		$classtype = $_POST["selectclasstype"];
		$_SESSION["buttondefault"];
		// establish query for all classes
    $classQuery = "SELECT CRN, Course, Days, Time, Instructor, Open_Seats, Semester FROM class WHERE Course LIKE '%$classtype%'";
    // query database and store result in variable
    $classResult = mysqli_query($link, $classQuery);
    // create table and overarching table headers
	 echo "<table>";
            echo "<tr>";
                echo "<td>CRN</td>";
                echo "<td>Course</td>";
                echo "<td>Days</td>";
                echo "<td>Time</td>";
                echo "<td>Instructor</td>";
				echo "<td>Open_Seats</td>";
				echo "<td>Semester</td>";
            echo "</tr>";
                while ($classInfo = mysqli_fetch_assoc($classResult)) {?>
                  <tr>
					<td><?php echo $classInfo['CRN'];?></td>
					<td><?php echo $classInfo['Course'];?></td>
                    <td><?php echo $classInfo['Days'];?></td>
                    <td><?php echo $classInfo['Time'];?></td>
                    <td><?php echo $classInfo['Instructor'];?></td>
                    <td><?php echo $classInfo['Open_Seats'];?></td>
				    <td><?php echo $classInfo['Semester'];?></td>
                   </tr>
                  <?php } ?>
				</table>
				<?php
		
	}
?>