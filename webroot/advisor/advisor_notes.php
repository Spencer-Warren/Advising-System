<?php
$title = "351 Project || Student Notes";
include "advisor_header.php";


$id = $_SESSION["Advisor_ID"];

//check if active advisee is set and if not, send to set it.
if(!isset($_SESSION["activeadvisee"])) {
	header("Location: advisor_select_current_advisee.php");
}


// make local variables of session variables						
$activeadvisee = $_SESSION["activeadvisee"];	
$Student_First_Name = $_SESSION["Student_First_Name"];
$Student_Last_Name = $_SESSION["Student_Last_Name"];
$Student_ID = $_SESSION["Student_ID"];
								
// grab details of students who i am the advisor of
$query2 = "SELECT Title, ID, TimeStamp, Note FROM note WHERE Student_ID = $Student_ID"; 
$result2 = mysqli_query($link, $query2);
?>
<body class="centered">
<h1> Select a Note for <?php echo $Student_First_Name . " " . $Student_Last_Name;?>:</h1>
<form class = "paddingbottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<select name="thisisnotes" class="centeredbutton">
		
		<?php while($row2 = mysqli_fetch_assoc($result2)):;?>
		
      <option><?php echo date('h:i a F d, Y', strtotime($row2["TimeStamp"])) . " (" . $Student_ID . ") " . "Title:" . $row2["Title"] . "ID:" . " " . $row2["ID"];?></option>
	  <?php endwhile;?>
	  
		</select>
	<button class="centeredbutton" type="submit">Select Note</button>
</form>
			
			<h1>Note shown:</h1>
                <textarea class="chunkybox" disabled="disabled" name="notes" rows="20" col = "15"><?php echo $_SESSION["Notes"];?></textarea>

<form action="advisor_add_notes.php">
<button class="centeredbutton" type="submit">Add Note</button>
</form>
<form action= "advisor_edit_notes.php">
<button class="centeredbutton" type="submit">Edit Note</button>
</form>
			<div>
			<?php echo "<br>";?>
			</div>
</div>
	<?php if($_SERVER["REQUEST_METHOD"] == "POST"){
		// break apart timestamp + student id + note id
		$string = explode(" ", $_POST['thisisnotes']);
		// grab the note id from form submit
		$IDOFNote = end($string);
		// make session variable of note id
		$_SESSION["IDOFNote"] = $IDOFNote;
		
				// grab the information of the note that matches the requested note (by id)
				$query = "SELECT Note FROM note WHERE ID = $IDOFNote"; 
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_assoc($result);
				//store the note as session variable to display after refresh
				$_SESSION["Notes"] = $row["Note"];
				//refresh page to display note
				header("Refresh:0");
								
		
	}
	?>
</body>
</html>