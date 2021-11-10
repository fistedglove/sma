<?php

class Parents_controller{
    
    
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
            $found_user = array_shift($result);
            }
            
            if($found_user->status == 'Disabled'){
            $session->logout();   
            $session->set_message("User Account is Disabled. Please contact the System Administrator!");
            redirect_to_login();
            exit; 
                
            }
            
            
            if($found_user->type != 'Accountant'){
              
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
           }  
         }   
            $parent = Parents::find_by_id($id);
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');

            break;
            
            case 'edit':
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
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
        
            
            if(isset($_POST['parents'])){
            
            $parent_id = $_POST['parents']['id'];
            
            if (isset($_POST['parents']) && validate_fields($_POST['parents'])){
            $parent = Parents::instantiate($_POST['parents']);   
            $parent->update(); 
            if (isset($_FILES['parent']) && is_jpeg($_FILES['parent']['type']) && is_valid_size($_FILES['parent']['size'])){
            
        move_uploaded_file($_FILES['parent']['tmp_name'], SITE_ROOT. 'phpsms/photos/parents/'. $parent->id .'.jpg');
                
            }  
            
                $user = users::find_by_id($session->user_id);
                log_action('Parent Profile Update', "Profile of $parent->full_name updated by $user->username");
                $session->set_message("Successfully Updated Parent Details!");
                redirect_to("show?id=$parent->id");
                
          }elseif(isset($_POST['parents']) && !validate_fields($_POST['parents'])){
            
            $session->set_message("Please fill all the fields!");
            redirect_to("edit?id=$parent_id");
          }
        }   
            $parent = Parents::find_by_id($id);
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');

            break;
            
            case 'new':
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
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
            
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
            
            if($found_user->type != 'Accountant'){
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
           } 
         }   
         
            
            $current_page = !empty($_GET['page']) ? (int)$_GET['page']: 1;

            $per_page = 1;

            $total_count = Parents::count();
            
            $status ='';
            
            if(!empty($_GET['status'])){
               
              $status = $_GET['status'];
                
              $parent_count = Parents::find_by_sql("SELECT * FROM parents WHERE status ='$status'");  
               
              $total_count = count($parent_count);  
                
            }
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = 'SELECT * FROM parents LIMIT '. $per_page. ' OFFSET ' . $pagination->offset(); 
            
             if($status != ''){
                
            $query = "SELECT * FROM Parents WHERE status ='$status'". ' LIMIT '. $per_page. ' OFFSET ' . $pagination->offset();
                
            }
            
            $parents = Parents::find_by_sql($query);
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
            case 'students':
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
            
            if($found_user->type != 'Accountant'){
             
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
           }
            
         }   
            $result = Parents::find_by_sql("SELECT full_name FROM parents WHERE id =$id");
            $parent = array_shift($result);
            
            $current_page = !empty($_GET['page']) ? (int)$_GET['page']: 1;

            $per_page = 2;
            
            $student = Student::find_by_sql("SELECT * FROM students WHERE parent_id =$id");

            $total_count = count($student);
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = "SELECT * FROM students WHERE parent_id =$id". ' LIMIT '. $per_page. ' OFFSET ' . $pagination->offset(); 
            
            $students = Student::find_by_sql($query);
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');         
            break;
            
            case 'search':
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
            
            if($found_user->type != 'Accountant'){
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
           }  
         }  
        
            if(isset($_POST['surname']) && !empty($_POST['surname'])){
                
            $surname = trim($_POST['surname']);
            $parents = Parents::find_by_sql("SELECT * FROM parents WHERE surname ='$surname'");
            
            $total_count = count($parents);
            
            if(!empty($parents)){
            
            if($total_count <= 1){
                
                $parent = array_shift(Parents::find_by_sql("SELECT * FROM parents WHERE surname ='$surname'")) ;
                $session->set_message("Search returns $total_count result");
                redirect_to(WEBSITE.DS.APP_ROOT."/parents/show?id=$parent->id");
                exit;

            }else{
                
               
                $parents = Parents::find_by_sql("SELECT * FROM parents WHERE surname ='$surname'");
                include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
                echo "<div class ='echo'><p>Search returns $total_count results</p></div>";
                exit;
            }
            
          }elseif(empty($parents)){
            
                $session->set_message("Parent Not Found!");
                redirect_to("index");
          }
          
            }elseif(isset($_POST['surname']) && empty($_POST['surname'])){
                
               
                redirect_to(WEBSITE.DS.APP_ROOT."/parents/");
                exit;
            }
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
          
            break;
            
        }
        
        
        
        
    }
    
    
    
    
    
}




?>