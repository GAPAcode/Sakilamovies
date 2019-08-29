<?php 
	/**
	 * Clase de conexion a la base de datos con PDO
	 */
	class Conexion
	{
		private $conexion_db;
		function __construct()
		{
			$this->conexion_db = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME , DB_USER, DB_PASS);

			$this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conexion_db->exec("SET CHARACTER SET ". DB_CHARSET);
		}

		public function getDatabaseConnection(){
			return $this->conexion_db;
		}
	}
 ?>