<?php
require_once 'app/model/index_model.php';

class Cart extends Index {
    public $cartItems = array();

    function __construct(){
        parent::__construct();
        if(isset($_SESSION['cart']))
            $this->cartItems = $_SESSION['cart'];
    }

    public function checkoutCart(){
        $inventoryIds = $this->getFilmInventoriesIDs();
        $this->addRentalsAndPayments($inventoryIds);

        $_SESSION['cart'] = null;
        $this->cartItems = null;
    }

    private function getFilmInventoriesIDs(){
        $query = '';
        $ids = array();

        try {
            foreach ($this->cartItems as $cartItem) {
                $query = 'CALL `film_in_stock`(:id , 1, @p2);';
                $result = $this->conexion_db->prepare($query);
                $result->execute(array(':id' => $cartItem['filmId']));

                if ($id = $result->fetch(PDO::FETCH_ASSOC)) {
                    array_push($ids,$id['inventory_id']);
                }
            }   
            $result->closeCursor();
        } catch (\Throwable $th) {
           echo 'Error while getting inventory_ids ' . $th;
        }
        
        return $ids;
    }

    private function addRentalsAndPayments($inventoryIds){
        $rentalQuery = 'INSERT INTO rental( inventory_id , customer_id , staff_id) VALUES (:inv, :cus, 9)';
        $paymentQuery = 
        'INSERT INTO payment( customer_id , staff_id , amount, rental_id)
         VALUES(:cus , 9 , :amount ,
            (SELECT rental_id FROM rental 
             WHERE inventory_id = :inv AND customer_id = :cus2 LIMIT 1))';
        $count = 0;

        foreach ($inventoryIds as $id ) {

            $resultRentals = $this->conexion_db->prepare($rentalQuery);
            $resultRentals->execute(array(':inv' => $id , ':cus' => $this->user_id));
            $resultRentals->closeCursor();                

            $resultPayment = $this->conexion_db->prepare($paymentQuery);
            $resultPayment->execute(array(
                ':inv' => $id, 
                ':cus' => $this->user_id, 
                ':cus2' => $this->user_id,
                ':amount' => $this->cartItems[$count]['price']
            ));
            $resultPayment->closeCursor(); 
            $count++;
        }
    }

}