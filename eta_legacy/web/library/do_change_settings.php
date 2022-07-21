<?php
    error_reporting(E_ALL || ~E_NOTICE);
    //临时解决方法
    require_once("PDO_dbconnect.php");
    require_once("cookie.php");
    require_once("php_json_class.php");
    require_once("site_info.php");
    $e = new jj();
    $login_status = get_login_status();
    if($login_status != 0) {
        $e->jump = true;
        $e->url = "$web_url/signin";
        $jumptime = 3; $e->jumptime = $jumptime*1000;
        $e->callback = "用户登录已失效，请重新登录。<br>将在 $jumptime 秒后自动跳转至登录。";
        echo json_encode($e);
        exit;
    }
    if($_POST['username'] != NULL) {//个人信息
        $sqldata['username'] = $_POST['username'];
        $sqldata['gender'] = $_POST['gender'];
        $sqldata['identity'] = $_POST['identity'];
        $sqldata['description'] = $_POST['description'];
        if($sqldata['username'] == "") {$e->callback = "用户名不能为空。"; echo json_encode($e); exit;}
        if($sqldata['gender'] == "") {$e->callback = "性别不能为空。"; echo json_encode($e); exit;}
        if($sqldata['identity'] == "") {$e->callback = "身份不能为空。"; echo json_encode($e); exit;}
        if($sqldata['description'] == "") {$e->callback = "个人描述不能为空。"; echo json_encode($e); exit;}
        //数据库相关
        $sqldata['uid'] = (int)$_COOKIE['uid'];
        //$sql = "UPDATE `user` SET `username`='$username',`gender`='$gender',`identity`='$identity',`description`='$description' WHERE `uid`='$uid'";
        $dbcp = $dbc->prepare("UPDATE `user` SET `username`=:username,`gender`=:gender,`identity`=:identity,`description`=:description WHERE `uid`=:uid");
        $is_success = $dbcp->execute(array(
            ':username' => $sqldata['username'],
            ':gender' => $sqldata['gender'],
            ':identity' => $sqldata['identity'],
            ':description' => $sqldata['description'],
            ':uid' => $sqldata['uid']
        ));
        if(!$is_success) {
            $errorInfo = $dbcp->errorInfo();
            $e->callback = "用户信息修改失败，错误信息：<br>$errorInfo[2]";
            echo json_encode($e);
            exit;
        }
        $e->callback = "用户信息修改成功。";
    } else {//修改密码
        $sqldata['pwdori'] = $_POST['pwdori'];
        $sqldata['pwd'] = $_POST['pwd'];
        $sqldata['pwd2'] = $_POST['pwd2'];
        if($sqldata['pwd'] != $sqldata['pwd2']) {$e->callback = "两次输入的密码不一致。"; echo json_encode($e); exit;}
        if($sqldata['pwdori'] == "") {$e->callback = "原密码不能为空。"; echo json_encode($e); exit;}
        if($sqldata['pwd'] == "") {$e->callback = "新密码不能为空。"; echo json_encode($e); exit;}
        //数据库相关
        $sqldata['uid'] = (int)$_COOKIE['uid'];
        //$sql = "SELECT `pwdhash` FROM `user` WHERE `uid`='$uid'";
        $dbcp = $dbc->prepare("SELECT `pwdhash` FROM `user` WHERE `uid`=:uid");
        $is_success = $dbcp->execute(array(':uid'=>$sqldata['uid']));
        if(!$is_success) {
            $errorInfo = $dbcp->errorInfo();
            $e->callback = "数据库存取失败，错误信息：<br>$errorInfo[2]";
            echo json_encode($e);
            exit;
        }
        $result = &$dbcp;
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if(md5($sqldata['pwdori']) != $row['pwdhash']) {$e->callback = "原密码验证失败。<br>输入的原密码与数据库中密码不一致。"; echo json_encode($e); exit;}
        $sqldata['pwd_md5'] = md5($sqldata['pwd']);
        //$sql = "UPDATE `user` SET `pwdhash`='$sqldata['pwd_md5']' WHERE `uid`='$sqldata['uid']'";
        $dbcp = $dbc->prepare("UPDATE `user` SET `pwdhash`=:pwd_md5 WHERE `uid`=:uid");
        $is_success = $dbcp->execute(array(
            ':pwd_md5' => $sqldata['pwd_md5'],
            ':uid' => $sqldata['uid']
        ));
        if(!$is_success) {
            $errorInfo = $dbcp->errorInfo();
            $e->callback = "密码修改失败，错误信息：<br>$errorInfo[2]";
            echo json_encode($e);
            exit;
        }
        $e->callback = "密码修改成功。";
        setcookie("pwdhash", $sqldata['pwd_md5'], time()+7200, "$web_url/");
    }
    echo json_encode($e);
?>
