<?php
    require_once('libauth.php');
    require_once('PDO_dbconnect.php');
    require_once('functions.php');

    if(!isset($_POST['username']) || !isset($_POST['ddlid'])) {
        failed_msg("未指定用户名或ddlid");
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
        failed_msg("ddlid不存在");
    } else if($row_count == 1) {
        $row = $result->fetch(PDO::FETCH_NUM);
        $name = $row[0];
        if(strcmp($name, $username) != 0) {
            failed_msg("用户与ddlid不对应");
        } else {
            $sql = "UPDATE `ddl` SET `status`=-1 WHERE `ddlid`=:ddlid";
            $dbcp = $dbc->prepare($sql);
            $is_success = $dbcp->execute(array(':ddlid' => $ddlid));
            if(!$is_success) failed_dberr($dbcp);
            else {
                $retr = array(
                    'result' => 'success'
                );
                exit(json_encode($retr));
            }
        }
    } else {
        failed_msg("内部错误");
    }
?>