<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/obj_connection.php';

abstract class Component {
    //types of Components

    protected const DEFAULT_COMPONENT = 'default component';
    protected const MANAGEMENT_COMPONENT = 'management component';

    //component Attributes
    public $componentType;
    protected $conexion_db;
    protected $user_id;
    protected $session_username;
    protected $session_profile_pic;

    function __construct($type = Component::DEFAULT_COMPONENT){
        $this->componentType = $type;
        
        $conexionObj = new Conexion();
        $this->conexion_db =  $conexionObj->getDatabaseConnection();
        session_start();
        
        switch ($type) {
            case Component::DEFAULT_COMPONENT:
                if ( $this->isUserOnSession() ) {
                    $this->session_username = $_SESSION['user'];
                    $this->session_profile_pic = $_SESSION['profile'];
                    $this->user_id = $this->getUserId();
                }
                break;
            case Component::MANAGEMENT_COMPONENT:
                if ( $this->isManagerOnSession() ) {
                    $this->session_username = $_SESSION["user_manager"];
                    $this->session_profile_pic = $_SESSION["user_manager_pic"];
                }
                break;
        }
    }

    public function isUserOnSession () {
        return ( isset( $_SESSION['user'] ) && isset( $_SESSION['profile'] ) );
    }

    public function isManagerOnSession() {
        return ( isset( $_SESSION["user_manager"] ) && isset( $_SESSION["user_manager_pic"] ) );
    }

    private function getUserId(){
        $query = 'SELECT customer_id FROM customer WHERE username = :username';

        $resultado = $this->conexion_db->prepare($query);
        $resultado->execute(array(':username' => $this->session_username));
        
        $id = $resultado->fetch(PDO::FETCH_ASSOC);

        return $id['customer_id'];
    }
    public function get_header(){
        include_once 'app/templates/header.php';
    }

    public function get_navbar(){
        $username = null;
        if (isset($this->session_username)) {
            $username = $this->session_username;
            $prof_pic = $this->session_profile_pic;
        }

        include_once 'app/templates/navbar.php';
    }

    public function getFooter(){
        include_once 'app/templates/footer.php';
    }

    public function get_session_profile_pic(){
        return $this->session_profile_pic;
    }

    public function get_session_username(){
        return $this->session_username;
    }
}