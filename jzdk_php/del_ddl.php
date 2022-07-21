<?php
    if(!isset($_GET['ddlid'])) { header('Location: ./ddl.php'); exit(); }
    $ddlid = $_GET['ddlid'];
    require_once('PDO_dbconnect.php');
    require_once('header.php');
    require_once('functions.php');
    if($login_status != 1) {
        header('Location: ./login.php');
    } else {
        $uid = $_SESSION['uid'];
        $sql = "SELECT * FROM `ddl` WHERE `ddlid`=$ddlid";
        $dbcp = $dbc->prepare($sql);
        $is_success = $dbcp->execute();
        if(!$is_success) failed_dberr($dbcp);
        $result = &$dbcp;
        $row_count = $result->rowCount();
        if($row_count == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if($row['uid'] != $uid) {
                echo '您没有权限删除此记录<br>';
            } else {
                //echo $row['status'];
                echo '<form action="./do_del_ddl.php" method="post">';
                echo "DDLID： <input type=\"text\" name=\"ddlid\" value=\"$ddlid\" readonly><br>";
                echo "最后期限： {$row['deadline']}<br>";
                echo "状态： ".getStatus($row['status'])."<br>";
                echo "已完成块： {$row['completedparts']}<br>";
                echo "总块： {$row['totalparts']}<br>";
                echo "优先级： {$row['priority']}<br>";
                echo "描述： {$row['description']}<br>";
                echo '<input type="submit" value="确认删除">';
                echo '</form><br>';
            }
        } else if($row_count == 0) {
            echo '您无法删除不存在的DDL<br>';
        } else {
            echo '未知错误<br>';
        }
        echo '<a href="./ddl.php">返回</a><br>';
    }
    require_once('footer.php');
?>