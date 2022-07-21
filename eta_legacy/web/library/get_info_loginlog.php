<?php
    require_once("PDO_dbconnect.php");
    require_once("cookie.php");
    require_once("site_info.php");
    $login_status = get_login_status();
    if($login_status != 0) { header("Location: $web_url/signin"); exit; }

    //error_reporting(E_ALL || ~E_NOTICE);
    //临时解决方法

    if($_POST['page_cnt'] == NULL) $page_cnt = 0;
    else $page_cnt = $_POST['page_cnt'];
    $row_per_page = 10;

    $uid = (int)$_COOKIE['uid'];
    $query_offset = $page_cnt*$row_per_page;
    $query_limit = $row_per_page;
    //$sql = "SELECT * FROM `login` WHERE `uid`=$uid ORDER BY time DESC LIMIT $query_offset,$query_limit";
    $dbcp = $dbc->prepare("SELECT * FROM `login` WHERE `uid`=:uid ORDER BY time DESC LIMIT $query_offset,$query_limit");
    $is_success = $dbcp->execute(array(':uid' => $uid,));
    if(!is_success) {
        $errorInfo = $dbcp->errorInfo();
        echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
        exit;
    }
    $result = &$dbcp;
    $row_num = $result->rowCount();
    //echo "row_num: $row_num<br>";
    $row_cnt = 1;
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $user_login_data[$row_cnt]['lid'] = $row['lid'];
        $user_login_data[$row_cnt]['uid'] = $row['uid'];
        $user_login_data[$row_cnt]['ua'] = $row['ua'];
        $user_login_data[$row_cnt]['ip'] = $row['ip'];
        $user_login_data[$row_cnt]['time'] = $row['time'];
        $row_cnt++;
    }
    foreach($user_login_data as $a) {
        echo "<tr>";
        echo "<td>".$a['lid']."</td>";
        echo "<td>".$a['uid']."</td>";
        echo "<td>".$a['ip']."</td>";
        echo "<td>".$a['ua']."</td>";
        echo "<td>".$a['time']."</td>";
        echo "</tr>";
   }
?>
