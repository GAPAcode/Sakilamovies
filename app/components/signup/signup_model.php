<?php 

require_once 'app/libs/component.php';

/**
 * 
 */
class Signup extends Component
{
	
	function __construct()
	{
		parent::__construct();
		$this->checkSignupAndSubmitNewCustomer();
	}

	
	private function checkSignupAndSubmitNewCustomer(){
		if (isset($_POST['send'])) {
			$exito = $this->new_customer();
			if ($exito == 1) {
				header("location:/sakila/");
			}
		}
	}
	
	private function new_customer()
	{
		$this->storeImage($_FILES['su_pic']);

		$fname = htmlentities( addslashes( $_POST["su_fname"] ) );
		$lname = htmlentities( addslashes( $_POST["su_lname"] ) );
		$mail = htmlentities( addslashes( $_POST["su_email"] ));
		$user = htmlentities( addslashes( $_POST["su_user"] ));
		$pass = htmlentities(addslashes( $_POST["su_pass"] ));
		$passHash = password_hash( $pass ,PASSWORD_DEFAULT);
		$pic = htmlentities( addslashes( $_FILES['su_pic']["name"] ) );

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
	

	private function storeImage(Array $image) {
		$new_tmp_file = $_SERVER["DOCUMENT_ROOT"] . "/uploads/";
		move_uploaded_file($image["tmp_name"], $new_tmp_file . $image["name"]);
	}
	
	public function render(){
		require_once __DIR__ . '/signup_view.php';
	}
}
?>