<?php

class default_controller{
    
    
    public $obj;
    
    
    public function get_view($view, $model, $id = null){
        
        switch($view){
           
            case 'index':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);
            }
            
            if($found_user->status == 'Disabled'){
            $session->logout();   
            $session->set_message("User Account is Disabled. Please contact the System Administrator!");
            redirect_to_login();
            exit; 
                
            }
            include_once(VIEW_PATH.'layout'.DS. $found_user->type.DS. 'index.php');
            break;
        
            }

        }
}



?>