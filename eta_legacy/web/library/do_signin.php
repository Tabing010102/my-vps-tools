<?php
    require_once("PDO_dbconnect.php");
    require_once("site_info.php");
    //JSON相关
    require_once("php_json_class.php");
    $e = new jj();
    //JSON相关结束
    $email = $_POST['email']; $pwd = $_POST['pwd'];
    if($email == "") { $e->callback = "用户名不能为空。"; echo json_encode($e); exit; }
    if($pwd == "") { $e->callback = "密码不能为空。"; echo json_encode($e); exit; }
    $pwdhash = md5($pwd);
    //$sql = "SELECT `pwdhash`,`uid` FROM `user` WHERE `email` = '$email'";
    $dbcp = $dbc->prepare("SELECT `pwdhash`,`uid` FROM `user` WHERE `email` = :email");
    $is_success = $dbcp->execute(array(':email'=>$email));
    if(!$is_success) {
        $errorInfo = $dbcp->errorInfo();
        $e->callback = "数据库存取失败，错误信息：<br>$errorInfo[2]";
        echo json_encode($e);
        exit;
    }
    $result = &$dbcp;
    $row_num = $result->rowCount();

    if($row_num < 1) {
        $e->callback = "用户不存在。";
    } else if($row_num > 1) {
        $e->callback = "系统错误：重复的邮箱。<br>请与网站管理员联系。";
    } else {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $db_pwdhash = $row['pwdhash'];
        if($pwdhash != $db_pwdhash) {
            $e->callback = "密码错误。";
        } else {
            $e->jump = true;
            $e->url = "$web_url/";
            $jumptime = 0.5; $e->jumptime = $jumptime*1000;
            $e->callback = "登录成功。";

            //数据库相关
            (bool)$err_status = false;
            $sqldata['uid'] = $row['uid'];
            $sqldata['ip'] = $_SERVER['REMOTE_ADDR'];
            $sqldata['ua'] = $_SERVER['HTTP_USER_AGENT'];
            $sqldata['ip_hash'] = md5($sqldata['ip']);
            $sqldata['ua_hash'] = md5($sqldata['ua']);
            //$sql = "INSERT INTO `login` (`uid`, `ua`, `ip`, `time`) VALUES ('$uid', '$ua', '$ip', NOW())";
            $dbcp = $dbc->prepare("INSERT INTO `login` (`uid`, `ua`, `ip`, `time`) VALUES (:uid, :ua, :ip, NOW())");
            $is_success = $dbcp->execute(array(
                ':uid' => $sqldata['uid'],
                ':ua' => $sqldata['ua'],
                ':ip' => $sqldata['ip']
            ));
            if(!$is_success) {
                $errorInfo = $dbc->errorInfo();
                $e->callback = "登录记录写入失败，错误信息：<br>$errorInfo[2]";
                echo json_encode($e);
                exit;
            }
            //$sql = "UPDATE `user` SET `last_login_time`=NOW(), `last_login_ip_hash`='".md5($ip)."', `last_login_ua_hash`='".md5($ua)."' WHERE `uid`=$uid";
            $dbcp = $dbc->prepare("UPDATE `user` SET `last_login_time`=NOW(), `last_login_ip_hash`=:ip_hash, `last_login_ua_hash`=:ua_hash WHERE `uid`=:uid");
            $is_success = $dbcp->execute(array(
                ':uid' => $sqldata['uid'],
                ':ua_hash' => $sqldata['ua_hash'],
                ':ip_hash' => $sqldata['ip_hash']
            ));
            if(!$is_success) {
                $errorInfo = $dbc->errorInfo();
                $e->callback = "登录记录写入失败，错误信息：<br>$errorInfo[2]";
                echo json_encode($e);
                exit;
            }

            //COOKIE相关
            setcookie("uid", $sqldata['uid'], time()+7200, "$web_url/");
            setcookie("pwdhash", $db_pwdhash, time()+7200, "$web_url/");
            setcookie("iphash", md5($sqldata['ip']), time()+7200, "$web_url/");
            setcookie("uahash", md5($sqldata['ua']), time()+7200, "$web_url/");
        }
    }
    echo json_encode($e);
?>
