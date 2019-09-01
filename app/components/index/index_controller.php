<?php 
require_once __DIR__ . '/index_model.php';
	$thispage = str_replace('.php','',$_SERVER['PHP_SELF']);
	$index = new Index();

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
			header("location:/sakila");
		}
	}
	
	if (isset($_GET["logout"])) {
		$index->logout("c_username");
	}

	if(isset($category)){
		$index->set_categoria_actual($category);
		
		if(isset($page)){
			if ($page == 1) {
				$index->set_pag_actual(1);
				header("location:/sakila/" . $category . '/');
			}
			$index->set_pag_actual($page);
		}
	}
	if (isset($search)) {
		$index->set_busqueda_actual($search);
	}

	if(isset($page)){
		if ($page == 1) {
			$index->set_pag_actual(1);
			header("location:/sakila/");
		}
		$index->set_pag_actual($page);
	}



	$film_list = $index->get_film_list();

	$categorias = $index->get_categorias();
require_once __DIR__ . '/index_view.php';
 ?>