<?php
//echo shell_exec('git pull');
//echo $result;
echo exec('whoami');
echo "<br>";
exec('git pull 2>&1', $output);
print_r($output);  // to see the response to your command
//echo exec("id -a && ls");
?>
