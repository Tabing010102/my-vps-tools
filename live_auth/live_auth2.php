<?php

$saved_key = '?key=xxx';

$verifyData = file_get_contents("php://input");
$obj=json_decode($verifyData);

if($obj->action == "on_publish") {
    //$arr = parse_url($obj->param);
    //$arr_query = convertUrlQuery($arr['query']);
    $dd = $obj->param;
    if(strcmp($saved_key, $dd) == 0) echo "0";
    else echo "1";
} else echo "-1";
/*
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
*/
?>
