<?php 
require_once __DIR__ . '/film_model.php';

if ( isset($id) ) {
	$film = new Film($id);
}
else {
	header('location:/sakila/');
}

$film->render();
 ?>