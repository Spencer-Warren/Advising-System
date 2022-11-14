<?php
$title = "351 Project || Search Notes";
include "chair_header.php";
?>
  <div class="box">
  <form id="notesForm" name="myForm" novalidate="" method="post" action="getnotes.php">
        <div>
            <div>
                <input name="first_name" id="first_name" type="text" placeholder="First Name" required="" data-validation-required-message="Enter Students First Name" />
            </div>
        </div>
        <div>
            <div>
                <input name="last_name" id="last_name" type="text" placeholder="Last Name" required="" data-validation-required-message="Enter Students Last Name" />
            </div>
        </div>
        <div>
            <div>
                <button type="submit" value="Submit">Submit</button>
            </div>
        </div>
    </form>
    </div>
</div>
</body>
</html>