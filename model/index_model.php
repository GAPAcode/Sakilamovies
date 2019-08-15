<?php 

	/**
	 * 
	 */
	require_once 'model/obj_connection.php';
	require_once 'model/obj_film_list.php';
	require_once 'model/obj_categoria.php';
	
	class index extends Conexion
	{
		private $film_list = array();
		private $categorias = array();
		private $pag_actual;
		private $total_pags;
		private $total_reg;
		private $pag_size;
		private $cat_actual;
		private $busqueda_actual;
		private $session_username;
		private $session_profile_pic;

		function __construct()
		{
			parent::__construct();
		}

		public function login(string $username,string $password){
			$user = htmlentities(addslashes($username));
			$pass = htmlentities(addslashes($password));
			$cont = 0;

			$query = "SELECT password,profile_pic FROM customer WHERE username = :user";
			$resultado = $this->conexion_db->prepare($query);
			$resultado->execute(array(':user' => $user));

			while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
				if (password_verify($pass,$registro["password"])) {
					$cont++;
					$this->session_username = $username;
					$this->session_profile_pic = $registro["profile_pic"];
				}
			}
			

			return $cont;
			$resultado->closeCursor();
			$this->conexion_db=null;
		}

		public function logout(string $cookieSessionName){
				session_destroy();
				if (isset($_COOKIE[$cookieSessionName])) {
					setcookie($cookieSessionName,"",time()-1);
				}
				header("location:index.php");
		}

		public function get_film_list(){
			$pag_init = ($this->pag_actual - 1)*$this->pag_size;

			if (isset($this->busqueda_actual)) {
				$query = "SELECT FID FROM film_list WHERE title LIKE '%". $this->busqueda_actual . "%'";
				$query2 = "SELECT * FROM film_list WHERE title LIKE '%" . $this->busqueda_actual . "%' ORDER BY FID LIMIT $pag_init,$this->pag_size";
			}		
			else if(isset($this->cat_actual)) {
				$query = "SELECT FID FROM film_list WHERE category = '$this->cat_actual'";
				$query2 = "SELECT * FROM film_list WHERE category = '$this->cat_actual' ORDER BY FID LIMIT $pag_init,$this->pag_size";
			}else{
				$query = "SELECT FID FROM film_list";
				$query2 = "SELECT * FROM film_list ORDER BY FID LIMIT $pag_init,$this->pag_size";
			}

			$resultado = $this->conexion_db->prepare($query);
			$resultado->execute();


			$this->total_reg = $resultado->rowCount();
			$this->total_pags = ceil($this->total_reg / $this->pag_size);

			
			$resultado = $this->conexion_db->prepare($query2);
			$resultado->execute();

			$i = 0;
			while ($pelicula = $resultado->fetch(PDO::FETCH_OBJ)) {
				$obj = new pelicula_simple();
				$obj->set_id($pelicula->FID);
				$obj->set_titulo($pelicula->title);
				$obj->set_descripcion($pelicula->description);
				$obj->set_categoria($pelicula->category);
				$obj->set_precio($pelicula->price);
				$obj->set_duracion($pelicula->length);
				$obj->set_clasificacion($pelicula->rating);
				$obj->set_actores($pelicula->actors);

				$this->film_list[$i] = $obj;
				$i++;
			}
			return $this->film_list;

			$resultado->closeCursor();
			$this->conexion_db=null;
		}

		public function get_categorias()
		{
			$query = "SELECT * FROM category;";
			$resultado = $this->conexion_db->prepare($query);
			$resultado->execute();

			$i = 0;
			while ($categoria = $resultado->fetch(PDO::FETCH_OBJ)) {
				$obj = new Categoria();
				$obj->set_id($categoria->category_id);
				$obj->set_nombre($categoria->name);

				$this->categorias[$i] = $obj;
				$i++;
			}
			return $this->categorias;
		}

		public function get_paginacion(){
			$thispage = $_SERVER['PHP_SELF'];
			$pag_min = 1;

			if ($this->total_pags <= $this->pag_size) {
				$pag_limit = $this->total_pags;
				$last_min = $this->total_pags - 1;
				$medio = $this->pag_size / 2;
			}
			else{
				$pag_limit = ($this->pag_size + 1);
				$last_min = $this->pag_size;
				$medio = ceil($this->pag_size / 2);
			}

			if ($this->pag_actual >= $pag_limit) {
				$pag_limit = $this->pag_actual <= $this->total_pags - $medio ? $this->pag_actual + $medio: $this->total_pags;

				$pag_min = $this->pag_actual <= $this->total_pags - $medio ? $this->pag_actual - $medio : $this->total_pags - $last_min;
			}
			echo(
			'<ul class="pagination">
				<li class="page-item '. ($this->pag_actual - 1 == 0?'disabled':'') . '">
					<a class="page-link" href="'. $thispage . '?p=' . ($this->pag_actual - 1) . 
					(isset($this->cat_actual)?'&c=' . $this->cat_actual:'') .
					(isset($this->busqueda_actual)?'&s=' . $this->busqueda_actual:'')
					.'">
						Previous
					</a>
				</li>'
			);
				for ($i = $pag_min; $i <= $pag_limit; $i++){
					echo('
					<li class="page-item '. ($this->pag_actual == $i ? 'active' : '') . '">
						<a class="page-link" href="' . $thispage . '?p=' . $i . 
						(isset($this->cat_actual)?'&c=' . $this->cat_actual:'') . 
						(isset($this->busqueda_actual)?'&s=' . $this->busqueda_actual:'') .'">' .
							$i . 
						'</a>
					</li>
					');
				}
			echo ('
				<li class="page-item '. ($this->pag_actual == $this->total_pags? 'disabled' : '') . '">
					<a class="page-link" href="' . $thispage . '?p=' .  ($this->pag_actual + 1) . 
					(isset($this->cat_actual)?'&c=' . $this->cat_actual:'') .
					(isset($this->busqueda_actual)?'&s=' . $this->busqueda_actual:'') .'">
						Next
					</a>
				</li>
			</ul>'
			);
		}

		public function get_results_header()
		{
			if (isset($this->busqueda_actual)){
				echo ($this->total_reg == 0)
					?('<h3 class="text-light">No films founded with "' . $this->busqueda_actual . '" title</h3>')
					:('<h3 class="text-light">' . $this->total_reg . ' results of ' . $this->busqueda_actual . '</h3>');
			}
		}

		public function get_pag_actual(){
			return $this->pag_actual;
		}

		public function set_pag_actual($pag){
			$this->pag_actual = $pag;
		}

		public function get_pag_size(){
			return $this->pag_size;
		}

		public function set_pag_size($size){
			$this->pag_size = $size;
		}

		public function get_film_count()
		{
			return $this->total_reg;
		}

		public function get_total_pags(){
			return $this->total_pags;
		}

		public function set_categoria_actual($cat){
			$this->cat_actual = $cat;
		}
		public function get_categoria_actual(){
			return $this->cat_actual;
		}

		public function get_busqueda_actual()
		{
			return $this->busqueda_actual;
		}
		public function set_busqueda_actual($busqueda)
		{
		 	$this->busqueda_actual = htmlentities(addslashes($busqueda));
		}
		public function get_session_profile_pic()
		{
			return $this->session_profile_pic;
		}
		public function get_session_username()
		{
			return $this->session_username;
		}
	}
 ?>