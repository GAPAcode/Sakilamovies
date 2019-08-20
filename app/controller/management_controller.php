<?php 
require_once 'app/model/management_model.php';

session_start();
$thispage = $_SERVER["PHP_SELF"];

$management = new Management();

if (isset($_POST["m_login_send"])) {
	$exito = $management->login($_POST["m_user"],$_POST["m_pass"]);
	if ($exito > 0) {
		$_SESSION["user_manager"] = $management->session_staff->get_username();
		$_SESSION["user_manager_pic"] = $management->session_staff->get_picture();
		if (isset($_POST["m_remember"])) {
			setcookie("c_user_manager",	$management->session_staff->get_username(),time()+50000);
		}
		header("location:management.php");
	}
}

if (isset($_GET["logout"])) {
	$management->logout("c_user_manager");
}

if (isset($_POST["newfilm"])) {
	$exito = $management->new_film(
		$_POST["f_name"],
		$_POST["f_desc"],
		$_POST["f_year"],
		$_POST["f_lang"],
		$_POST["f_rental"],
		$_POST["f_length"],
		$_POST["f_rting"],
		$_POST["f_actors"],
		$_POST["f_category"]
		);

	if ($exito > 0) {
		header("location:management.php");
	}
}
if (isset($_POST["add_inv"])) {
	$management->add_stock($_POST["ai_store"],$_POST["ai_film"],$_POST["ai_quantity"]);
	header("location:management.php?view=film_inventory");
}

if (isset($_SESSION['user_manager'])) {
	require_once 'app/view/management_view.php';
}
else{
	require_once 'app/view/management_login_view.php';
}

 ?>