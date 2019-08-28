<?php 
require_once 'app/model/index_model.php';
class Rentals extends Index {
    public $userRentals = array();

    function __construct(){
        parent::__construct();

        if(null === parent::get_session_username())
            header('location:/sakila/index');

        $this->userRentals = $this->getUserRentals();
    }
    
    public function getUserRentals(){
        $query = 
        'SELECT rental.rental_id, rental.rental_date, film.title 
        FROM rental 
        INNER JOIN inventory ON rental.inventory_id = inventory.inventory_id 
        INNER JOIN film ON inventory.film_id = film.film_id 
        WHERE customer_id = :userId AND `return_date` IS NULL';

        $result = $this->conexion_db->prepare($query);
        $result->execute(array(':userId' => $this->user_id));

        $rentals = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        
        return $rentals;
    }

    public function returnRental($id){
        $id = htmlentities(addslashes($id));

        $query = 'UPDATE `rental` SET `return_date` = NOW() WHERE rental_id = :rentalId';

        $result = $this->conexion_db->prepare($query);
        $result->execute(array(':rentalId' => $id ));

        $rowsAffected = $result->rowCount();
        $result->closeCursor();
        
        return $rowsAffected;
    }
}