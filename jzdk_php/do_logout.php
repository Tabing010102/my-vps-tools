<?php
    require_once('session.php');
    destroy_session();
    echo "已登出";
    header('Location: ./index.php');
?>