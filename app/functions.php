<?php

require __DIR__ . '/config.php';
require __DIR__ . '/libs/obj_connection.php';

//Conexion a la BBDD

    $conexionObj = new Conexion();

    $conexion_db = $conexionObj->getDatabaseConnection();

//Funciones
function getSelectCity($conexion, $c_id, $user_city)
{
    $query = "SELECT * from city where country_id = ?";

    $resultado = $conexion->prepare($query);
    $resultado->execute(array($c_id));

    $cities = $resultado->fetchAll(PDO::FETCH_OBJ);
    $resultado->closeCursor();
    
    $content = '
    <label for="select_city">City</label>
    <select name="st_city" id="select_city" class="form-control">';
    foreach ($cities as $city) {
        $content .= '<option value="'. $city->city_id . '"' . ($city->city_id == intval($user_city)? 'selected' :'') . '> 
        '. $city->city .'
        </option>';
    }
    $content .= '</select>';

    return $content;
}

function isOnTheCart( $theFilm , $theCartArray){
    
    foreach ($theCartArray as $cartItem){
       if($cartItem['filmId'] == $theFilm['filmId'] ){
            return true;
        }
    }
}

function addToCart($filmJson){
    session_start();
    $filmObj = json_decode($filmJson,true);

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }

    if(!isOntheCart( $filmObj , $_SESSION['cart'] ) ){
        array_push($_SESSION['cart'], $filmObj );
        return 'Film added correctly to the Cart';
    }
    else {
        return 'The film is on the cart';
    }
    
}

function deleteCartItem( $filmId ){
    session_start();

    $_SESSION['cart'] = array_filter($_SESSION['cart'],
            function($cartItem) use ($filmId){
                return(intval($cartItem['filmId']) !== intval($filmId));
            }   
        );
    
    return isCartEmpty()? 'the cart is empty' : '';
    
}

function isCartEmpty(){
    if (count($_SESSION['cart']) <= 0) {
        return true;
    }
}

function getSalesByCategory($conexion_db)
{
    $salesArrayA = array();  
    $salesArrayA['labels'] = array();
    $salesArrayA['sales'] = array();

    $query = "SELECT * FROM sales_by_film_category;";
    $resultado = $conexion_db->prepare($query);
    $resultado->execute();

    while( $sales = $resultado->fetch(PDO::FETCH_ASSOC)){
        array_push( $salesArrayA['labels'] , $sales['category']);
        array_push( $salesArrayA['sales'] , $sales['total_sales']);
    }
    return $salesArrayA;
    $resultado->closeCursor();

}

function getJsonSalesBycategory($conexion_db){
    $salesArrayA = getSalesByCategory($conexion_db);

    $jsonA = json_encode($salesArrayA);

    return $jsonA;
};

function getDailySales($conexion_db)
{
    $salesArrayB = array();  
    $salesArrayB['labels'] = array();
    $salesArrayB['sales'] = array();

    $query = "SELECT * FROM `sales_by_date` WHERE date_sales > '2005-08-01' ORDER BY `date_sales`";
    $resultado = $conexion_db->prepare($query);
    $resultado->execute();

    while( $sales = $resultado->fetch(PDO::FETCH_ASSOC)){
        array_push( $salesArrayB['labels'] , $sales['date_sales']);
        array_push( $salesArrayB['sales'] , $sales['sales']);
    }
    return array_reverse($salesArrayB);
    $resultado->closeCursor();

}

function getJsonDailySales($conexion_db){
    $salesArrayB = getDailySales($conexion_db);

    $jsonB = json_encode($salesArrayB);

    return $jsonB;
};

//Disparadores

//Obtener ciudades segun pais
if(isset($_GET["country"]) && isset($_GET["city"])){
    echo getSelectCity($conexion_db,$_GET["country"],$_GET["city"]);
}

//Añadir al carrito
if(isset($_GET['addToCart'])){
    echo addToCart($_GET['addToCart']);
}

if (isset($_GET['deleteItem'])) {
    echo deleteCartItem($_GET['deleteItem']);
}

if (isset($_GET['salesByCategory'])) {
    echo getJsonSalesBycategory($conexion_db);
}

if (isset($_GET['salesByDate'])) {
    echo getJsonDailySales($conexion_db);
}
