<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$Student_ID = $password = $confirm_password = "";
$Student_ID_err = $password_err = $confirm_password_err = "";

$Advisor_ID = $password = $confirm_password = "";
$Advisor_ID_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["advisorcheckbox"])) {
        $roletype = "advisor";
    } else {
        $roletype = "student";
    }

    // Validate username
    if ($roletype == "student") {
        $Student_ID = $_POST["id"];
        if (empty(trim($Student_ID))) {
            $Student_ID_err = "Please enter a Student ID.";
        } elseif (!preg_match('/^[0-9]*$/', trim($Student_ID))) {
            $Student_ID_err = "Student_ID can only contain numbers";
        } else {
            // Prepare a select statement
            $sql = "SELECT Student_ID FROM student WHERE Student_ID = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_Student_ID);

                // Set parameters
                $param_Student_ID = trim($Student_ID);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $Student_ID_err = "This Student ID is already taken.";
                    } else {
                        $Student_ID = trim($Student_ID);
                    }
                } else {
                    echo "YIKES! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }
        //assign fname,lname,email
        $First_Name = trim($_POST["First_Name"]);
        $Last_Name = trim($_POST["Last_Name"]);
        $EmailAddress = trim($_POST["EmailAddress"]);

        // Check input errors before inserting in database
        if (empty($Student_ID_err) && empty($password_err) && empty($confirm_password_err)) {
            // Prepare an insert statement
            $sql = "INSERT INTO student (Student_ID, password) VALUES (?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_Student_ID, $param_password);
                // Set parameters
                $param_Student_ID = $Student_ID;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Prepare an update statement
					$year = date("Y");
                    $update = "UPDATE student SET First_Name = '$First_Name', Last_Name = '$Last_Name', EmailAddress = '$EmailAddress', Year = '$year' WHERE Student_ID = '$Student_ID'";
                    // update in database 
                    mysqli_query($link, $update);
                    // Create FYP row
                    $fyp = "INSERT INTO FourYearPlan (Student_ID, NumSem, NumClass) VALUES ('$param_Student_ID', 8, 6)";
                    echo $fyp;
                    mysqli_query($link, $fyp);
                    // Redirect to login page
                    header("location: login.php");
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }
    // Validate username
    if ($roletype == "advisor") {
        $Advisor_ID = $_POST["id"];
        if (empty(trim($Advisor_ID))) {
            $Advisor_ID_err = "Please enter an Advisor ID.";
        } elseif (!preg_match('/^[0-9]*$/', trim($Advisor_ID))) {
            $Advisor_ID_err = "Advisor_ID can only contain numbers";
        } else {
            // Prepare a select statement
            $sql = "SELECT Advisor_ID FROM advisor WHERE Advisor_ID = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_Advisor_ID);

                // Set parameters
                $param_Advisor_ID = trim($Advisor_ID);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $Advisor_ID_err = "This Advisor ID is already taken.";
                    } else {
                        $Advisor_ID = trim($Advisor_ID);
                    }
                } else {
                    echo "YIKES! Something went wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }
        // Validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }
        //assign fname,lname,email
        $First_Name = trim($_POST["First_Name"]);
        $Last_Name = trim($_POST["Last_Name"]);
        $EmailAddress = trim($_POST["EmailAddress"]);

        // Check input errors before inserting in database
        if (empty($Advisor_ID_err) && empty($password_err) && empty($confirm_password_err)) {

            // Prepare an insert statement
            $sql = "INSERT INTO advisor (Advisor_ID, password) VALUES (?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_Advisor_ID, $param_password);
                // Set parameters
                $param_Advisor_ID = $Advisor_ID;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Prepare an update statement
                    $update = "UPDATE advisor SET First_Name = '$First_Name', Last_Name = '$Last_Name', EmailAddress = '$EmailAddress' WHERE Advisor_ID = '$Advisor_ID'";
                    // update in database 
                    mysqli_query($link, $update);
                    // Redirect to login page
                    header("location: login.php");
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body { font: 14px sans-serif;}
        .wrapper { width: 360px; padding: 20px; }
    </style>
</head>

<body>
    <div class="backgroundimage" style="background-image:url('images/newporthall.jpeg')">
        <div class="wrapper" style="background-color:#ffffff;">
            <h2 id="newaccount">Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>ID</label>
                    <input type="text" name="id" class="form-control">

                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="First_Name" class="form-control <?php echo (!empty($First_Name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $First_Name; ?>">
                    <span class="invalid-feedback"><?php echo $First_Name_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="Last_Name" class="form-control <?php echo (!empty($Last_Name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Last_Name; ?>">
                    <span class="invalid-feedback"><?php echo $Last_Name_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" name="EmailAddress" class="form-control <?php echo (!empty($EmailAddress_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $EmailAddress; ?>">
                    <span class="invalid-feedback"><?php echo $EmailAddress_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <br>
                <div>
                    <input type="checkbox" name = "advisorcheckbox" id="advisorcheckbox">
                    <label for="advisorcheckbox" id="advisorwords">Advisor Account</label>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <p id="accountalready">Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>
    </div>
</body>

</html>