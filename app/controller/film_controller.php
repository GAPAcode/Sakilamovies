<?php 
require_once 'app/model/film_model.php';
$thispage = $_SERVER['PHP_SELF'];

if (isset($_GET["fid"])) {
	$film = new Film($_GET["fid"]);
}

require_once 'app/view/film_view.php';
 ?>