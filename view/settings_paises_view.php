<?php

require '../model/config.php';

    $conexion_db = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME , DB_USER, DB_PASS);

    $conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion_db->exec("SET CHARACTER SET ". DB_CHARSET);

function get_city_by_country($conexion, $c_id)
{
    $query = "SELECT * from city where country_id = ?";

    $resultado = $conexion->prepare($query);
    $resultado->execute(array($c_id));

    return $resultado->fetchAll(PDO::FETCH_OBJ);
    $resultado->closeCursor();
}
$cities = get_city_by_country($conexion_db,$_POST["country"]);
$user_city = $_POST["city"];
?>

<label for="select_city">City</label>
<select name="st_city" id="select_city" class="form-control">
    <?php foreach($cities as $city):?>
        <option value=" <?php echo $city->city_id ?> " <?php echo ($city->city_id == intval($user_city))? "selected" :"" ?> >
            <?php echo $city->city ?> 
        </option>
    <?php endforeach ?>
</select>
