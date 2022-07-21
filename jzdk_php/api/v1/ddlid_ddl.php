<?php
    require_once('libauth.php');
    require_once('PDO_dbconnect.php');
    require_once('functions.php');

    if(!isset($_POST['ddlid'])) {
        $message = "未指定ddlid";
        $retr = array(
            'result' => 'failed',
            'message' => $message
        );
        exit(json_encode($retr));
    }
    $ddlid = $_POST['ddlid'];

    $sql = "SELECT `ddl`.*, `user`.`name` FROM `ddl` JOIN `user` ON `user`.`uid`=`ddl`.`uid` WHERE `ddl`.`ddlid`=:ddild";
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
        $retr = array(
            'result' => 'success',
            'row_count' => $row_count,
            'detail' => array()
        );
        for($i = 0; $i < $row_count; $i++){
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $retr['detail'][$i] = array(
                'ddlid' => $row['ddlid'],
                'name' => $row['name'],
                'completed_parts' => $row['completedparts'],
                'total_parts' => $row['totalparts'],
                'progress' => "".round(($row['completedparts']/$row['totalparts'])*100)."%",
                'priority' => $row['priority'],
                'deadline' => $row['deadline'],
                'last_update' => $row['lastupdate'],
                'description' => $row['description']
            );
        }
        exit(json_encode($retr));
    } else {
        $message = "内部错误";
        $retr = array(
            'result' => 'failed',
            'message' => $message
        );
        exit(json_encode($retr));
    }
?>