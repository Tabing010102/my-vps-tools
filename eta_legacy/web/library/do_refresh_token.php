<?php
    require_once("PDO_dbconnect.php");
    $dbcp1 = $dbc->prepare("SELECT `uid`,`token` FROM `user`");
    $dbcp2 = $dbc->prepare("UPDATE `user` SET `token`=:token WHERE `uid`=:uid");
    $is_success = $dbcp1->execute();
    if(!$is_success) {
        $errorInfo = $dbcp1->errorInfo();
        echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
        exit;
    }
    while($row = $dbcp1->fetch(PDO::FETCH_ASSOC)) {
        $uid = $row['uid'];
        $token = $row['token'];
        $token_new = $token/2 + 200;
        $is_success2 = $dbcp2->execute(array(
            ':uid' => $uid,
            ':token' => $token_new
        ));
        if(!$is_success2) {
            $errorInfo = $dbcp2->errorInfo();
            echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
            exit;
        }
        echo "uid为 $uid 的用户，代金券从 $token 更新为 $token_new<br>";
    }
    echo "代金券更新完成。";
?>
