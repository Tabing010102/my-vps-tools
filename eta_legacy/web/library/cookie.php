<?php
    error_reporting(E_ALL || ~E_NOTICE);
    //临时解决方法
    //-1未登录 0已登录 1密码错误 2uid不存在 3uid重复 4ip错误 5ua错误
    function get_login_status() {
        require("PDO_dbconnect.php");
        if(isset($_COOKIE["uid"])) {
            $uid = (int)$_COOKIE["uid"];
            //$sql = "SELECT pwdhash,last_login_ip_hash,last_login_ua_hash FROM user WHERE uid='$uid'";
            $dbcp = $dbc->prepare("SELECT `pwdhash`,`last_login_ip_hash`,`last_login_ua_hash` FROM `user` WHERE `uid`=:uid");
            $is_success = $dbcp->execute(array(':uid'=>$uid));
            //echo "cookie.php<br>";
            if(!$is_success) {
                $errorInfo = $dbcp->errorInfo();
                echo "数据库存取失败。错误信息：<br>$errorInfo[2]<br>";
                exit;
            }
            $result = &$dbcp;
            $row_num = $result->rowCount();
            if($row_num < 1) return 2;
            else if($row_num > 1) return 3;
            else {
                $pwdhash = $_COOKIE["pwdhash"];
                $iphash = $_COOKIE["iphash"];
                $uahash = $_COOKIE["uahash"];
                $row = $result->fetch(PDO::FETCH_ASSOC);
                if($pwdhash != $row["pwdhash"]) return 1;
                if($iphash != $row["last_login_ip_hash"]) return 4;
                if($uahash != $row["last_login_ua_hash"]) return 5;
                return 0;
            }
        } else {
            return -1;
        }
    }
?>
