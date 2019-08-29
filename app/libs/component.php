<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/obj_connection.php';

abstract class Component {
    protected $conexion_db;
    protected $user_id;
    protected $session_username;
    protected $session_profile_pic;

    function __construct(){
        $conexionObj = new Conexion();
        $this->conexion_db =  $conexionObj->getDatabaseConnection();

        session_start();

        if ( isset($_SESSION['user']) && isset( $_SESSION['profile'] ) ) {
            $this->session_username = $_SESSION['user'];
            $this->session_profile_pic = $_SESSION['profile'];
            $this->user_id = $this->getUserId();
        }
    }

    private function getUserId(){
        $query = 'SELECT customer_id FROM customer WHERE username = :username';

        $resultado = $this->conexion_db->prepare($query);
        $resultado->execute(array(':username' => $this->session_username));
        
        $id = $resultado->fetch(PDO::FETCH_ASSOC);

        return $id['customer_id'];
    }
    
    public function get_navbar(){
        $username = null;
        if (isset($this->session_username)) {
            $username = $this->session_username;
            $prof_pic = $this->session_profile_pic;
        }

        include_once 'app/templates/navbar.php';
    }

    public function get_session_profile_pic(){
        return $this->session_profile_pic;
    }

    public function get_session_username(){
        return $this->session_username;
    }
}