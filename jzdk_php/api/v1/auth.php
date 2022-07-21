<?php
    if(empty($_POST)) {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }
    $jd = json_decode(file_get_contents('php://input'), true);
    if($jd==null || $jd==false) {
        header('HTTP/1.1 400 Bad Request');
        exit();
    }

    $authorized_keys = array(
        'cwm_bot_1' => 'xxx'
    );

    function do_auth($key) {
        global $authorized_keys;
        foreach($authorized_keys as $k=>$v)
            if($key == $v) return $k;
        return false;
    }
    
    $result = do_auth($jd['auth_key']);
    if($result == false) {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }
    $retr = array(
        'result' => 'success',
        'message' => "Welcome $result to JZDK"
    );
    header('Content-Type:application/json; charset=utf-8');
    exit(json_encode($retr));
?>