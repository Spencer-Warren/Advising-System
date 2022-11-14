<?php
$title = "351 Project || Edit Notes";
include "chair_header.php";

//check that advisor has selected a student advise
if(!isset($_SESSION["activeadvisee"])){
    header("location: chair_select_current_advisee.php");
    exit;
}					

$IDOFNote = $_SESSION["IDOFNote"];
?>
<h1> Edit Note for <?php echo $Student_First_Name . " " . $Student_Last_Name;?>:</h1>
<form class = "paddingbottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<p class="centeredbutton">Enter Title</p>
			<textarea class="centeredbutton" name="Title" rows="1" col = "1"><?php echo $_SESSION["Title"];?></textarea>
			<br>
			<div>
                <textarea class="chunkybox" name="notes" rows="20" col = "15"><?php echo $_SESSION["Notes"];?></textarea>
            </div>
			 <div>
			<?php echo "<br>";?>
			</div>
			<button class="centeredbutton" type="submit">Finish Editting Note</button>
</form>
<form action="chair_delete_notes.php">
<button class="centeredbutton" type="submit">Delete Note</button>
</form>
</div>
	<?php if($_SERVER["REQUEST_METHOD"] == "POST"){
		// grab the edited notes
		$newnotes = $_POST["notes"];
		// check if title was changed, if it was update it.
		if(isset($_POST["Title"])) {
			$Title = $_POST["Title"];
			$updatetitlequery = "UPDATE note SET Title = '$Title' WHERE ID = '$IDOFNote'";
			$updatetitleresult = mysqli_query($link, $updatetitlequery);
			$_SESSION["Title"] = $Title;
		}
		
		// update the note in note table
		$query = "UPDATE note SET Note = '$newnotes' WHERE ID = '$IDOFNote'";
		$result = mysqli_query($link, $query);
				//select the updated note and make it a session variable for later
				$query2 = "SELECT Note FROM note WHERE ID = $IDOFNote"; 
				$result2 = mysqli_query($link, $query2);
				$row2 = mysqli_fetch_assoc($result2);
				$_SESSION["Notes"] = $row2["Note"];
				
		// redirect back to main notes page
		header("location: chair_notes.php");
		die();
	}
	?>
    </div>
</div>
</body>
</html>