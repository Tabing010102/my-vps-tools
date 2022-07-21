<?php
    require_once("php_json_class.php");
    require_once("site_info.php");
    setcookie("uid", "", time()-7200, "$web_url/");
    setcookie("pwdhash", "", time()-7200, "$web_url/");
    setcookie("iphash", "", time()-7200, "$web_url/");
    setcookie("uahash", "", time()-7200, "$web_url/");
    $e = new jj();
    $e->jump = true; $e->url = "$web_url/";
    $jumptime = 3; $e->jumptime = $jumptime*1000;
    $e->callback = "讲道理，登出成功。<br>将在 $jumptime 秒后跳转至主页。";
    echo json_encode($e);
?>
