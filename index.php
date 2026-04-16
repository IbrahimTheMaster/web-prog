<?php
include('./includes/config.inc.php');
$page = '';
if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '') {
	$page = $_SERVER['QUERY_STRING'];
}
else {
	$reqUri = isset($_SERVER['REQUEST_URI']) ? (string) $_SERVER['REQUEST_URI'] : '/';
	$path = trim((string) parse_url($reqUri, PHP_URL_PATH), '/');
	if ($path !== '' && $path !== 'index.php') {
		$page = $path;
	}
}
if ($page!="") {
	if (isset($pages[$page]) && file_exists("./templates/pages/{$pages[$page]['file']}.tpl.php")) {
		$find = $pages[$page];
	}
	else { 
		$find = $error_page;
		header("HTTP/1.0 404 Not Found");
	}
}
else $find = $pages['/'];
include('./templates/index.tpl.php'); 
?>