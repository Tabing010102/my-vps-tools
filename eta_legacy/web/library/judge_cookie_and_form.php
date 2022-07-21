<?php
    require_once("PDO_dbconnect.php");
    require_once("cookie.php");
    require_once("site_info.php");
    $login_status = get_login_status();
    if($login_status == 0) {
        //顶部
        $page_navlist = array(
            "发起讨论" => "$web_url/create",
            "通知" => "$web_url/user",
            "我" => "$web_url/user",
        );
    } else {
        $page_navlist = array(
            "注册" => "$web_url/signup",
            "登录" => "$web_url/signin",
        );
    }
?>
