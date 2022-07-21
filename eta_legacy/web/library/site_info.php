<?php
	$site_name = "Eta";
	$site_url = "/home/wwwroot/eta_legacy/web";//网站根目录在服务器中的位置
	$web_url = "/web";//浏览器地址
	$page_url = array(
		"formnav" => "/library/judge_cookie_and_form.php",
		"head" => "/include/head.php",
		"nav" => "/include/nav.php",
		"header" => "/include/header.php",
		"discuss_header" => "/include/discuss_header.php",
		"toc" => "/include/toc.php",
		"footer" => "/include/footer.php",
		"foot" => "/include/foot.php",

		"index" => "/",
		"signin" => "/signin/",
		"signup" => "/signup/",
		"user" => "/user/",
		"settings" => "/settings/",
		"library" => "/library/",
		"create" => "/create/",
		"img" => "/img/"
	);
	$page_com_url = array();
	foreach($page_url as $name => $url){
		$page_com_url[$name] = $site_url."".$url;
	};
	$web_com_url = array();
	foreach($page_url as $name => $url){
		$web_com_url[$name] = $web_url."".$url;
	};
?>
