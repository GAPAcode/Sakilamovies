<?php 
require_once __DIR__ . '/film_model.php';
$thispage = $_SERVER['PHP_SELF'];

if (isset($id)) {
	$film = new Film($id);
}
else {
	header('location:/sakila/');
}

require_once __DIR__ . '/film_view.php';
 ?>