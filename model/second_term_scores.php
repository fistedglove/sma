<?php 

class Second_term_scores extends DatabaseObject{
    
    
    public $id;
    public $student_id; 
    public $subject_name;
    public $test_score;
    public $exam_score;
    public $total_score;
    public $grade;
    public $effort;
    public $teacher_comment;
    
    protected $db_fields;
    protected static $table_name = 'second_term_scores';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
  
    public static function get_result($student_id = null, $class_id = null, $limit = null, $offset = null){
        
        global $database;
        $query = '
                SELECT students.id, surname, first_name, other_names, attendance, house_title, classes.title, remark, subject_name, test_score, exam_score, test_score+exam_score AS total_score, grade, effort, teacher_comment
                FROM students, houses, second_term_comments, second_term_scores, classes
                WHERE second_term_scores.student_id = students.id
                AND students.class_id = classes.id
                AND students.house_id = houses.id
                AND second_term_comments.student_id = students.id';
                
                
          if($student_id != null) {
            
            $query.= " AND students.id=$student_id";
            
            } 
              
          if($class_id != null) {
            
            $query.= " AND classes.id=$class_id GROUP BY students.id ";
            
            }   
            
          if($limit != null) {
            
            $query.= " LIMIT ". $limit;
            
            } 
            
          if($offset != null) {
            
            $query.= " OFFSET ".$offset ;
            
            }  
             
         $result_array = array();        
        $result = $database->query($query);
        while($row = $database->fetch_array($result)){
            
            $result_array[] = $row;
        }
        
        return $result_array;
        
    }
 
  
 }


?>