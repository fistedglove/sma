<?php
class Parents extends DatabaseObject{
    
    public $id;
    public $surname;
    public $full_name;
    public $email_address;
    public $address;
    public $telephone;
    public $mobile;
    public $status;
    
    protected $db_fields;
    protected static $table_name = 'Parents';
    
    
    public function __construct(){
    
        $this->db_fields = static::set_db_fields();
    }
  
 
  
 }

 



?>