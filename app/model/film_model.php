<?php 
require_once 'app/model/obj_connection.php';
require_once 'app/model/obj_film_list.php';
require_once 'app/model/index_model.php';

/**
 * 
 */
class Film extends Index
{
	public $film_details;
	
	function __construct($film_id)
	{
		parent::__construct();
		htmlentities(addslashes($film_id));

		$query = "SELECT * FROM film_list where FID = :film_id";

		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute(array(":film_id" => $film_id));

		if ($pelicula = $resultado->fetch(PDO::FETCH_OBJ)) {
			$obj = new pelicula_simple();
			$obj->set_id($pelicula->FID);
			$obj->set_titulo($pelicula->title);
			$obj->set_descripcion($pelicula->description);
			$obj->set_categoria($pelicula->category);
			$obj->set_precio($pelicula->price);
			$obj->set_duracion($pelicula->length);
			$obj->set_clasificacion($pelicula->rating);
			$obj->set_actores($pelicula->actors);

			$this->film_details = $obj;
		}

		$resultado->closeCursor();
		$this->conexion_db=null;
		}
}
 ?>