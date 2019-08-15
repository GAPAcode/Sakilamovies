<?php 
require_once 'model/film_model.php';
$thispage = $_SERVER['PHP_SELF'];
session_start();

if (isset($_GET["fid"])) {
	$film = new Film($_GET["fid"]);
}


require_once 'view/film_view.php';
 ?>