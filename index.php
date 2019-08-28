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
	require_once 'app/libs/AltoRouter.php';

	$router = new AltoRouter;
	
	$router->setBasePath('/sakila');

	$router->map('GET|POST','/',function() {
		require_once __DIR__ .'/app/controller/index_controller.php';
	});

	$router->map('GET|POST','/index',function() {
		require_once __DIR__ . '/app/controller/index_controller.php';
	});

	$router->map('GET|POST','/signup',function() {
		require_once __DIR__ . '/app/controller/signup_controller.php';
	});

	$router->map('GET|POST','/film/[i:id]/', function( $id ) {
		require_once __DIR__ .'/app/controller/film_controller.php';
	});

	$router->map('GET|POST','/cart', function() {
		require_once __DIR__ .'/app/controller/cart_controller.php';
	});

	$router->map('GET|POST','/cart/[a:a]/', function($checkout) {
		require_once __DIR__ .'/app/controller/cart_controller.php';
	});

	$router->map('GET|POST','/rentals', function() {
		require_once __DIR__ .'/app/controller/rentals_controller.php';
	});

	$router->map('GET|POST','/rentals/[a:return]/[i:id]', function($return,$id) {
		require_once __DIR__ .'/app/controller/rentals_controller.php';
	});

	$router->map('GET|POST','/settings', function() {
		require_once __DIR__ .'/app/controller/settings_controller.php';
	});

	$router->map('GET|POST','/management', function() {
		require_once __DIR__ .'/app/controller/management_controller.php';
	});

	$router->map('GET|POST','/app/functions/', function() {
		require_once __DIR__ .'/app/functions.php';
	});

	$match = $router->match();

	// call closure or throw 404 status
	if( is_array($match) && is_callable( $match['target'] ) ) {
		call_user_func_array( $match['target'], $match['params'] ); 
	} else {
		// no route was matched
		require_once 'app/view/404.php';
	}
?>

<script type="text/javascript" src="/sakila/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/sakila/js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="/sakila/js/util.js"></script>
</body>
</html>