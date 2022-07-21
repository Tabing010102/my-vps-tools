<?php
    function failed_msg($msg) {
        $retr = array(
            'result' => 'failed',
            'message' => $msg
        );
        exit(json_encode($retr));
    }

    function failed_dberr(&$dbcp) {
        $errorInfo = $dbcp->errorInfo();
        $msg = "数据库错误：$errorInfo[2]";
        $retr = array(
            'result' => 'failed',
            'message' => $msg
        );
        exit(json_encode($retr));
    }
?>