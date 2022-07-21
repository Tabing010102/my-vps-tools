<?php
    require_once('PDO_dbconnect.php');
    require_once('functions.php');
    require_once('session.php');

    if(get_login_status() == 1) {
        //echo '已登录';
        header('Location: ./index.php');
        exit();
    }
    if(!isset($_POST['username']) || !isset($_POST['password'])) {
        echo 'POST信息错误';
        destroy_session();
        require('footer.php');
        exit();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];

    $sql = "SELECT `uid`, `name`, `pwd` FROM `user` WHERE `name`=:name";
    $dbcp = $dbc->prepare($sql);
    $ok = $dbcp->execute(array(':name'=>$username));
    if(!$ok) failed_dberr($dbcp);
    $row_count = $dbcp->rowCount();

    if($row_count == 0) {
        destroy_session();
        echo "用户名或密码错误";
    } else if($row_count == 1) {
        $row = $dbcp->fetch(PDO::FETCH_ASSOC);
        $uid = $row['uid'];
        destroy_session();
        if(md5($password) == $row['pwd']) {
            session_start();
            $_SESSION['uid'] = $uid;
            echo "登录成功";
            //echo isset($_SESSION['uid'])?1:0;
            header('Location: ./index.php');
        } else {
            echo "用户名或密码错误";
        }
    } else {
        destroy_session();
        echo "内部错误";
    }
    require('footer.php');
?>