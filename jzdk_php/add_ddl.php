<?php
    require('header.php');
    $login_status = get_login_status();
    if($login_status != 1) {
        header('Location: ./login.php');
    } else {
        echo '<form action="./do_add_ddl.php" method="post">';
        echo '描述： <textarea rows="5" cols="30" name="description"></textarea><br>';
        echo '总块： <input type="text" name="totalparts"><br>';
        echo '最后期限： <input type="text" name="deadline"><br>';
        echo '优先级： <input type="text" name="priority"><br>';
        echo '<input type="submit" value="提交">';
        echo '</form><br>';
        echo '<a href="./ddl.php">返回</a><br>';
    }
    require('footer.php');
?>