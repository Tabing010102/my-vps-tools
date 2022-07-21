<?php
    require_once('PDO_dbconnect.php');
    require_once('session.php');
    require_once('functions.php');
    $login_status = get_login_status();
    if($login_status != 1) {
        echo '用户： 未登录<br>';
        echo '<a href="./login.php">登录</a><br><br>';
    } else {
        $uid = $_SESSION['uid'];
        $sql = "SELECT `name` FROM `user` WHERE `uid`=:uid";
        $dbcp = $dbc->prepare($sql);
        $ok = $dbcp->execute(array(':uid'=>$_SESSION['uid']));
        if(!$ok) failed_dberr($dbcp);
        $row = $dbcp->fetch(PDO::FETCH_ASSOC);
        $username = $row['name'];
        echo "用户： $username [$uid]<br>";
        echo '<a href="./do_logout.php">登出</a><br><br>';
    }
?>