<?php 

class Second_term_comments extends DatabaseObject{
    
    public $id;
    public $student_id; 
    public $class_id;
    public $remark;
    public $attendance;
    public $academic_year;
    
    protected $db_fields;
    protected static $table_name = 'second_term_comments';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
 
  
 }


?>