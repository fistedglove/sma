<?php
class Payments extends DatabaseObject{
    
    public $id;
    public $student_id;
    public $amount_paid;
    public $amount_due;
    public $teller_number;
    public $term;
    public $date;
    public $remarks;
    
    protected $db_fields;
    protected static $table_name = 'Payments';
    
    
    public function __construct(){
    
        $this->db_fields = static::set_db_fields();
    }
  
 
  
 }

 



?>