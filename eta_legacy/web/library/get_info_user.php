<?php
    require_once("PDO_dbconnect.php");
    require_once("site_info.php");
    if($_GET['uid'] == NULL) {
        if($login_status == 0) { header("Location: $web_url/user/?uid={$_COOKIE['uid']}"); exit; }
        else { header("Location: $web_url/signin"); exit; }
    }
    require_once("get_user_ismyself.php");
    $is_myself = get_user_ismyself();
    $uid = (int)$_GET['uid'];
    //$sql = "SELECT `username`,`description` FROM `user` WHERE `uid`='$uid'";
    $dbcp = $dbc->prepare("SELECT `username`,`description`,`identity` FROM `user` WHERE `uid`=:uid");
    $is_success = $dbcp->execute(array(':uid'=>$uid));
    if(!is_success) {
        $errorInfo = $dbcp->errorInfo();
        echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
        exit;
    }
    $result = $dbcp;
    $row_num = $result->rowCount();
    if($row_num == 1) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $user_name = $row['username'];
        $user_description = $row['description'];
        $user_identity_in_header = $row['identity'];
    } else if($row_num == 0) {
        $user_name = "用户不存在";
        $user_description = "用户id为 $uid 的用户不存在。";
        $user_identity_in_header = "用户id为 $uid 的用户不存在。";
    } else {
        $user_name = "系统错误";
        $user_description = "系统错误。";
        $user_identity_in_header = "系统错误。";
    }
?>
