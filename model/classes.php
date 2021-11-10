<?php

class classes extends DatabaseObject{
    
    public $id;
    public $title;
    public $teacher_id;
    
    
    protected $db_fields;
    protected static $table_name = 'classes';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
 
  
 }

 
?>