<?php 

require_once 'app/model/obj_connection.php';

/**
 * 
 */
class signup extends Conexion
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function new_customer($first_name,$last_name,$email,$username,$password,$profile_pic)
	{
		$fname = htmlentities(addslashes($first_name));
		$lname = htmlentities(addslashes($last_name));
		$mail = htmlentities(addslashes($email));
		$user = htmlentities(addslashes($username));
		$pass = htmlentities(addslashes($password));
		$passHash = password_hash($pass,PASSWORD_DEFAULT);
		$pic = htmlentities(addslashes($profile_pic));

		$query = "INSERT INTO customer (store_id,first_name,last_name,email,address_id,active,username,password,profile_pic) VALUES(2,:fname,:lname,:mail,42,1,:user,:pass,:pic)";

		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute(
			array(
			":fname" => $fname, 
			":lname" => $lname,
			":mail" => $mail,
			":user" => $user,
			":pass" => $passHash,
			":pic" => $pic
			)
		);
		return $resultado->rowCount();
		$resultado->closeCursor();
		$this->conexion_db = null;
	}
}
 ?>