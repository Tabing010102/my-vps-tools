<?php
    if(!isset($_GET['ddlid'])) { header('Location: ./ddl.php'); exit(); }
    $ddlid = $_GET['ddlid'];
    require_once('PDO_dbconnect.php');
    require_once('functions.php');
    require_once('header.php');
    if($login_status != 1) {
        header('Location: ./login.php');
    } else {
        $uid = $_SESSION['uid'];
        $sql = "SELECT * FROM `ddl` WHERE `ddlid`=$ddlid";
        $dbcp = $dbc->prepare($sql);
        $is_success = $dbcp->execute();
        if(!$is_success) failed_dberr($dbcp);
        $result = &$dbcp;
        $row_count = $result->rowCount();
        if($row_count == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if($row['uid'] != $uid) {
                echo '您没有权限修改此记录<br>';
            } else {
                //echo $row['status'];
                echo '<form action="./do_edit_ddl.php" method="post">';
                echo "DDLID： <input type=\"text\" name=\"ddlid\" value=\"$ddlid\" readonly><br>";
                echo "最后期限： <input type=\"text\" name=\"deadline\" value=\"{$row['deadline']}\"><br>";
                echo '状态： ';
                echo '<select name="status">';
                /*echo "<option value=\"-2\"".$row['status']==-2?" selected":" ".">已放弃</option>";
                echo "<option value=\"-1\"".$row['status']==-1?" selected":" ".">已失败</option>";
                echo "<option value=\"0\"".$row['status']==0?" selected":" ".">正在进行</option>";
                echo "<option value=\"1\"".$row['status']==1?" selected":" ".">已完成</option>";
                echo "<option value=\"2\"".$row['status']==2?" selected":" ".">已取消</option>";*/
                echo '<option value="-2"'; if($row['status']==-2)echo' selected';else echo' '; echo '>已放弃</option>';
                echo '<option value="-1"'; if($row['status']==-1)echo' selected';else echo' '; echo '>已失败</option>';
                echo '<option value="0"'; if($row['status']==0)echo' selected';else echo' '; echo '>正在进行</option>';
                echo '<option value="1"'; if($row['status']==1)echo' selected';else echo' '; echo '>已完成</option>';
                echo '<option value="2"'; if($row['status']==2)echo' selected';else echo' '; echo '>已取消</option>';
                echo '</select><br>';
                echo "已完成块： <input type=\"text\" name=\"completedparts\" value=\"{$row['completedparts']}\"><br>";
                echo "总块： <input type=\"text\" name=\"totalparts\" value=\"{$row['totalparts']}\"><br>";
                echo "优先级： <input type=\"text\" name=\"priority\" value=\"{$row['priority']}\"><br>";
                echo "描述： <textarea rows=\"5\" cols=\"30\" name=\"description\">{$row['description']}</textarea><br>";
                echo '<input type="submit" value="确认修改">';
                echo '</form><br>';
            }
        } else if($row_count == 0) {
            echo '您无法修改不存在的DDL<br>';
        } else {
            echo '未知错误<br>';
        }
        echo '<a href="./ddl.php">返回</a><br>';
    }
    require_once('footer.php');
?>