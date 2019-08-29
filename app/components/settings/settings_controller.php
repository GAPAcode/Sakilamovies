<?php 
require_once __DIR__ . '/settings_model.php';

$thispage = $_SERVER['PHP_SELF'];
$settings = new Settings();
$user_data = $settings->get_user_data($_SESSION["user"]);

if (!isset($_SESSION["user"])) {
	header("location:/sakila/index");
}

if (isset($_POST["save"])) {
	$exito = $settings->update_user(
		($_FILES["st_pic"]["name"] != "") ? $_FILES["st_pic"]["name"] : $_POST["st_hidPic"],
		$_POST["st_user"],
		$_POST["st_mail"],
		$_SESSION["user"],
		$_POST["st_city"],
		$_POST["st_district"],
		$_POST["st_address"]);
	if ($exito > 0) {
		$_SESSION["user"] = $_POST["st_user"];
		if (!$_FILES["st_pic"]["name"] == "") {
			$actual_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
			move_uploaded_file($_FILES["st_pic"]["tmp_name"], $actual_dir . $_FILES["st_pic"]["name"]);
			$_SESSION["profile"] = $_FILES["st_pic"]["name"];
		}
	}
	header("location:/sakila/settings");
}

$countries = $settings->get_countries();
$cities = $settings->get_city();

require_once __DIR__ . '/settings_view.php';
$settings->close_connection();
 ?>