<?php 



class second_term_scores_controller{
    
    
    public $obj;
    
   public function __construct(){
      return $this->obj; 
   }
    
    public function get_view($view = null, $model = null, $id = null){
        
        switch($view){
            
            case 'show':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            $record = second_term_scores::get_result($id);
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type,status FROM users WHERE id =$user_id");
            $found_user = array_shift($result);
            } 
            
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
            
            $edit_record = second_term_scores::find_by_sql("SELECT * FROM second_term_scores WHERE student_id =$id AND subject_name ='$subject'" );
            
            
            if (isset($_POST['second_term_scores']) && validate_fields($_POST['second_term_scores'])){
                
                $second_term_scores = second_term_scores::instantiate($_POST['second_term_scores']);
                
                $second_term_scores->update();
                $user = users::find_by_id($session->user_id);
                log_action('Second Term Result', "Second term result for $student_name->surname $student_name->first_name updated by $user->username");
                $session->set_message("Successfully Updated student result!");
                
                redirect_to("show?id=$id");
                
            }else{
                
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
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
        
             
            if (isset($_POST['second_term_scores']) && validate_fields($_POST['second_term_scores'])){
                
                
            $second_term_scores = second_term_scores::instantiate($_POST['second_term_scores']); 
            
            $result = second_term_scores::find_by_sql("SELECT * FROM second_term_scores WHERE student_id ='$second_term_scores->student_id' AND subject_name ='$second_term_scores->subject_name'");
            $result_record =  array_shift($result);
            
            if(empty($result_record)){
                
               $second_term_scores->create();
              
               $stud = Student::find_by_id($id);
            
            $subjects = Subjects::find_all();
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            echo "<div class ='echoResult'><p>Successfully Created Student Score!</p></div>";
            exit;
               
            }else{
                
                $second_term_scores->id = $result_record->id;
                
                $second_term_scores->update();
                
                
                $stud = Student::find_by_id($second_term_scores->student_id);
            
            $subjects = Subjects::find_all();
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            echo "<div class ='echoResult'><p>Successfully Updated Student Score!</p></div>";
            exit;
            }
            
          }elseif(isset($_POST['second_term_scores']) && !validate_fields($_POST['second_term_scores'])){
            
            if(isset($_POST['second_term_scores']['student_id'])){
                
                $id = $_POST['second_term_scores']['student_id'];
            
            $session->set_message("Please fill all the fields!");
            redirect_to("new?id=$id");
            
           }
           
          }
          
            $stud = Student::find_by_id($id);
        
            $subjects = Subjects::find_all();
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            break;
            
            case 'index':
            global $database;
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type,status FROM users WHERE id =$user_id");
            $found_user = array_shift($result);
            }
            
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
            
            $current_page = !empty($_GET['page']) ? (int)$_GET['page']: 1;

            $per_page = 2;
            
            $student_count = second_term_scores::get_result(null, $id);
            
            $class = array_shift(classes::find_by_sql("SELECT id, title FROM classes WHERE id =$id"));

            $total_count = count($student_count);
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $records = second_term_scores::get_result(null, $id, $per_page, $pagination->offset());
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $found_user = array_shift(users::find_by_sql("SELECT type FROM users WHERE id =$user_id"));}
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            break;
            
            
        }
            
        
    }
      
    
}

?>