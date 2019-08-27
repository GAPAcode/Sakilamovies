<?php 
require_once 'app/model/film_model.php';
$thispage = $_SERVER['PHP_SELF'];

if (isset($id)) {
	$film = new Film($id);
}
else {
	header('location:index');
}

require_once 'app/view/film_view.php';
 ?>