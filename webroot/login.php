<?php
'git pull';
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$Student_ID = $password = "";
$Student_ID_err = $password_err = $login_err = "";

$Advisor_ID = $password = "";
$Advisor_ID_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
$id = $_POST["id"];



							$query = "SELECT First_Name, Last_Name, EmailAddress, Role FROM student WHERE Student_ID = $id";
								if ($result = mysqli_query($link, $query)) {
									while ($row = mysqli_fetch_row($result)) {
										$_SESSION["First_Name"] = $row[0];
										$_SESSION["Last_Name"] = $row[1];
										$_SESSION["EmailAddress"] = $row[2];
										$_SESSION["Role"] = $row[3];
										$_SESSION["Student_ID"] = $id;
									}
								}

							
							$query = "SELECT First_Name, Last_Name, EmailAddress, Role, IsChair FROM advisor WHERE Advisor_ID = $id";
								if ($result = mysqli_query($link, $query)) {
									while ($row = mysqli_fetch_row($result)) {
										$_SESSION["First_Name"] = $row[0];
										$_SESSION["Last_Name"] = $row[1];
										$_SESSION["EmailAddress"] = $row[2];
										$_SESSION["Role"] = $row[3];
										$_SESSION["Advisor_ID"] = $id;
										$_SESSION["IsChair"] = $row[4];
									}
								}

							
	
 if ($_SESSION["Role"] == "student") {
	 $Student_IDpost = $id;
    // Check if cnuid is empty
    if(empty(trim($Student_IDpost))){
        $Student_ID_err = "Please enter Student ID.";
    } else{
        $Student_ID = trim($Student_IDpost);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["Password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["Password"]);
    }
    
    // Validate credentials
    if(empty($Student_ID_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT Student_ID, password FROM student WHERE Student_ID = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $Student_ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if cnuid exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $Student_ID, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["Student_ID"] = $Student_ID;
							$_SESSION["Role"] = "student";
							
                            
                            // Redirect user to welcome page
                            header("location: student/student_index.php");
							die();
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = " Invalid Student ID or Password.";
                        }
                    }
                } else{
                    // cnuid doesn't exist, display a generic error message
                    $login_err = "Invalid Student ID or Password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
 }
 if ($_SESSION["Role"] == "advisor") {
	 $Advisor_IDpost = $id;
    // Check if cnuid is empty
    if(empty(trim($Advisor_IDpost))){
        $Advisor_ID_err = "Please enter Advisor ID.";
    } else{
        $Advisor_ID = trim($Advisor_IDpost);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["Password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["Password"]);
    }
    
    // Validate credentials
    if(empty($Advisor_ID_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT Advisor_ID, password FROM advisor WHERE Advisor_ID = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $Advisor_ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if cnuid exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $Advisor_ID, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["Advisor_ID"] = $Advisor_ID;
							$_SESSION["Role"] = "advisor";
							
                            
                            // Redirect user to welcome page
							if ($_SESSION["IsChair"]) {
								header("location: chair/chair_index.php");
							}
							if (!($_SESSION["IsChair"])) {
								header("location: advisor/advisor_index.php");
							}
							die();
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid Advisor ID or Password.";
                        }
                    }
                } else{
                    // cnuid doesn't exist, display a generic error message
                    $login_err = "Invalid Advisor ID or Password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
 }
    //christian was here
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="backgroundimage" style="background-image:url('images/newporthall.jpeg')">
        <div class="wrapper" style="background-color: #ffffff;" >
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>

            <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger" id="alert-danger" align=center>' . $login_err . '</div>';	
            }        
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    			<div class="form-group">
                    <label>ID</label>
                    <input type="text" name="id" class="form-control">
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <p id='fixp'>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            </form>
        </div>
    </div>
</body>
</html>