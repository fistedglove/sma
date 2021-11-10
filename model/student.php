<?php 

class Student extends DatabaseObject{
    
    public $id;
    public $surname;
    public $first_name;
    public $other_names;
    public $dob;
    public $gender;
    public $parent_id;
    public $class_id;
    public $house_id;
    public $nationality;
    public $admission_date;
    public $status;
    public $grad_year;
    
    protected $db_fields;
    protected static $table_name = 'students';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
 }

 
?>