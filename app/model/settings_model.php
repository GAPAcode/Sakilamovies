<?php 
require_once 'app/obj_connection.php';

/**
 * 
 */
class Settings extends Conexion
{
	function __construct()
	{
		parent::__construct();
	}

	public function get_user_data($username)
	{
		$query = "SELECT profile_pic,username,email,ad.address,ad.district,city.city_id, city, country.country_id, country
		FROM customer 
		INNER JOIN address AS ad ON customer.address_id = ad.address_id
		INNER JOIN city ON ad.city_id = city.city_id
		INNER JOIN country ON city.country_id = country.country_id
		WHERE username = ?";

		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute(array($username));

		return $resultado->fetch(PDO::FETCH_OBJ);
		$resultado->closeCursor();
	}
	
	public function update_user($pic_name,$username,$email,$actualUsername,$cityId,$district,$address)
	{
		$pic = htmlentities(addslashes($pic_name));
		$usu =	htmlentities(addslashes($username));
		$mail = htmlentities(addslashes($email));
		$dist = htmlentities(addslashes($district));
		$addr = htmlentities(addslashes($address)); 
		
		$query = "UPDATE customer 
		SET ".
		($pic != ""? "profile_pic = :pic ," : "") . //VERIFICA SI HA ENVIADO UNA IMAGEN
		"username = :username, email = :email 
		WHERE username = :ActualUsername;
		UPDATE address 
		SET address = :address, district = :district, city_id = :city 
		WHERE address_id = (SELECT address_id FROM customer WHERE username = :username)
		";

		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute(array(
			":pic" => $pic,
			":username" => $usu,
			":email" => $mail,
			":ActualUsername" => $actualUsername,
			":address" => $addr,
			":district" => $dist,
			":city" => $cityId
		));
		return $resultado->rowCount();
		$resultado->closeCursor();
	}

	public function get_countries()
	{
		$query = "SELECT * from country";

		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute();

		return $resultado->fetchAll(PDO::FETCH_OBJ);
		$resultado->closeCursor();
	}

	public function get_city()
	{
		$query = "SELECT * from city";

		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute();

		return $resultado->fetchAll(PDO::FETCH_OBJ);
		$resultado->closeCursor();
	}

	public function close_connection()
	{
		$this->conexion_db=null;
	}
}
 ?>