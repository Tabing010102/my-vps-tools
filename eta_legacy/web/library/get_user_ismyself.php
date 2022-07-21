<?php
    error_reporting(E_ALL || ~E_NOTICE);
    //临时解决方法
    function get_user_ismyself() {
        if($_POST['uid'] == NULL){//不是AJAX
		    $uid_g = (int)$_GET['uid'];
		    if($login_status == 0) {
			    if((int)$_COOKIE['uid'] != $uid_g) return false;
		        else return true;
		    }
	    } else {//AJAX,未完成
	        $is_myself = false;
        }
    }
?>
