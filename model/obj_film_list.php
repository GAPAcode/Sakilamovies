<?php 
	
	/**
	 * contiene los datos mas importantes de la tabla de peliculas (film)
	 */
	class pelicula_simple
	{
		private $id;
		private $titulo;
		private $descripcion;
		private $categoria;
		private $precio;
		private $duracion;
		private $clasificacion;
		private $actores;
		function __construct()
		{
		}

		public function set_id($id){
			$this->id = $id;
		}

		public function get_id(){
			return $this->id;
		}

		public function set_titulo($titulo){
			$this->titulo = $titulo;
		}

		public function get_titulo(){
			return $this->titulo;
		}

		public function set_descripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function get_descripcion(){
			return $this->descripcion;
		}

		public function set_categoria($categoria){
			$this->categoria = $categoria;
		}

		public function get_categoria(){
			return $this->categoria;
		}

		public function set_precio($precio){
			$this->precio = $precio;
		}

		public function get_precio(){
			return $this->precio;
		}

		public function set_duracion($duracion){
			$this->duracion = $duracion;
		}

		public function get_duracion(){
			return $this->duracion;
		}

		public function set_clasificacion($clasificacion){
			$this->clasificacion = $clasificacion;
		}

		public function get_clasificacion(){
			return $this->clasificacion;
		}
		
		public function set_actores($actores){
			$this->actores = $actores;
		}

		public function get_actores(){
			return $this->actores;
		}
	}

 ?>