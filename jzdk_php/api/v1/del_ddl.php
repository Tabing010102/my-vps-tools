<?php
    require_once('libauth.php');
    require_once('PDO_dbconnect.php');
    require_once('functions.php');

    if(!isset($_POST['username']) || !isset($_POST['ddlid'])) {
        $message = "未指定用户名或ddlid";
        $retr = array(
            'result' => 'failed',
            'message' => $message
        );
        exit(json_encode($retr));
    }
    $username = $_POST['username'];
    $ddlid = (int)$_POST['ddlid'];

    $sql = "SELECT `user`.`name` FROM `ddl` JOIN `user` ON `user`.`uid`=`ddl`.`uid` WHERE `ddl`.`ddlid`=:ddlid";
    $dbcp = $dbc->prepare($sql);
    $is_success = $dbcp->execute(array(':ddlid'=>$ddlid));
    if(!$is_success) failed_dberr($dbcp);
    $result = &$dbcp;
    $row_count = $result->rowCount();
    if($row_count == 0) {
        $message = "ddlid不存在";
        $retr = array(
            'result' => 'failed',
            'message' => $message
        );
        exit(json_encode($retr));
    } else if($row_count == 1) {
        $row = $result->fetch(PDO::FETCH_NUM);
        $name = $row[0];
        if(strcmp($name, $username) != 0) {
            $message = "用户与ddlid不对应";
            $retr = array(
                'result' => 'failed',
                'message' => $message
            );
            exit(json_encode($retr));
        } else {
            $sql = "DELETE FROM `ddl` WHERE `ddlid`=:ddlid";
            $dbcp = $dbc->prepare($sql);
            $is_success = $dbcp->execute(array(':ddlid'=>$ddlid));
            if(!$is_success) failed_dberr($dbcp);
            else {
                $retr = array(
                    'result' => 'success'
                );
                exit(json_encode($retr));
            }
        }
    } else {
        $message = "内部错误";
        $retr = array(
            'result' => 'failed',
            'message' => $message
        );
        exit(json_encode($retr));
    }
?>