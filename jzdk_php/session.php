<?php
    function destroy_session() {
        session_start();
        session_destroy();
    }
    //-1未登录 1session登录
    function get_login_status() {
        session_start();
        if(isset($_SESSION['uid'])) return 1;
        else {
            session_destroy();
            return -1;
        }
    }
?>