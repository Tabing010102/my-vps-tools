<?php
    require_once('libauth.php');
    require_once('PDO_dbconnect.php');
    require_once('functions.php');
    if(!isset($_POST['name']) || !isset($_POST['deadline']) || !isset($_POST['totalparts']) || !isset($_POST['description']) || !isset($_POST['priority'])) {
        $retr = array(
            'result' => 'failed',
            'message' => '数据不完整'
        );
        exit(json_encode($retr));
    }
    $name = $_POST['name'];
    $dl = $_POST['deadline'];
    $pr = $_POST['priority'];
    $de = $_POST['description'];
    $tp = $_POST['totalparts'];

    $sql = "SELECT `uid` FROM `user` WHERE `name`=:name";
    $dbcp = $dbc->prepare($sql);
    $is_success = $dbcp->execute(array(':name'=>$name));
    if(!$is_success) failed_dberr($dbcp);
    $result = &$dbcp;
    $row_count = $result->rowCount();
    if($row_count == 0) {
        $retr = array(
            'result' => 'failed',
            'message' => '用户不存在'
        );
        exit(json_encode($retr));
    } else if($row_count == 1) {
        $row = $result->fetch(PDO::FETCH_NUM);
        $uid = $row[0];
        $sql = "INSERT INTO `ddl`(`uid`, `deadline`, `totalparts`, `description`, `priority`) VALUES($uid, :dl, :tp, :de, :pr)";
        $dbcp = $dbc->prepare($sql);
        $is_success = $dbcp->execute(array(
            ':dl' => $dl,
            ':tp' => $tp,
            ':de' => $de,
            ':pr' => $pr
        ));
        if(!$is_success) failed_dberr($dbcp);
        else {
            $retr = array(
                'result' => 'success'
            );
            exit(json_encode($retr));
        }
    } else {
        $retr = array(
            'result' => 'failed',
            'message' => '内部错误'
        );
        exit(json_encode($retr));
    }
?>