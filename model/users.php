<?php

class users extends DatabaseObject{
    
    public $id;
    public $username;
    public $password;
    public $type;
    public $status;
    public $staff_id;
    
    protected $db_fields;
    protected static $table_name = 'users';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
    public static function authenticate($username = "", $password = ""){
        
        if($username != null && $password != null){
        $user = users::find_by_sql("SELECT * FROM users 
                                                        WHERE username ='$username' 
                                                        AND password ='$password' LIMIT 1");
        
        return !empty($user)? array_shift($user): false;
        
        }
    }
  
  
 }

 
?>