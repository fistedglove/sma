<?php 



class teacher_timetable_controller{
    
    
    public $obj;
    
   public function __construct(){
      return $this->obj; 
   }
    
    public function get_view($view = null, $model = null, $id = null){
        
        switch($view){
            
            case 'index':
            
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
        
            $mon_records = Teacher_timetable::mon_sched($id);
            
            $tue_records = Teacher_timetable::tue_sched($id);
            
            $wed_records = Teacher_timetable::wed_sched($id);
            
            $thur_records = Teacher_timetable::thur_sched($id);
            
            $fri_records = Teacher_timetable::fri_sched($id);
            
            $staff = Staff::find_by_id($id);

            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');         
            break;
            
        }
            
        
    }
      
    
}

?>