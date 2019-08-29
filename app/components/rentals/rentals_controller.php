<?php
require_once  __DIR__ . '/rentals_model.php';

$rentals = new Rentals();

if (isset($return)) {
    if($rentals->returnRental($id) > 0){
        $_POST['msg'] = 'Film Returned Correctly.';
        header('location:/sakila/rentals');
    }else {
        $_POST['msg'] = 'Failed To Return Film.';
        header('location:/sakila/rentals');
    }
}

require_once __DIR__ . '/rentals_view.php';