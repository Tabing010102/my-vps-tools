<?php
    require_once("PDO_dbconnect.php");
    //$sql = "SELECT * FROM `user`";
    $dbcp = $dbc->prepare("SELECT * FROM `user`");
    $is_success = $dbcp->execute();
    if(!$is_success) {
        $errorInfo = $dbcp->errorInfo();
        echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
        exit;
    }
    $result = $dbcp;
    $row_num = $result->rowCount();
    echo "<link rel=\"stylesheet\" href=\"$web_url/css/bootstrap.min.css\"></link>";
    echo "共有 $row_num 个用户，信息如下：<br>";

    echo "<table class=\"table\"><thead><tr>";
    echo "<th> 用户id </th>";
    echo "<th> 邮箱 </th>";
    echo "<th> 用户名 </th>";
    echo "<th> 性别 </th>";
    echo "<th> 注册时间 </th>";
    echo "</tr></thead><tbody>";

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $uid = $row['uid'];
        $email = $row['email'];
        $username = $row['username'];
        $gender = $row['gender'];
        $signup_time = $row['signup_time'];

        echo "<tr><td> $uid </td><td> $email </td><td> $username </td><td>";
        if($gender=='male') echo "男";
        else if($gender=='female') echo "女";
        else echo "其他";
        echo "</td><td> $signup_time </td></tr>";
    }

    echo "</tbody></table>";
?>
