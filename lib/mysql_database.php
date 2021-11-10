<?php

/**
	*This PHP Class Creates and Maintains connection to MYSQL Database and also define queries for database access
	*
	*/

class Database{
    private $connection ;
   
    
    /**
     * Class Constructor 
     * 
     */
    public function __construct(){
        $this ->open_connection();      
    }

    /**
     * Strips malicious tags off any input data 
     * @param mixed $value data to be escaped
     * @return mixed Escaped data
     */
    
    public function escape_value($value){
            
        $value = strip_tags(stripslashes($value));
        $value = mysqli_real_escape_string($this->connection, $value);
    
        return $value;
    
    }
    /**
     * Creates a Database Connection
     * @param string DB_SERVER a host address constant defined in the config file
     * @param string DB_USER Mysql connection username constant defined in the config file
     * @param string DB_PASS Mysql connection password constant define in the config file
     * @return mixed Mysql connection object or null
     */
    
    public function open_connection(){
        $this ->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS);
        if(!$this ->connection){
            die("Database Conection Failed" . mysqli_error($this->connection));
         }else{
            $db_select_db = mysqli_select_db($this->connection, DB_NAME);
            if(!$db_select_db){
                die("Database Selection Failed" . mysqli_error($this->connection));
            }
         }
        
    }
    
    /**
     * Closes an existing Database Connection
     * 
     */

    public function close_connection(){
        if(isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }
    
    public function query($sql){
        $this->last_query = $sql;
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }
    
    private function confirm_query($result){
    if(!$result){
    $output = "Database Error. Please contact the Administrator! ";
    die($output);     
         }   
    } 
    
    public function affected_rows(){
        return mysqli_affected_rows($this->connection);
     
    }
    
    public function num_rows($result_set){
        return mysqli_num_rows($result_set);
    }
    
     
    public function fetch_array($result_set){
    return mysqli_fetch_array($result_set);
    }
    
    
    public function insert_id(){
      return mysqli_insert_id($this->connection);  
    }
    
}

/**
     * Instantiate the Database class
     * 
     */

$database = new Database();



 ?>