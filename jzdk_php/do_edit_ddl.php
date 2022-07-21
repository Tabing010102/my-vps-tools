<?php
    if(!isset($_POST['ddlid']) || !isset($_POST['deadline']) || !isset($_POST['status']) || !isset($_POST['completedparts']) || !isset($_POST['totalparts']) || !isset($_POST['description']) || !isset($_POST['priority'])) {
        require('header.php');
        echo "POST信息不可信<br>";
        require('footer.php');
        exit();
    }
    $ddlid = $_POST['ddlid'];
    $dl = $_POST['deadline'];
    $st = $_POST['status'];
    $cp = $_POST['completedparts'];
    $tp = $_POST['totalparts'];
    $de = $_POST['description'];
    $pr = $_POST['priority'];
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
        if(!$is_success) failed_dberr($dbcp);
        $result = &$dbcp;
        $row_count = $result->rowCount();
        if($row_count == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if($row['uid'] != $uid) {
                echo '您没有权限修改此记录<br>';
            } else {
                $sql = "UPDATE `ddl` SET `deadline`=:dl, `status`=:st, `completedparts`=:cp, `totalparts`=:tp, `description`=:de, `priority`=:pr, `lastupdate`=CURDATE() WHERE `ddlid`=$ddlid";
                $dbcp = $dbc->prepare($sql);
                $is_success = $dbcp->execute(array(
                    ':dl' => $dl,
                    ':st' => $st,
                    ':cp' => $cp,
                    ':tp' => $tp,
                    ':de' => $de,
                    ':pr' => $pr
                ));
                if(!$is_success) failed_dberr($dbcp);
            }
        } else if($row_count == 0) {
            echo '您无法修改不存在的DDL<br>';
        } else {
            echo '未知错误<br>';
        }
        echo '修改完成<br>';
        echo '<a href="./ddl.php">返回</a><br>';
    }
    require('footer.php');
?>