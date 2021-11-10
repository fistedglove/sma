<?php

class houses extends DatabaseObject{
    
    public $id;
    public $house_title;
    public $house_leader;
   
    
    protected $db_fields;
    protected static $table_name = 'houses';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
 
  
 }

 
?>