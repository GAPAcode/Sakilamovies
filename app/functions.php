<?php

require 'model/config.php';
//Conexion a la BBDD

    $conexion_db = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME , DB_USER, DB_PASS);

    $conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion_db->exec("SET CHARACTER SET ". DB_CHARSET);

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
        $content = $content . '<option value="'. $city->city_id . '"' . ($city->city_id == intval($user_city)? 'selected' :'') . '> 
        '. $city->city .'
        </option>';
    }
    $content = $content . '</select>';

    return $content;
}

function isOnTheCart( $theFilmJson , $theCartArray){
    $filmObj = json_decode($theFilmJson);
    
    foreach ($theCartArray as $cartItem) {
       $cartItemObj = json_decode($cartItem);
        
       if($cartItemObj->filmId === $filmObj->filmId ){
            return true;
        }
    }
}

function addToCart($filmJson){
    session_start();

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }

    if(!isOntheCart( $filmJson , $_SESSION['cart'] ) ){
        array_push($_SESSION['cart'], $filmJson );
    }
    else {
        return 'The film is on the cart';
    }
    
}

function deleteCartItem( $filmId ){
    // session_start();
    // array_filter($_SESSION['cart'], (function($cartItem){
    //     $cartItemObj = json_decode($cartItem);
    //     echo $cartItemObj->filmId;
    //     return $cartItemObj->filmId != $_POST['deleteItem'];
    // }));
    // echo var_dump($_SESSION['cart']);
}

//Disparadores

//Obtener ciudades segun pais
if(isset($_POST["country"]) && isset($_POST["city"])){
    echo getSelectCity($conexion_db,$_POST["country"],$_POST["city"]);
}

//Añadir al carrito
if(isset($_POST['filmjson'])){
    echo addToCart($_POST['filmjson']);
}

if (isset($_POST['deleteItem'])) {
    echo deleteCartItem($_POST['deleteItem']);
}

