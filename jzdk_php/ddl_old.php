<?php
    require_once('PDO_dbconnect.php');
    require_once('session.php');
    require('header.php');

    function getStatus($st) {
        switch($st) {
        case -2:
            return "已放弃";
        case -1:
            return "已失败";
        case 0:
            return "正在进行";
        case 1:
            return "已完成";
        case 2:
            return "已取消";
        default:
            return "未知";
        }
    }

    $login_status = get_login_status();
    if($login_status != 1) {
        header('Location: ./login.php');
        exit();
    }
    $uid = $_SESSION['uid'];

    echo '<a href="./add_ddl.php">添加DDL</a><br>';

    $sql = "SELECT * FROM `ddl` WHERE `uid`=$uid AND `status`=0 AND `deadline`<CURDATE() ORDER BY `deadline` DESC";
    $dbcp = $dbc->prepare($sql);
    $is_success = $dbcp->execute();
    if(!$is_success) {
        $errorInfo = $dbcp->errorInfo();
        echo "数据库错误：<br>$errorInfo[2]";
        exit();
    }
    $result = &$dbcp;
    $row_count = $result->rowCount();
    echo "状态待更新DDL（".$row_count."）<br>";
    echo '<table><tr><td>DDLID</td><td>用户ID</td><td>完成度</td><td>状态</td><td>最后更新</td><td>最后期限</td><td>描述</td><td>操作</td></tr>';
    for($i = 0; $i < $row_count; $i++) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo '<tr>';
        echo "<td>".$row['ddlid']."</td>";
        echo "<td>".$row['uid']."</td>";
        echo "<td>".$row['completedparts']."/".$row['totalparts']."(".round(($row['completedparts']/$row['totalparts'])*100)."%)</td>";
        echo "<td>".getStatus($row['status'])."</td>";
        echo "<td>".$row['lastupdate']."</td>";
        echo "<td>".$row['deadline']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td><a href=\"./edit_ddl.php?ddlid={$row['ddlid']}\">修改</a> <a href=\"./del_ddl.php?ddlid={$row['ddlid']}\">删除</a><br>";
        echo '</tr>';
    }
    echo '</table>';

    echo '<br><br>';

    $sql = "SELECT * FROM `ddl` WHERE `uid`=$uid AND `status`=0 AND `deadline`>=CURDATE() ORDER BY `deadline` ASC";
    $dbcp = $dbc->prepare($sql);
    $is_success = $dbcp->execute();
    if(!$is_success) {
        $errorInfo = $dbcp->errorInfo();
        echo "数据库错误：<br>$errorInfo[2]";
        exit();
    }
    $result = &$dbcp;
    $row_count = $result->rowCount();
    echo "剩余DDL（".$row_count."）<br>";
    echo '<table><tr><td>DDLID</td><td>用户ID</td><td>完成度</td><td>状态</td><td>最后更新</td><td>最后期限</td><td>描述</td><td>操作</td></tr>';
    for($i = 0; $i < $row_count; $i++) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo '<tr>';
        echo "<td>".$row['ddlid']."</td>";
        echo "<td>".$row['uid']."</td>";
        echo "<td>".$row['completedparts']."/".$row['totalparts']."(".round(($row['completedparts']/$row['totalparts'])*100)."%)</td>";
        echo "<td>".getStatus($row['status'])."</td>";
        echo "<td>".$row['lastupdate']."</td>";
        echo "<td>".$row['deadline']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td><a href=\"./edit_ddl.php?ddlid={$row['ddlid']}\">修改</a> <a href=\"./del_ddl.php?ddlid={$row['ddlid']}\">删除</a><br>";
        echo '</tr>';
    }
    echo '</table>';

    echo '<br><br>';

    $sql = "SELECT * FROM `ddl` WHERE `uid`=$uid AND `status`<0 ORDER BY `deadline` DESC";
    $dbcp = $dbc->prepare($sql);
    $is_success = $dbcp->execute();
    if(!$is_success) {
        $errorInfo = $dbcp->errorInfo();
        echo "数据库错误：<br>$errorInfo[2]";
        exit();
    }
    $result = &$dbcp;
    $row_count = $result->rowCount();
    echo "已失败DDL（".$row_count."）<br>";
    echo '<table><tr><td>DDL ID</td><td>用户ID</td><td>完成度</td><td>状态</td><td>最后更新</td><td>最后期限</td><td>描述</td><td>操作</td></tr>';
    for($i = 0; $i < $row_count; $i++) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo '<tr>';
        echo "<td>".$row['ddlid']."</td>";
        echo "<td>".$row['uid']."</td>";
        echo "<td>".$row['completedparts']."/".$row['totalparts']."(".round(($row['completedparts']/$row['totalparts'])*100)."%)</td>";
        echo "<td>".getStatus($row['status'])."</td>";
        echo "<td>".$row['lastupdate']."</td>";
        echo "<td>".$row['deadline']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td><a href=\"./edit_ddl.php?ddlid={$row['ddlid']}\">修改</a> <a href=\"./del_ddl.php?ddlid={$row['ddlid']}\">删除</a><br>";
        echo '</tr>';
    }
    echo '</table>';

    echo '<br><br>';

    $sql = "SELECT * FROM `ddl` WHERE `uid`=$uid AND `status`>0 ORDER BY `deadline` DESC";
    $dbcp = $dbc->prepare($sql);
    $is_success = $dbcp->execute();
    if(!$is_success) {
        $errorInfo = $dbcp->errorInfo();
        echo "数据库错误：<br>$errorInfo[2]";
        exit();
    }
    $result = &$dbcp;
    $row_count = $result->rowCount();
    echo "已成功DDL（".$row_count."）<br>";
    echo '<table><tr><td>DDL ID</td><td>用户ID</td><td>完成度</td><td>状态</td><td>最后更新</td><td>最后期限</td><td>描述</td><td>操作</td></tr>';
    for($i = 0; $i < $row_count; $i++) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo '<tr>';
        echo "<td>".$row['ddlid']."</td>";
        echo "<td>".$row['uid']."</td>";
        echo "<td>".$row['completedparts']."/".$row['totalparts']."(".round(($row['completedparts']/$row['totalparts'])*100)."%)</td>";
        echo "<td>".getStatus($row['status'])."</td>";
        echo "<td>".$row['lastupdate']."</td>";
        echo "<td>".$row['deadline']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td><a href=\"./edit_ddl.php?ddlid={$row['ddlid']}\">修改</a> <a href=\"./del_ddl.php?ddlid={$row['ddlid']}\">删除</a><br>";
        echo '</tr>';
    }
    echo '</table>';

    require('footer.php');
?>