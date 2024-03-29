<?php 

	/**
	 * 
	 */
	require_once 'app/libs/component.php';
	require_once 'app/libs/obj_film_list.php';
	require_once 'app/libs/obj_categoria.php';
	
	class Index extends Component
	{
		private $film_list = array();
		private $categorias = array();
		private $pag_actual;
		private $total_pags;
		private $total_reg;
		private $pag_size;
		private $cat_actual;
		private $busqueda_actual;


		function __construct(){
			parent::__construct();
		}
		
		public function render(){
			$this->get_film_list();
			$this->get_categorias();
			require_once __DIR__ . '/index_view.php';
		}

		public function login(){
			$user = htmlentities(addslashes($_POST["l_user"]));
			$pass = htmlentities(addslashes($_POST["l_pass"]));
			$cont = 0;

			$query = "SELECT password,profile_pic FROM customer WHERE username = :user";
			$resultado = $this->conexion_db->prepare($query);
			$resultado->execute(array(':user' => $user));

			while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
				if (password_verify($pass,$registro["password"])) {
					$cont++;
					$this->session_username = $user;
					$this->session_profile_pic = ($registro["profile_pic"] != '')?$registro["profile_pic"]:'default.jpg';

					//checking remember me
					if (isset($_POST["l_remember"])) {
						setcookie("c_username",$_POST["l_user"],time()+50000);
					}
					$_SESSION["user"] = $this->session_username;
					$_SESSION["profile"] = $this->session_profile_pic;
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
				header("location:/sakila/index");
		}

		private function get_film_list(){
			$pag_init = ($this->pag_actual - 1)*$this->pag_size;

			if (isset($this->busqueda_actual)) {
				$query = 
				"SELECT FID FROM film_list 
				WHERE title LIKE '%". $this->busqueda_actual . "%'";
				
				$query2 = 
				"SELECT * FROM film_list 
				WHERE title LIKE '%" . $this->busqueda_actual . "%'
				ORDER BY FID LIMIT $pag_init,$this->pag_size";
			}		
			else if(isset($this->cat_actual)) {
				$query = 
				"SELECT FID FROM film_list 
				WHERE category = '$this->cat_actual'";
				
				$query2 = 
				"SELECT * FROM film_list 
				WHERE category = '$this->cat_actual' ORDER BY FID LIMIT $pag_init,$this->pag_size";
			}else{
				$query = 
				"SELECT FID FROM film_list";

				$query2 = 
				"SELECT * FROM film_list 
				 ORDER BY FID LIMIT $pag_init,$this->pag_size";
			}

			$resultado = $this->conexion_db->prepare($query);
			$resultado->execute();


			$this->total_reg = $resultado->rowCount();
			$this->total_pags = ceil($this->total_reg / $this->pag_size);

			
			$resultado = $this->conexion_db->prepare($query2);
			$resultado->execute();

			$i = 0;
			while ($pelicula = $resultado->fetch(PDO::FETCH_OBJ)) {
				$this->film_list[$i] = $pelicula;
				$i++;
			}
			return $this->film_list;

			$resultado->closeCursor();
			$this->conexion_db=null;
		}

		private function get_categorias(){
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

		private function get_paginacion(){
			$thispage = str_replace('.php', '' , $_SERVER['PHP_SELF'] );
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
				<li class="page-item '. 
					($this->pag_actual - 1 == 0 || $this->total_reg == 0?'disabled':'') . '">
					<a class="page-link" href="' . $this->getPaginationHref( $this->pag_actual - 1 ) . '">
						Previous
					</a>
				</li>'
			);
				for ($i = $pag_min; $i <= $pag_limit; $i++){
					echo('
					<li class="page-item '. ($this->pag_actual == $i ? 'active' : '') . '">
						<a class="page-link" href="' . $this->getPaginationHref($i) . '">' .
							$i . 
						'</a>
					</li>
					');
				}
			echo ('
				<li class="page-item '. ($this->pag_actual == $this->total_pags || $this->total_reg == 0? 'disabled' : '') . '">
					<a class="page-link" href="'. $this->getPaginationHref( $this->pag_actual + 1 ) .'">
						Next
					</a>
				</li>
			</ul>'
			);
		}

		private function getPaginationHref($page){
			$href = '/sakila/page/' . $page;

			if(isset($this->cat_actual))
				$href = '/sakila/category/' . $this->cat_actual . '/' . $page;

			if (isset($this->busqueda_actual))
				$href = '/sakila/search/' . $this->busqueda_actual .'/'. $page;
			
			return $href;
		}

		public function get_results_header(){
			if (isset($this->busqueda_actual)){
				echo ($this->total_reg == 0)
					?('<h3 class="text-light">No films found with "' . $this->busqueda_actual . '" title</h3>')
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

		public function get_film_count(){
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

		public function get_busqueda_actual(){
			return $this->busqueda_actual;
		}

		public function set_busqueda_actual($busqueda){
		 	$this->busqueda_actual = htmlentities(addslashes($busqueda));
		}
	}