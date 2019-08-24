<?php 
require_once 'app/model/cart_model.php';
$cart = new Cart();


if(!isset($_SESSION['user'])){
    header('location:index.php');
}

if(isset($_SESSION['cart'])){
    $cartNotEmpty = (count($_SESSION['cart']) <= 0)? false : true;
}else{
    $cartNotEmpty = false;
}
require_once 'app/view/cart_view.php';