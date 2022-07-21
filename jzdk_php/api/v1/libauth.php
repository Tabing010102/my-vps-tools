<?php
    $authorized_keys = array(
        'cwm_bot_1' => 'xxx'
    );

    function do_auth($key) {
        global $authorized_keys;
        foreach($authorized_keys as $k=>$v)
            if($key == $v) return $k;
        return false;
    }

    /*if(empty($_POST)) {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }
    $jd = json_decode(file_get_contents('php://input'), true);
    if($jd==null || $jd==false) {
        header('HTTP/1.1 400 Bad Request');
        exit();
    }
    $result = do_auth($jd['auth_key']);
    if($result == false) {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }*/
    if($_POST['auth_key'] == "") {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }
    $result = do_auth($_POST['auth_key']);
    if($result == false) {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }
    $user = $result;
?>