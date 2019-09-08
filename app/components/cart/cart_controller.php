<?php 

require_once __DIR__ . '/cart_model.php';
$cart = new Cart();


if( !$cart->isUserOnSession() )
    header('location:/sakila/');

if(isset($checkout))
    $cart->checkoutCart();

$cart->render();
