<?php 



class third_term_scores_controller{
    
    
    public $obj;
    
   public function __construct(){
      return $this->obj; 
   }
    
    public function get_view($view = null, $model = null, $id = null){
        
        switch($view){
            
            case 'show':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type,status FROM users WHERE id =$user_id");
            $found_user = array_shift($result);}
            
            if($found_user->status == 'Disabled'){
            $session->logout();   
            $session->set_message("User Account is Disabled. Please contact the System Administrator!");
            redirect_to_login();
            exit; 
                
            }
                
            if($found_user->type != 'Teacher'){
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");

            redirect_to_home();
            }
           }
          }  
            $record = third_term_scores::get_result($id);
            

            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            break;
            
            case 'edit':
            global $database;
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type,status FROM users WHERE id =$user_id");
            $found_user = array_shift($result);}
            
            if($found_user->status == 'Disabled'){
            $session->logout();   
            $session->set_message("User Account is Disabled. Please contact the System Administrator!");
            redirect_to_login();
            exit; 
                
            }
            
            if($found_user->type != 'Teacher'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            exit;
            }
            
            if(isset($_GET['sub'])){
                
              $subject = $_GET['sub'];  
            }
            $result = Student::find_by_sql("SELECT id, first_name, surname FROM students WHERE id =$id");
            $student_name = array_shift($result);
            
            $edit_record = third_term_scores::find_by_sql("SELECT * FROM third_term_scores WHERE student_id =$id AND subject_name ='$subject'" );
            
           
            
            if (isset($_POST['third_term_scores']) && validate_fields($_POST['third_term_scores'])){
                
                $third_term_scores = third_term_scores::instantiate($_POST['third_term_scores']);
                
                if($first_score = $database->fetch_array($database->query("SELECT test_score + exam_score FROM first_term_scores WHERE student_id ='$third_term_scores->student_id' AND subject_name ='$third_term_scores->subject_name'"))){
                
                $first_score = array_shift($first_score);
                
                $third_term_scores->first_term_score = $first_score;
                
                
            }else{
                
                $third_term_scores->first_term_score = 0;
                
            }
            
            if($second_score = $database->fetch_array($database->query("SELECT test_score + exam_score FROM second_term_scores WHERE student_id ='$third_term_scores->student_id' AND subject_name ='$third_term_scores->subject_name'"))){
                
                $second_score = array_shift($second_score);
                
               $third_term_scores->second_term_score = $second_score; 
                
            }else{
                
                
                $third_term_scores->second_term_score = 0;
            }
            
                
                $third_term_scores->update();
              
                $session->set_message("Successfully Updated student result!");
                redirect_to("show?id=$id");
                
            }elseif(isset($_POST['third_term_scores']) && !validate_fields($_POST['third_term_scores'])){
                
                $session->set_message("Please fill all the fields!");
                
            }
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            break;
            
            case 'new':
            
            global $database;
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type,status FROM users WHERE id =$user_id");
            $found_user = array_shift($result);}
            
            if($found_user->status == 'Disabled'){
            $session->logout();   
            $session->set_message("User Account is Disabled. Please contact the System Administrator!");
            redirect_to_login();
            exit; 
                
            }
            
            if($found_user->type != 'Teacher'){
                
            $session->set_message("You don't have the permission to view that page. Please log in as Administrator!");
            redirect_to_home();
            }
        
             
            if (isset($_POST['third_term_scores']) && validate_fields($_POST['third_term_scores'])){
           
      
            $third_term_scores = third_term_scores::instantiate($_POST['third_term_scores']); 
            
            $result  = third_term_scores::find_by_sql("SELECT * FROM third_term_scores WHERE student_id ='$third_term_scores->student_id' AND subject_name ='$third_term_scores->subject_name'");
            $result_record = array_shift($result);
            
            
            if($first_score = $database->fetch_array($database->query("SELECT test_score + exam_score FROM first_term_scores WHERE student_id ='$third_term_scores->student_id' AND subject_name ='$third_term_scores->subject_name'"))){
                
                $first_score = array_shift($first_score);
                
                $third_term_scores->first_term_score = $first_score;
                
                
            }else{
                
                $third_term_scores->first_term_score = 0;
                
            }
            
            if($second_score = $database->fetch_array($database->query("SELECT test_score + exam_score FROM second_term_scores WHERE student_id ='$third_term_scores->student_id' AND subject_name ='$third_term_scores->subject_name'"))){
                
                $second_score = array_shift($second_score);
                
               $third_term_scores->second_term_score = $second_score; 
                
            }else{
                
                
                $third_term_scores->second_term_score = 0;
            }
            
            
            
            
             
            if(empty($result_record)){
                
               $third_term_scores->create();
               
            $stud = Student::find_by_id($third_term_scores->student_id);
            
            $subjects = Subjects::find_all();
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            echo "<div class ='echoResult'><p>Successfully Created Student Score!</p></div>";
            exit;
            
            }else{
                
                $third_term_scores->id = $result_record->id;
                
                $third_term_scores->update();
                $stud = Student::find_by_id($id);
            
            $subjects = Subjects::find_all();
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            echo "<div class ='echoResult'><p>Successfully Updated Student score!</p></div>";
            exit;
      
            }
            
        }elseif(isset($_POST['third_term_scores']) && !validate_fields($_POST['third_term_scores'])){
            
            if(isset($_POST['third_term_scores']['student_id'])){
                
                $id = $_POST['third_term_scores']['student_id'];
            
            $session->set_message("Please fill all the fields!");
            redirect_to("new?id=$id");
           }
         
          }
            $stud = Student::find_by_id($id);
          
            $subjects = Subjects::find_all();
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            break;
            
            
        }
            
        
    }
      
    
}

?>