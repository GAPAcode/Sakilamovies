<?php 
	require_once __DIR__ . '/signup_model.php';
	$thispage = $_SERVER['PHP_SELF'];
	$signup = new Signup();

	if (isset($_POST['send'])) {
		$new_tmp_file = $_SERVER["DOCUMENT_ROOT"] . "/uploads/";
		move_uploaded_file($_FILES["su_pic"]["tmp_name"], $new_tmp_file . $_FILES['su_pic']["name"]);
		$exito = $signup->new_customer(
			$_POST["su_fname"],
			$_POST["su_lname"],
			$_POST["su_email"],
			$_POST["su_user"],
			$_POST["su_pass"],
			$_FILES['su_pic']["name"]);
		if ($exito == 1) {
			header("location:/sakila/");
		}
	}

	require_once __DIR__ . '/signup_view.php';
 ?>