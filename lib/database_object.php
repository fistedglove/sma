<?php 
class databaseObject{
    
    protected static $table_name = NULL;
    protected $id = "";

    
  
    
    public static function find_by_sql($sql= "" ){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set)){
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    
    
    }
    
    
    public static function find_all(){
        return static::find_by_sql("SELECT * FROM " .  static::$table_name);
    }
    
    public static function find_by_id($id){
        $result_array =  static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id ={$id} LIMIT 1 "  );
       return !empty($result_array) ? array_shift($result_array): false;
    
    }
    
    public function find_by_($query_str = ""){
        return static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE " . $query_str);
        
    }
    
    public static function count(){
        global $database;
        $result = $database->query('SELECT count(*) FROM '. static::$table_name);
        $row = $database->fetch_array($result);
        return array_shift($row);  
    }
    
    
    public static function instantiate($record){
        $object = new static;
        foreach($record as $attribute => $value){
            if($object->has_attribute($attribute)){
                $object->$attribute = ucfirst(strtolower($value));
            }
        }
        return $object;    
        
    }
    
    protected function has_attribute($attribute){
        return array_key_exists($attribute, $this->attributes());
        
    }
    
   protected function attributes(){
        $attributes = array();
        foreach($this->db_fields as $field){
            if(property_exists($this, $field)){
                $attributes[$field] = $this->$field;
            }
            
        }
        return $attributes;
    }
    
    
    
    protected function sanitized_attributes(){
        global $database;
        $clean_attributes = array();
        foreach($this->attributes() as $key => $value){
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }
    
    public static function set_db_fields()
    {
        global $database;
        $result = $database->query("SHOW COLUMNS FROM " . static::$table_name);
    
    if(mysqli_num_rows($result)>0){
        while($row = $database->fetch_array($result)){
        $db_field[] = array_shift($row);  
      }
      return $db_field;
    }
}

    public function save(){
        return isset($this->id)? $this->update(): $this->create();
    }
    
    public function create(){
        global $database;
        $attributes = $this->sanitized_attributes();
        $query = "INSERT INTO " . static::$table_name. " SET ";

        foreach($attributes as $key => $value){
            $query .=  "$key = '$value', ";
        }
    
        $query = substr($query, 0, -2);

        print_r($query);

        
       $result = $database->query($query);
        if(!$result){
        echo "Error while Creating Student in Database <br />";
        }else{
            return $this->id = $database->insert_id();
            
        }
       
    
        
    }
    
      public function update(){
        global $database;
        $attributes = $this->sanitized_attributes();
        $query = "UPDATE " . static::$table_name. " SET ";
      
        foreach($attributes as $key => $value){
            $query .=  "$key = '$value', ";
        }

        $query = substr($query, 0, -2);

        $query.= " WHERE id = " . $database->escape_value($this->id). " LIMIT 1";
        
        $result = $database->query($query);
        if(!$result){
        echo "Error while updating Student in Database <br />";
        }else{
            
            return ($database->affected_rows() ==1)? true : false;
        }
       
    }
    
      public function delete(){
        global $database;
        $query = "DELETE FROM ". static::$table_name; 
        $query.= " WHERE id = ". $database->escape_value($this->id);
        
      $result = $database->query($query);
        if(!$result){
        echo "Error while deleting Student in Database <br />";
        }else{
            echo "Successfully deleted student<br />";
            return ($database->affected_rows()==1)? true : false;
            
        }
       

        
  }
    
     
}




?>