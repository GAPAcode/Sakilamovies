<?php

require 'model/config.php';

    $conexion_db = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME , DB_USER, DB_PASS);

    $conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion_db->exec("SET CHARACTER SET ". DB_CHARSET);

//Funciones
function get_select_city($conexion, $c_id, $user_city)
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

function add_to_cart($filmJson){
    session_start();
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    array_push($_SESSION['cart'],$filmJson);
}

//Disparadores

//Obtener ciudades segun pais
if(isset($_POST["country"]) && isset($_POST["city"])){
    echo get_select_city($conexion_db,$_POST["country"],$_POST["city"]);
}

//Añadir al carrito
if(isset($_POST['filmjson'])){
    echo add_to_cart($_POST['filmjson']);
}

