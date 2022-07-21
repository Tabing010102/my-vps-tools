<?php
    echo "Changing Directory...";
    (bool)$is_success = chdir('/home/wwwroot/eta_legacy');
    //echo "<br>Current Dir:" . getcwd() ."<br>";
    if($is_success) echo "Success.<br>";
    else { echo "Failed.<br>"; exit; }
    echo "Updating...<br>";
    echo "Output(lastline):<br>";
    system("git pull", $retval);
    echo "<br>";
    echo "Command exit with return value:" . $retval . ".<br>";
    exit;
?>
