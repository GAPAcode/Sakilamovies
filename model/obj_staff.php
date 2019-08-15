<?php 
	/**
	 * 
	 */
	class Staff
	{
		private $id;
		private $store_id;
		private $picture;
		private $username;
		private $is_manager;

		function __construct()
		{
		}

		public function get_id()
		{
			return $this->id;
		}
		public function set_id($id)
		{
			$this->id = $id;
		}
		public function get_store_id()
		{
			return $this->store_id;
		}
		public function set_store_id($store_id)
		{
			$this->store_id = $store_id;
		}
		public function get_picture()
		{
			return $this->picture;
		}
		public function set_picture($picture)
		{
			$this->picture = $picture;
		}
		public function get_username()
		{
			return $this->username;
		}
		public function set_username($username)
		{
			$this->username = $username;
		}
		public function get_password()
		{
			return $this->password;
		}
		public function set_password($password)
		{
			$this->password = $password;
		}
		public function is_manager(){
			return $this->is_manager;
		}
		public function set_is_manager($bool){
			$this->is_manager = $bool;
		}
	}
 ?>