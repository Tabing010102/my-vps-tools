<?php
    require_once("PDO_dbconnect.php");
    require_once("site_info.php");
    if($_GET['did'] == NULL) { header("Location: $web_url/404"); exit; }
    $did = (int)$_GET['did'];
    $dbcp = $dbc->prepare("SELECT `title` FROM `discuss` WHERE `did`=$did");
    $is_success = $dbcp->execute();
    if(!$is_success) {
        $errorInfo = $dbcp->errorInfo();
        echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
        exit;
    }
    $row = $dbcp->fetch(PDO::FETCH_ASSOC);
    $discuss_title = $row['title'];
?>
