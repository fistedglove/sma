<?php 

class Third_term_comments extends DatabaseObject{
    
    public $id;
    public $student_id; 
    public $remark;
    public $class_id;
    public $attendance;
    public $academic_year;
    
    protected $db_fields;
    protected static $table_name = 'third_term_comments';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
 
  
 }


?>