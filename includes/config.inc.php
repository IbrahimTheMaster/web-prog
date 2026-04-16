<?php
$db = array(
    'host' => 'localhost',
    'name' => 'databaselesson',
    'user' => 'webprog',
    'pass' => 'webprog123',
    'charset' => 'utf8',
);

$pagetitle = array(
    'title' => 'City Explorer Portal',
);

$header = array(
    'imagesource' => 'logo.png',
    'imagealt' => 'logo',
	'title' => 'City Explorer Portal',
	'motto' => 'Discover places, stories, and local highlights.'
);

$footer = array(
    'copyright' => 'Copyright '.date("Y").'.',
    'firm' => 'City Explorer Team'
);

$pages = array(
	'/' => array('file' => 'home', 'text' => 'Mainpage', 'menun' => array(1,1)),
	'images' => array('file' => 'images', 'text' => 'Images', 'menun' => array(1,1)),
	'contact' => array('file' => 'contact', 'text' => 'Contact', 'menun' => array(1,1)),
    'contact-result' => array('file' => 'contact-result', 'text' => '', 'menun' => array(0,0)),
    'crud' => array('file' => 'table', 'text' => 'CRUD', 'menun' => array(1,1)),
    'messages' => array('file' => 'messages', 'text' => 'Messages', 'menun' => array(0,1)),
    'login' => array('file' => 'login', 'text' => 'Login', 'menun' => array(1,0)),
    'login2' => array('file' => 'login2', 'text' => '', 'menun' => array(0,0)),
    'logout' => array('file' => 'logout', 'text' => 'Logout', 'menun' => array(0,1)),
    'register' => array('file' => 'register', 'text' => '', 'menun' => array(0,0))
);

$error_page = array ('file' => '404', 'text' => 'Page not found!');
?>
