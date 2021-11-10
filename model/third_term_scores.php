<?php 

class Third_term_scores extends DatabaseObject{
    
    
    public $id;
    public $student_id; 
    public $subject_name;
    public $test_score;
    public $exam_score;
    public $total_score;
    public $first_term_score;
    public $second_term_score;
    public $average_score;
    public $grade;
    public $effort;
    public $teacher_comment;
    
    protected $db_fields;
    protected static $table_name = 'third_term_scores';
    
    
    public function __construct(){
        
        $this->db_fields = static::set_db_fields();
    }
  
  
    public static function get_result($student_id = null){
        
        global $database;
        $query = '
                SELECT students.id, surname, first_name, other_names, attendance, house_title, classes.title, remark, subject_name, 
                test_score, exam_score, test_score+exam_score AS total_score, grade, first_term_score, second_term_score, 
                (first_term_score + second_term_score + test_score + exam_score)/3 AS average_score, effort, teacher_comment
                FROM students, houses, third_term_comments, third_term_scores, classes
                WHERE third_term_scores.student_id = students.id
                AND students.class_id = classes.id
                AND students.house_id = houses.id
                AND third_term_comments.student_id = students.id';
                
                
                if($student_id != null) {
            
            $query.= " AND students.id=$student_id";
            
            } 
                
                
            $query .=' GROUP BY subject_name ORDER BY id ASC';
                
        
        
        
             
         $result_array = array();        
        $result = $database->query($query);
        while($row = $database->fetch_array($result)){
            
            $result_array[] = $row;
        }
        
        return $result_array;
        
    }
 
  
 }


?>