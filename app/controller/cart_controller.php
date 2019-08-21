<?php 
require_once 'app/model/cart_model.php';
$cart = new Cart();


if(!isset($_SESSION['user'])){
    header('location:index.php');
}

require_once 'app/view/cart_view.php';