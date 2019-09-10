<?php 
require_once 'app/libs/component.php';

/**
 * 
 */
class Film extends Component
{
	public $film_details;
	
	function __construct($film_id)
	{
		parent::__construct();

		$this->getFilmDetails($film_id);
	}
	
	private function getFilmDetails ($film_id) {
		htmlentities(addslashes($film_id));
	
		$query = 
		"SELECT *,is_film_in_stock(FID,1) AS has_stock FROM film_list 
		 WHERE FID = :film_id";
	
		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute(array(":film_id" => $film_id));
	
		if ( $details = $resultado->fetch(PDO::FETCH_OBJ) ) {
			$this->film_details = $details;
		}
	
		$resultado->closeCursor();
		$this->conexion_db=null;
		
	}
	
	public function render () {
		require_once __DIR__ . '/film_view.php';
	}

}
 ?>