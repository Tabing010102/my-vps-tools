<?php
    require_once("PDO_dbconnect.php");
    require_once("site_info.php");

    $sqldata['email'] = $_POST['email'];
    $sqldata['pwd'] = $_POST['pwd'];
    $sqldata['pwd2'] = $_POST['pwd2'];
    $sqldata['username'] = $_POST['username'];
    $sqldata['identity'] = $_POST['identity'];
    $sqldata['description'] = $_POST['description'];
    $sqldata['gender'] = $_POST['gender'];

//JSON相关
    require_once("php_json_class.php");
    $e = new jj();
//JSON相关结束

    if($sqldata['email'] == "") {$e->callback = "邮箱不能为空。"; echo json_encode($e); exit;}
    if($sqldata['pwd'] == "") {$e->callback = "密码不能为空。"; echo json_encode($e); exit;}
    if($sqldata['username'] == "") {$e->callback = "用户名不能为空。"; echo json_encode($e); exit;}
    if($sqldata['gender'] == "") {$e->callback = "性别不能为空。"; echo json_encode($e); exit;}
    if($sqldata['identity'] == "") {$e->callback = "身份不能为空。"; echo json_encode($e); exit;}
    if($sqldata['description'] == "") {$e->callback = "个人描述不能为空。"; echo json_encode($e); exit;}

    //$sql = "SELECT `email` FROM `user` WHERE `email` = '$email'";
    $dbcp = $dbc->prepare("SELECT `email` FROM `user` WHERE `email` = :email");
    $is_success = $dbcp->execute(array(':email'=>$sqldata['email']));
    if(!$is_success) {
        $errorInfo = $dbcp->errorInfo();
        $e->callback = "数据库存取失败，错误信息：<br>$errorInfo[2]";
        echo json_encode($e);
        exit;
    }
    $result = &$dbcp;
    //print_r($dbc->errorInfo());
    $row_num = $result->rowCount();
    if($row_num > 0) $e->callback = "邮箱 {$sqldata['email']} 已被注册。<br>一个邮箱仅能注册一次。";
    else if($sqldata['pwd'] != $sqldata['pwd2']) $e->callback = "两次输入的密码不一致。";
    else {
        $sqldata['pwdhash'] = md5($sqldata['pwd']);
        //$sql = "INSERT INTO `user` (`email`, `username`, `pwdhash`, `identity`, `description`, `gender`, `signup_time`, `last_login_ip_hash`, `last_login_ua_hash`)
        //    VALUES ('$email', '$username', '$pwdhash', '$identity', '$description', '$gender', NOW(), '', '')";
        $dbcp = $dbc->prepare("INSERT INTO `user` (`email`, `username`, `pwdhash`, `identity`, `description`, `gender`, `signup_time`, `last_login_ip_hash`, `last_login_ua_hash`)
            VALUES (:email, :username, :pwdhash, :identity, :description, :gender, NOW(), '', '')");
        $is_success = $dbcp->execute(array(
            ':email' => $sqldata['email'],
            ':username' => $sqldata['username'],
            ':pwdhash' => $sqldata['pwdhash'],
            ':identity' => $sqldata['identity'],
            ':description' => $sqldata['description'],
            ':gender' => $sqldata['gender']
        ));
        if($is_success) {
            $e->jump = true;
            $e->url = "$web_url/signin";
            $jumptime = 3; $e->jumptime = $jumptime*1000;
            $e->callback = "注册成功。<br>将在 $jumptime 秒后自动跳转...";
        } else {
            $errorInfo = $dbcp->errorInfo();
            $e->callback = "数据库写入失败。<br>错误信息：<br>".$errorInfo[2];
        }
    }
    echo json_encode($e);
?>
