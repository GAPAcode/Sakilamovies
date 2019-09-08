<?php 
	require_once 'app/libs/AltoRouter.php';

	$router = new AltoRouter;
	
	$router->setBasePath('/sakila');

	// Index Routes
	$router->map('GET|POST','/', function() {
		require_once __DIR__ .'/app/components/index/index_controller.php';
	});

	$router->map('GET|POST','/index', function() {
		require_once __DIR__ . '/app/components/index/index_controller.php';
	});

	$router->map('GET|POST','/page/[i:page]', function( $page ) {
		require_once __DIR__ . '/app/components/index/index_controller.php';
	});

	$router->map('GET|POST','/search/[a:search]/[i:page]?', function($search, $page = null) {
		require_once __DIR__ .'/app/components/index/index_controller.php';
	});
	
	$router->map('GET|POST','/category/[a:cat]/[i:page]?', function($category, $page = null) {
		require_once __DIR__ .'/app/components/index/index_controller.php';
	});

	// Signup Routes
	$router->map('GET|POST','/signup', function() {
		require_once __DIR__ . '/app/components/signup/signup_controller.php';
	});

	// Film Routes
	$router->map('GET|POST','/film/[i:id]/', function( $id ) {
		require_once __DIR__ .'/app/components/film/film_controller.php';
	});

	// Cart Routes
	$router->map('GET|POST','/cart', function() {
		require_once __DIR__ .'/app/components/cart/cart_controller.php';
	});

	$router->map('GET|POST','/cart/[a:a]/', function($checkout) {
		require_once __DIR__ .'/app/components/cart/cart_controller.php';
	});

	// Rental Routes
	$router->map('GET|POST','/rentals', function() {
		require_once __DIR__ .'/app/components/rentals/rentals_controller.php';
	});

	$router->map('GET|POST','/rentals/[a:return]/[i:id]', function($return,$id) {
		require_once __DIR__ .'/app/components/rentals/rentals_controller.php';
	});

	// Rental Routes
	$router->map('GET|POST','/settings', function() {
		require_once __DIR__ .'/app/components/settings/settings_controller.php';
	});

	// Management Routes
	$router->map('GET|POST','/management', function() {
		require_once __DIR__ .'/app/components/management/management_controller.php';
	});

	$router->map('GET|POST','/management/[*:view]', function($view) {
		require_once __DIR__ .'/app/components/management/management_controller.php';
	});

	// JS Async Server Requests Routes
	$router->map('GET|POST','/app/functions/', function() {
		require_once __DIR__ .'/app/functions.php';
	});

	$match = $router->match();

	// Call closure or throw 404 status
	if( is_array($match) && is_callable( $match['target'] ) ) {
		call_user_func_array( $match['target'], $match['params'] ); 
	} else {
		// no route was matched
		require_once 'app/404.php';
	}
?>