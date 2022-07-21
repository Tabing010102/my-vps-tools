<?php
    require_once("PDO_dbconnect.php");
    require_once("php_json_class.php");
    require_once("cookie.php");
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

    $sqldata['uid'] = (int)$_COOKIE['uid'];
    $sqldata['title'] = $_POST['title'];
    $sqldata['content'] = $_POST['content'];
    if($sqldata['title'] == "") { $e->callback = "标题不能为空。"; echo json_encode($e); exit; }
    if($sqldata['content'] == "") { $e->callback = "正文不能为空。"; echo json_encode($e); exit; }
    $sqldata['content_part'] = mb_strimwidth($sqldata['content'], 0, 160, "...");
    $dbcp1 = $dbc->prepare("INSERT INTO `discuss` (`organizer_uid`, `title`, `involve_num`)
                    VALUES (:uid, :title, '1')");
    $dbcp2 = $dbc->prepare("INSERT INTO `article` (`author_uid`, `content`, `content_part`, `last_modified`, `parent_did`)
                    VALUES (:uid, :content, :content_part, NOW(), :parent_did)");
    $dbcp3 = $dbc->prepare("SELECT `did` FROM `discuss` ORDER BY `did` DESC LIMIT 0,1");
    $is_success = $dbcp1->execute(array(
        ':uid' => $sqldata['uid'],
        ':title' => $sqldata['title']
    ));
    if($is_success) {
        $e->callback = "讨论创建成功。";
    } else {
        $errorInfo = $dbcp1->errorInfo();
        $e->callback = "数据库存取失败。<br>错误信息：<br>$errorInfo[2]";
        echo json_encode($e); exit;
    }
    $is_success2 = $dbcp3->execute();
    if(!$is_success2) {
        $errorInfo = $dbcp3->errorInfo();
        $e->callback = $e->callback."<br>数据库存取失败。<br>错误信息：<br>$errorInfo[2]";
        echo json_encode($e); exit;
    }
    $row = $dbcp3->fetch(PDO::FETCH_ASSOC);
    $did = $row['did'];
    $is_success = $dbcp2->execute(array(
        ':uid' => $sqldata['uid'],
        ':content' => $sqldata['content'],
        ':content_part' => $sqldata['content_part'],
        ':parent_did' => $did
    ));
    if($is_success) {
        $e->callback = $e->callback."<br>文章添加至讨论成功。";
        $e->jump = true; $e->url = "/discuss/?did=$did";
        $jumptime = 3; $e->jumptime*1000;
    } else {
        $errorInfo = $dbcp2->errorInfo();
        $e->callback = $e->callback."<br>数据库存取失败。<br>错误信息：<br>$errorInfo[2]";
        echo json_encode($e); exit;
    }
    echo json_encode($e);
?>
