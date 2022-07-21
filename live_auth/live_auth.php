<?php

$key = $_POST['key'];
//$key = $_GET['key'];

$saved_key = 'xxx';

if(empty($key)) {
	echo "Invalid key!";
	header('HTTP/1.0 403 Forbidden');
} else {
	if(strcmp($saved_key, $key) == 0) {
		echo "Valid key.";
                header('HTTP/1.0 200 OK');
	} else {
		echo "Invalid key!";
		header('HTTP/1.0 403 Forbidden');
	}
}

?>
