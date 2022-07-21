<?php
    require_once('libauth.php');
    require_once('PDO_dbconnect.php');
    require_once('functions.php');

    $sql = "SELECT `ddl`.*, LEFT(`ddl`.`description`, 20) AS `description_20`, `user`.`name` FROM `ddl` JOIN `user` ON `user`.`uid`=`ddl`.`uid` WHERE `ddl`.`status`<=0 AND `ddl`.`deadline`=CURDATE()-1 ORDER BY `ddl`.`priority` DESC, `ddl`.`uid`, `ddl`.`ddlid` DESC";
    $dbcp = $dbc->prepare($sql);
    $is_success = $dbcp->execute();
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
            'name' => $row['name'],
            'completed_parts' => $row['completedparts'],
            'total_parts' => $row['totalparts'],
            'progress' => "".round(($row['completedparts']/$row['totalparts'])*100)."%",
            'status' => $row['status'],
            'priority' => $row['priority'],
            //'description' => substr($row['description'], 0, 21)
            'description' => $row['description_20']
        );
    }
    exit(json_encode($retr));
?>