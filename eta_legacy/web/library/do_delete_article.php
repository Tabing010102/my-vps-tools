<?php
    require_once("PDO_dbconnect.php");
    require_once("cookie.php");
    require_once("php_json_class.php");
    require_once("site_info.php");
    $e = new jj();
    $login_status = get_login_status();
    $did = (int)$_POST['did'];
    if($login_status != 0) {
        $e->callback = "登录失效，请重新登录。";
        $jumptime = 1.5; $e->jumptime = $jumptime*1000;
        $e->jump = true; $e->url = "$web_url/discuss/?$did";
        echo json_encode($e);
        exit;
    }
    $uid_cnt = (int)$_COOKIE['uid'];
    $dbcp1 = $dbc->prepare("SELECT `aid`,`author_uid` FROM `article` WHERE `parent_did`=$did");
    $dbcp2 = $dbc->prepare("DELETE FROM `article` WHERE `aid`=:aid");
    $is_success = $dbcp1->execute();
    if(!$is_success) {
        $errorInfo = $dbcp1->errorInfo();
        $e->callback = "数据库存取失败，错误信息：<br>$errorInfo[2]";
        echo json_encode($e);
        exit;
    }
    $row = $dbcp1->fetch(PDO::FETCH_ASSOC);
    $author_uid = $row['author_uid'];
    $aid = $row['aid'];
    if($uid_cnt != $author_uid) {
        $e->callback = "不是本人，无法进行本操作。";
        echo json_encode($e);
        exit;
    }
    $is_success = $dbcp2->execute(array(':aid'=>$aid));
    if(!$is_success) {
        $errorInfo = $dbcp2->errorInfo();
        $e->callback = "数据库存取失败，错误信息：<br>$errorInfo[2]";
        echo json_encode($e);
        exit;
    }
    $e->callback = "删除成功。";
    $jumptime = 2; $e->jumptime = $jumptime*1000;
    $e->jump = true; $e->url = "$web_url/discuss/?$did";
    echo json_encode($e);
?>
