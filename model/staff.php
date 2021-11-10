<?php

class Staff extends DatabaseObject{
    
    public $id;
    public $surname;
    public $first_name;
    public $full_name;
    public $dob;
    public $gender;
    public $post;
    public $emp_date;
    public $address;
    public $marital_status;
    public $nationality;
    public $status;
    public $mobile;
    public $email_address;
    public $qualifications;
    
    protected $db_fields;
    protected static $table_name = 'staff';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
 
  
 }

 


?>