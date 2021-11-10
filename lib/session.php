<?php

/**
	* This PHP Script Contains the Session Class.
	*
	*/

class Session{
    
    private $logged_in;
    public $user_id;
    private $message;
    private $academic_year;
    
    /**
	* Class Constructor. Start the session and initialize class properties
	*/
    function __construct(){
        session_start();
        $this->check_login();
        $this->check_message();
    }
    
    /**
	* Assigns User Login status to the $loggedin class property
	*
	*/
    private function check_login(){
        
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;    
        }else{
            
            unset($this->user_id);
            $this->logged_in = false;
        }   
        
    }

    /**
	* Check if user is Logged in
	* @return boolean
	*/ 
    public function is_logged_in(){
           
        return $this->logged_in;
    }
    
    /**
	* Log a User In
	*/
    public function login($user){
        
       if($user){
        $this->user_id = $_SESSION['user_id'] = $user->id;
        $this->logged_in = true;
       } 
        
    }
    
    /**
	* Log a User Out
	*/
    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->logged_in = false;
        
    }
    
    /**
	* Retrieves flashed status Messages
	* @return string 
	*/
    public function get_message(){
         
        return $this->message;
    }
    
    /**
	* Flash status message in SESSION
	*/
    public function set_message($msg){
    
        $_SESSION['message'] = $msg;
        
    }
    
    /**
	* Retrieves Academic Year in Session and assign to the class property
	* @return string 
	*/
    
    public function academic_year(){
        
        $this->academic_year  = $_SESSION['academic_year'];
        
        return $this->academic_year;
    }
    
    /**
	* Assigns flashed status message to the class $message property
	*/
    public function check_message(){
        
        if(isset($_SESSION['message'])){
            
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            
            $this->message = "";
        }
        
    }
}

$session = new Session();

?>


