<?php
require_once 'app/model/rentals_model.php';

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

require_once 'app/view/rentals_view.php';