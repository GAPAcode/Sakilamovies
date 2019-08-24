<?php 
require_once 'app/model/index_model.php';
	$thispage = str_replace('.php','',$_SERVER['PHP_SELF']);
	$index = new index();

	$index->set_pag_actual(1);
	$index->set_pag_size(12);

	if (isset($_POST["login_send"])) {
		$exito = $index->login($_POST["l_user"],$_POST["l_pass"]);	
		//Devuelve el login si no hay conincidencias en la BBDD
		if ($exito == 0) {
			$error = 'Usuario o contraseña incorrecta, intente de nuevo o registrese.';
		} else{
			//Sí no, devuelve la vista
			if (isset($_POST["l_remember"])) {
				setcookie("c_username",$_POST["l_user"],time()+50000);
			}
			$_SESSION["user"] = $index->get_session_username();
			$_SESSION["profile"] = $index->get_session_profile_pic();
			header("location:index");
		}
	}

	if (isset($_GET["logout"])) {
		$index->logout("c_username");
	}
	if (isset($_GET["s"])) {
		$index->set_busqueda_actual($_GET["s"]);
	}

	if (isset($_GET["c"])) {
		$index->set_categoria_actual($_GET["c"]);
	}

	if (isset($_GET["p"])) {

		if ($_GET["p"] == 1) {
			$index->set_pag_actual(1);
			header("location:index" . (isset($_GET["c"])?"?c=" . $index->get_categoria_actual():"") . (isset($_GET["s"])?"&s=" . $index->get_busqueda_actual():""));
		}

		$index->set_pag_actual($_GET["p"]);
	}

	$film_list = $index->get_film_list();

	$categorias = $index->get_categorias();
require_once 'app/view/index_view.php';
 ?>