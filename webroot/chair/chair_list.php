<?php
$title = "351 Project || List Students";
include "chair_header.php";
?>
    <div id="border">
    <main>
    <h1>Current Advisees:</h1>
        <table>
            <?php
            $colms = array("Student_ID", "First_Name", "Last_Name", "EmailAddress", "Major");
            $query="SELECT ".implode(',', $colms)." FROM student WHERE Student_ID IN (SELECT Student_ID FROM advising_table WHERE Advisor_ID = '$id')";
            $result = mysqli_query($link, $query);
            echo "<tr>";
            $colmNames = array("ID", "First Name", "Last Name", "Email", "Major");
            foreach($colmNames as $value){
                echo "<td>$value</td>";   
            }
            echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            foreach($row as $key => $value){
                echo "<td>$value</td>";
            }
            echo "</tr>";
		}
        ?>
        </table>
    </main>
</div>
</div>
</body>
</html>