<?php

class subjects extends DatabaseObject{
    
    public $id;
    public $subject_title;
   
    
    protected $db_fields;
    protected static $table_name = 'subjects';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
 
  
 }

 
?>