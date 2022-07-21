<?php
    if(!isset($_POST['deadline']) || !isset($_POST['totalparts']) || !isset($_POST['description']) || !isset($_POST['priority'])) {
        require('header.php');
        echo "POST信息不可信<br>";
        require('footer.php');
        exit();
    }
    $dl = $_POST['deadline'];
    $tp = $_POST['totalparts'];
    $de = $_POST['description'];
    $pr = $_POST['priority'];
    require_once('PDO_dbconnect.php');
    require_once('functions.php');
    require('header.php');
    $login_status = get_login_status();
    if($login_status != 1) {
        header('Location: ./login.php');
    } else {
        $uid = $_SESSION['uid'];
        $sql = "INSERT INTO `ddl`(`uid`, `deadline`, `totalparts`, `description`, `priority`) VALUES($uid, :dl, :tp, :de, :pr)";
        $dbcp = $dbc->prepare($sql);
        $is_success = $dbcp->execute(array(
            ':dl' => $dl,
            ':tp' => $tp,
            ':de' => $de,
            ':pr' => $pr
        ));
        require_once('functions.php');
        echo '添加完成<br>';
        echo '<a href="./ddl.php">返回</a><br>';
    }
    require('footer.php');
?>