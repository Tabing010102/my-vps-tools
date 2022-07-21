<?php
    require_once('session.php');
    require('header.php');
    $login_status = get_login_status();
    if($login_status == 1) {
        echo "已登录";
        header('Location: ./index.php');
        exit();
    }
?>
<form action="./do_login.php" method="post">
用户名：<input type="text" name="username"> <br>
密码：<input type="password" name="password"> <br>
<input type="submit" value="登录"><br>
</form>
<?php require('footer.php'); ?>