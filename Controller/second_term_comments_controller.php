<?php 



class second_term_comments_controller{
    
    
    public $obj;
    
   public function __construct(){
      return $this->obj; 
   }
    
    public function get_view($view = null, $model = null, $id = null){
        
        switch($view){
            
            case 'new':
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
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
    
            
            if(isset($_POST['second_term_comments'])){
                
                
                if(!validate_fields($_POST['second_term_comments'][0])){
                    
                    $session->set_message("Please fill all the fields!");
                    redirect_to("new?id=$id");
                    
                }
                
                $comment_arrays = $_POST['second_term_comments'];
                
                foreach($comment_arrays as $comment_array){
                
                if(validate_fields($comment_array)){
               
            
                $second_term_comments = second_term_comments::instantiate($comment_array);
                $result = Student::find_by_sql("SELECT * FROM second_term_comments WHERE student_id=$second_term_comments->student_id AND class_id=$id");
                $result = array_shift($result);
                                
                if(empty($result)){
                
                    $second_term_comments->create();
                    
                }else{
                    
                    $second_term_comments->id = $result->id;
                    
                    $second_term_comments->update();
                }
                
                }
               
               }   
             
                    $session->set_message("Successfully Created Comment!");
                    redirect_to("new?id=$id");
                
            }
    
            $class_students = Student::find_by_sql("SELECT id, surname, first_name, other_names FROM students WHERE class_id =$id");    
            
            $result = classes::find_by_sql("SELECT title, id FROM classes WHERE id=$id");
            $class = array_shift($result);

            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
            case 'index':
            
            global $database;
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            $result = classes::find_by_sql("SELECT title, id FROM classes WHERE id=$id");
            $class = array_shift($result);
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $found_user = array_shift($result);
            }
            
            if($found_user->status == 'Disabled'){
            $session->logout();   
            $session->set_message("User Account is Disabled. Please contact the System Administrator!");
            redirect_to_login();
            exit; 
                
            }
            
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Teacher'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
        }
            
            
            $current_page = !empty($_GET['page']) ? (int)$_GET['page']: 1;

            $per_page = 2;
            
            $record = second_term_comments::find_by_sql("SELECT * FROM second_term_comments WHERE class_id=$id"); 
                
            $total_count = count($record);
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = "SELECT * FROM second_term_comments WHERE class_id=$id" . '  LIMIT '. $per_page. ' OFFSET ' . $pagination->offset(); 
            
            $comments = second_term_comments::find_by_sql($query);
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
        }
            
        
    }
      
    
}

?>