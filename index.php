<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once "config.php";

$route = explode('?', $_SERVER['REQUEST_URI'], 2);
if (! isset($route[1]) || empty($route[1])){
	$page = "scoreboard";
}else{
	$page = $route[1];
}

$whitelist = Array("scoreboard", "login", "home", "administrator", "notification", "profile", "events");

if (substr($page, 0, 7) === "profile"){
	$userid = explode("&", $page, 2);
	if (! isset($userid[1]) || empty($userid[1])){
		$page = "home";
		$userid = -1;
	}else{
		$page = "profile";
		$userid = $userid[1];
	}
}

if (! in_array($page, $whitelist)){
	require_once ERROR . "404.php";
	die();
}

require_once PAGES . $page . ".php";

?>


<!-- Thà làm que diêm lóe sáng 1 giây rồi tắt
Hơn làm que củi hiu hiu mãi không cháy
- Kevinlpd -->
