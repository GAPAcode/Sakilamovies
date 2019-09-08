<?php
require_once __DIR__ . '/../../libs/component.php';

class Cart extends Component {
    public $cartItems = array();

    function __construct(){
        parent::__construct();
        if(isset($_SESSION['cart']))
            $this->cartItems = $_SESSION['cart'];
    }

    public function render(){
        include_once __DIR__ . '/cart_view.php';
    }

    public function checkoutCart(){
        if( $this-> isCartEmpty() )
            header('location:/sakila/cart');
        
        $inventoryIds = $this->getFilmInventoriesIDs();
        echo(var_dump($inventoryIds));
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
        } catch (\PDOException $th) {
           throw new Exception('Error while getting inventory_ids ' . $th, 1);
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
        
        $this->conexion_db->beginTransaction();

        try {
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
                $count++;
            } 

            $this->conexion_db->commit();

        } catch (\PDOException $th) {
            $this->conexion_db->rollback();
            throw new Exception("Error Processing Rentals and Payments: " . $th, 1);
        }
    }

    public function isCartEmpty(){

        if ( !isset( $this->cartItems ) )
            return true;
        else
            return ( count( $this->cartItems ) <= 0 )? true : false;
    }
}