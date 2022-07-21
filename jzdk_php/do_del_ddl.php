<?php
    if(!isset($_POST['ddlid'])) {
        require('header.php');
        echo "POST信息不可信<br>";
        require('footer.php');
        exit();
    }
    $ddlid = $_POST['ddlid'];
    require_once('PDO_dbconnect.php');
    require_once('functions.php');
    require('header.php');
    $login_status = get_login_status();
    if($login_status != 1) {
        header('Location: ./login.php');
    } else {
        $uid = $_SESSION['uid'];
        $sql = "SELECT * FROM `ddl` WHERE `ddlid`=$ddlid";
        $dbcp = $dbc->prepare($sql);
        $is_success = $dbcp->execute();
        require_once('functions.php');
        $result = &$dbcp;
        $row_count = $result->rowCount();
        if($row_count == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if($row['uid'] != $uid) {
                echo '您没有权限删除此记录<br>';
            } else {
                $sql = "DELETE FROM `ddl` WHERE `ddlid`=$ddlid";
                $dbcp = $dbc->prepare($sql);
                $is_success = $dbcp->execute();
                require_once('functions.php');
            }
        } else if($row_count == 0) {
            echo '您无法删除不存在的DDL<br>';
        } else {
            echo '未知错误<br>';
        }
        echo '删除完成<br>';
        echo '<a href="./ddl.php">返回</a><br>';
    }
    require('footer.php');
?>