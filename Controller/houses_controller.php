<?php

class Houses_controller{
    
    
    public $obj;
    
   public function __construct(){
      return $this->obj; 
   }
    
    public function get_view($view = null, $model = null, $id = null){
        
        switch($view){
            
            case 'edit':
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
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
        }
            
            if (isset($_POST['houses']) && validate_fields($_POST['houses'])){
    
             $houses = houses::instantiate($_POST['houses']);   
                $houses->update();
             
               $session->set_message("Successfully Updated House Details!");
               redirect_to("index");
           
          } elseif(isset($_POST['houses']) && !validate_fields($_POST['houses'])){
            
            $id = $_POST['houses']['id'];
            $session->set_message("Please fill all the fields!");
            redirect_to("edit?id=$id");
            }
            
            $house = houses::find_by_id($id);
            
            $leader = Staff::find_by_id($house->house_leader);
            
            $staffs = Staff::find_by_sql("SELECT full_name, id FROM staff WHERE status ='Active'");
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
            case 'new':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login(); exit;}
            $staffs = Staff::find_all();
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
            
            
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            exit;
            }
           
            if (isset($_POST['houses']) && validate_fields($_POST['houses'])){
    
             $houses = houses::instantiate($_POST['houses']);   
                $houses->create();
             
               $session->set_message("Successfully Created House Details!");
               redirect_to("index");
           
          } elseif(isset($_POST['houses']) && !validate_fields($_POST['houses'])){
            
            $session->set_message("Please fill all the fields!");
            redirect_to("new");
        }
            
            $staffs = Staff::find_by_sql("SELECT full_name, id FROM staff WHERE status ='Active'");
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
            case 'index':
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

            $per_page = 4;

            $total_count = houses::count();
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = 'SELECT * FROM houses LIMIT '. $per_page. ' OFFSET ' . $pagination->offset(); 
            
            $houses = houses::find_by_sql($query);
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');         
            break;
            
        }
        
        
        
    }
    
    
    
    
    
}




?>