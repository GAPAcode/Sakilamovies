<?php 
require_once __DIR__ . '/index_model.php';
	$index = new Index();

	$index->set_pag_actual(1);
	$index->set_pag_size(12);

	if (isset($_POST["login_send"])) {
		$exito = $index->login();	
		//Devuelve el login si no hay conincidencias en la BBDD
		if ($exito == 0) {
			echo $error = 'Usuario o contraseña incorrecta, intente de nuevo o registrese.';
		} else{
			//Sí no, devuelve la vista
			header("location:/sakila");
		}
	}
	
	if (isset($_GET["logout"])) {
		$index->logout("c_username");
	}

	if(isset($category)){
		$index->set_categoria_actual($category);
		
		if(isset($page)){
			if ($page == 1)
				header("location:/sakila/" . $category . '/');
			else
				$index->set_pag_actual($page);
		}
	}

	if (isset($search))
		$index->set_busqueda_actual($search);

	if(isset($page)){
		if ($page == 1)
			header("location:/sakila/");
		else
			$index->set_pag_actual($page);
	}

	$index->render();
 ?>