<?php 
require_once 'app/libs/component.php';
require_once 'app/libs/obj_staff.php';
require_once 'app/libs/obj_categoria.php';
/**
 * 
 */
class Management extends Component
{
	public $session_staff;

	function __construct()
	{
		parent::__construct();
	}
	public function login(string $username,string $password){
		$user = htmlentities(addslashes($username));
		$pass = htmlentities(addslashes($password));
		$cont = 0;

		$query = "SELECT staff_id,store_id,password,picture FROM staff WHERE username = :user";
		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute(array(':user' => $user));

		while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
			if (password_verify($pass,$registro["password"])) {
				$obj = new Staff();
				$obj->set_id($registro["staff_id"]);
				$obj->set_store_id($registro["store_id"]);
				$obj->set_username($user);
				$obj->set_picture($registro["picture"]);

				//Verificando si es manager
				$query = "SELECT store_id FROM store WHERE manager_staff_id = :staff";
				$if_manager = $this->conexion_db->prepare($query);
				$if_manager->execute(array(":staff" => $user));

				if ($if_manager->rowCount() > 0) {
					$obj->set_is_manager(1);
				}else{
					$obj->set_is_manager(0);
				}
				
				$cont++;
				$this->session_staff = $obj;
			}
		}
		

		return $cont;

		$resultado->closeCursor();
	}
	public function logout(string $cookieSessionName){
		session_destroy();
		if (isset($_COOKIE[$cookieSessionName])) {
			setcookie($cookieSessionName,"",time()-1);
		}
		header("location:index");
	}
	public function new_film($name,$description,$release,$language,$rental,$length,$rating,$first_actor,$category)
	{
		//for film table
		$f_name = htmlentities(addslashes($name));
		$f_desc = htmlentities(addslashes($description));
		$f_release = htmlentities(addslashes($release));
		$f_lang = htmlentities(addslashes($language));
		$f_rent = htmlentities(addslashes($rental));
		$f_length = htmlentities(addslashes($length));
		$f_rtng = htmlentities(addslashes($rating));

		//for film related tables
		$f_actor = htmlentities(addslashes($first_actor));
		$f_category = htmlentities(addslashes($category));

		$query = "INSERT INTO film (title,description,release_year,language_id,rental_rate,length,rating) VALUES (?,?,?,?,?,?,?)";
		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute(array($f_name,$f_desc,$f_release,$f_lang,$f_rent,$f_length,$f_rtng));

		if ($resultado->rowCount() > 0) {
			$query = "INSERT INTO film_actor (film_id,actor_id) VALUES((SELECT film_id FROM film WHERE title = ?),?)";
			$resultado = $this->conexion_db->prepare($query);
			$resultado->execute(array($f_name,$f_actor));
			$query = "INSERT INTO film_category (film_id,category_id) VALUES((SELECT film_id FROM film WHERE title = ?),?)";
			$resultado = $this->conexion_db->prepare($query);
			$resultado->execute(array($f_name,$f_category));

			return 1;
		}
	}
	public function add_stock($store_id,$film_id,$quantity)
	{
		$query = "INSERT INTO inventory (film_id,store_id) VALUES(?,?)";

		$resultado = $this->conexion_db->prepare($query);
		for ($i=0; $i < $quantity; $i++) { 
			$resultado->execute(array($film_id,$store_id));
		}
		return $resultado->rowCount();
	}
	public function get_short_film_list()
	{
		$query = "SELECT film_id,title FROM film ORDER BY film_id DESC";
		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute();

		return $resultado->fetchAll(PDO::FETCH_OBJ);

	}
	public function get_inventory()
	{
		$query = "
		SELECT 
			inventory.film_id, 
			film.title, 
			inventory.store_id, 
			COUNT(*) AS quantity 
		FROM inventory 
		INNER JOIN film ON inventory.film_id = film.film_id 
		WHERE inventory_in_stock(inventory.inventory_id) 
		GROUP BY inventory.film_id, inventory.store_id
		ORDER BY inventory.film_id DESC LIMIT 100";

	    $resultado = $this->conexion_db->prepare($query);
	    $resultado->execute();

	    $i = 0;
	    while ($film_item = $resultado->fetch(PDO::FETCH_OBJ)) {
	    	$inventory[$i] = $film_item;
	    	$i++;
	    }
	    return $inventory;
		$resultado->closeCursor();
	}

	public function get_inventory_by_title($search)
	{
		$inventory = null;
		$film = htmlentities(addslashes($search));
		$query = "
		SELECT 
			inventory.film_id, 
			film.title, 
			inventory.store_id, 
			COUNT(*) AS quantity 
		FROM inventory 
		INNER JOIN film ON inventory.film_id = film.film_id 
		WHERE inventory_in_stock(inventory.inventory_id)
		GROUP BY inventory.film_id, inventory.store_id 
		HAVING film.title LIKE \"%$film%\"
		ORDER BY inventory.film_id DESC LIMIT 100";

	    $resultado = $this->conexion_db->prepare($query);
	    $resultado->execute();

	    $i = 0;
	    while ($film_item = $resultado->fetch(PDO::FETCH_OBJ)) {
	    	$inventory[$i] = $film_item;
	    	$i++;
	    }
	    if ($i>0) {
	    	return $inventory;
	    }else{
	    	return "no founds";
	    }
	    
		$resultado->closeCursor();
	}

	public function get_categories()
	{
		$query = "SELECT * FROM category;";
		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute();

		$i = 0;
		while ($categoria = $resultado->fetch(PDO::FETCH_OBJ)) {
			$obj = new Categoria();
			$obj->set_id($categoria->category_id);
			$obj->set_nombre($categoria->name);

			$categorias[$i] = $obj;
			$i++;
		}
		return $categorias;
		$resultado->closeCursor();
	}
	public function get_languages()
	{
		$query = "SELECT * FROM language;";
		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute();

		$i = 0;
		while ($language = $resultado->fetch(PDO::FETCH_OBJ)) {

			$languages[$i] = $language;
			$i++;
		}
		return $languages;
		$resultado->closeCursor();
	}
	public function get_actors()
	{
		$query = "SELECT * FROM actor;";
		$resultado = $this->conexion_db->prepare($query);
		$resultado->execute();

		$i = 0;
		while ($actor = $resultado->fetch(PDO::FETCH_OBJ)) {
			$actors[$i] = $actor;
			$i++;
		}
		return $actors;
		$resultado->closeCursor();
	}

}

?>