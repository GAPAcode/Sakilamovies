<?php
require_once  __DIR__ . '/rentals_model.php';

$rentals = new Rentals();

if (isset($return)) {
    if($rentals->returnRental($id) > 0){
        header('location:/sakila/rentals');
    }else {
        header('location:/sakila/rentals');
    }
}

$rentals->render();