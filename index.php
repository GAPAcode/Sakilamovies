<!DOCTYPE html>
<html>
<head>
	<title>Sakila - Best Movies</title>
	<link rel="stylesheet" type="text/css" href="/sakila/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/sakila/assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="/sakila/assets/css/font-awesome.css">
</head>
<body class="bg-secondary">

<?php 
	if(isset($_SERVER['REDIRECT_QUERY_STRING']) ){
		$request = str_replace('?'. $_SERVER['REDIRECT_QUERY_STRING'],'',$_SERVER['REQUEST_URI']);
	}
	else{
		$request = $_SERVER['REQUEST_URI'];
	}

	switch ($request) {
		case '/sakila/':
			require_once 'app/controller/index_controller.php'; 
			break;

		case '/sakila/index':
			require_once 'app/controller/index_controller.php';
			break;

		case '/sakila/cart':
			require_once 'app/controller/cart_controller.php';
			break;

		case '/sakila/settings':
			require_once 'app/controller/settings_controller.php';
			break;

		case '/sakila/signup':
			require_once 'app/controller/signup_controller.php';
			break;

		case '/sakila/film':
			require_once 'app/controller/film_controller.php';
			break;

		case '/sakila/management':
			require_once 'app/controller/management_controller.php';
			break;

		default:
			require_once 'app/view/404.php';
			break;
	}
?>

<script type="text/javascript" src="/sakila/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/sakila/js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="/sakila/js/util.js"></script>
</body>
</html>