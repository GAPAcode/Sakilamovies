<?php 

require_once __DIR__ . '/cart_model.php';
$cart = new Cart();


if(!isset($_SESSION['user'])){
    header('location:/sakila/');
}

if(isset($checkout)){
    $cart->checkoutCart();

    // header('location:/sakila/');
}

if(isset($_SESSION['cart'])){
    $cartNotEmpty = ( count($_SESSION['cart']) <= 0 )? false : true;
}else{
    $cartNotEmpty = false;
}
require_once __DIR__ . '/cart_view.php';
