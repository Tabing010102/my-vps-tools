<?php
    require_once('libauth.php');
    require_once('PDO_dbconnect.php');
    require_once('functions.php');

    if(!isset($_POST['username'])) {
        $message = "未指定用户名";
        $retr = array(
            'result' => 'failed',
            'message' => $message
        );
        exit(json_encode($retr));
    }
    $username = $_POST['username'];
    if(isset($_POST['limit'])) $limit = (int)$_POST['limit'];
    else $limit = 5;

    $sql = "SELECT `ddl`.*, LEFT(`ddl`.`description`, 20) AS `description_20`, `user`.`name` FROM `ddl` JOIN `user` ON `user`.`uid`=`ddl`.`uid` WHERE `user`.`name`=:un AND `ddl`.`status`<0 AND `ddl`.`deadline`>=CURDATE()-$limit ORDER BY `ddl`.`priority` DESC, `ddl`.`deadline` DESC, `ddl`.`lastupdate` DESC, `ddl`.`ddlid` DESC";
    $dbcp = $dbc->prepare($sql);
    $is_success = $dbcp->execute(array(':un'=>$username));
    if(!$is_success) failed_dberr($dbcp);
    $result = &$dbcp;
    $row_count = $result->rowCount();
    $retr = array(
        'result' => 'success',
        'row_count' => $row_count,
        'detail' => array()
    );
    for($i = 0; $i < $row_count; $i++){
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $retr['detail'][$i] = array(
            'ddlid' => $row['ddlid'],
            'completed_parts' => $row['completedparts'],
            'total_parts' => $row['totalparts'],
            'progress' => "".round(($row['completedparts']/$row['totalparts'])*100)."%",
            'priority' => $row['priority'],
            'deadline' => $row['deadline'],
            'last_update' => $row['lastupdate'],
            //'description' => substr($row['description'], 0, 21)
            'description' => $row['description_20']
        );
    }
    exit(json_encode($retr));
?>