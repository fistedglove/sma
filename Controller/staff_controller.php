<?php

class staff_controller{
    
    
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

            $result = users::find_by_sql("SELECT staff_id, type,status FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);}
             
            if($found_user->status == 'Disabled'){
            $session->logout();   
            $session->set_message("User Account is Disabled. Please contact the System Administrator!");
            redirect_to_login();
            exit; 
                
            }
              
            $staff = Staff::find_by_id($found_user->staff_id);  
          
          if($found_user->type == 'Hr'){
            $staff = Staff::find_by_id($id);
            
           }
        
            if($found_user->type == 'Accountant'){
            $staff = Staff::find_by_id($id);
            
           }
           
           if($found_user->type == 'Principal'){
            $staff = Staff::find_by_id($id);
            
           }
            
            if($found_user->type == 'Registrar'){
              
             $staff = Staff::find_by_id($id); 
             
            }
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
            
            if($found_user->type != 'Hr'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
        
            
            if (isset($_POST['staff']) && validate_fields($_POST['staff'])){
                
            $_POST['staff']['dob'] = mysql_date_insert($_POST['staff']['dob']);
            
            $_POST['staff']['emp_date'] = mysql_date_insert($_POST['staff']['emp_date']);
            
            $staff = Staff::instantiate($_POST['staff']);   
            $staff->update();
            
            $user = users::find_by_id($session->user_id);
            log_action('Staff Profile Updated', "Profile of $staff->full_name updated by $user->username");
            $session->set_message("Successfully Updated Staff Profile!");
            if (isset($_FILES['staff']) && is_jpeg($_FILES['staff']['type']) && is_valid_size($_FILES['staff']['size'])){
            
                move_uploaded_file($_FILES['staff']['tmp_name'], SITE_ROOT. 'phpsms/photos/staff/'. $staff->id .'.jpg');
                
            }  
                redirect_to("show?id=$staff->id");
               
          } elseif(isset($_POST['staff']) && !validate_fields($_POST['staff'])){
            
            $session->set_message("Please fill all the fields!");
            redirect_to("edit?id=$id");
            
          }           
            $staff = Staff::find_by_id($id);
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
            
            if($found_user->type != 'Hr'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
        
            
            if (isset($_POST['staff'])&& validate_fields($_POST['staff'])){
                
            $_POST['staff']['dob'] = mysql_date_insert($_POST['staff']['dob']);
            
            $_POST['staff']['emp_date'] = mysql_date_insert($_POST['staff']['emp_date']);
            
            $staff = Staff::instantiate($_POST['staff']);
               
            $staff->create();
            $user = users::find_by_id($session->user_id);
            log_action('Staff Profile Created', "Profile of $staff->full_name created by $user->username");
            $session->set_message("Successfull Created Staff Profile!");
            
            if (isset($_FILES['staff']) && is_jpeg($_FILES['staff']['type']) && is_valid_size($_FILES['staff']['size'])){
            
                move_uploaded_file($_FILES['staff']['tmp_name'], SITE_ROOT. 'phpsms/photos/staff/'. $staff->id .'.jpg');
                
            } 
              redirect_to("show?id=$staff->id");
              
               
            }elseif(isset($_POST['staff'])&& !validate_fields($_POST['staff'])){
                
                   $session->set_message("Please fill all the fields!"); 
                    redirect_to('new');
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
            
            if($found_user->type != 'Hr'){
            if($found_user->type != 'Accountant'){
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
           }
          }  
         }

            
            
            $current_page = !empty($_GET['page']) ? (int)$_GET['page']: 1;

            $per_page = 2;

            $total_count = Staff::count();
            
            $status ='';
            
            if(!empty($_GET['status'])){
               
              $status = $_GET['status'];
                
              $staff_count = staff::find_by_sql("SELECT * FROM staff WHERE status ='$status'");  
               
              $total_count = count($staff_count);  
                
            }
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = 'SELECT * FROM Staff LIMIT '. $per_page. ' OFFSET ' . $pagination->offset(); 
            
            if($status != ''){
                
            $query = "SELECT * FROM Staff WHERE status ='$status'". ' LIMIT '. $per_page. ' OFFSET ' . $pagination->offset();
                
            }
           
            $staffs = Staff::find_by_sql($query);
            
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
            
            if($found_user->type != 'Hr'){ 
            if($found_user->type != 'Accountant'){
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
           }
          }  
        }
            if(isset($_POST['surname']) && !empty($_POST['surname'])){
                
            $surname = trim($_POST['surname']);
            $staffs = staff::find_by_sql("SELECT * FROM staff WHERE surname ='$surname'");
            
            $total_count = count($staffs);
            if(!empty($staffs)){
            
            if($total_count <= 1){
                
                $staff = array_shift(staff::find_by_sql("SELECT * FROM staff WHERE surname ='$surname'")) ;
                $session->set_message("Search returns $total_count result");
                redirect_to(WEBSITE.DS.APP_ROOT."/staff/show?id=$staff->id");
                exit;

            }else{
                
               
                $staffs = staff::find_by_sql("SELECT * FROM staff WHERE surname ='$surname'");
                include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
                echo "<div class ='echo'><p>Search returns $total_count results</p></div>";
                exit;
            }
        }elseif(empty($staffs)){
            
                $session->set_message("Staff Not Found!");
                redirect_to("index");
          }
        
        
        }elseif(isset($_POST['surname']) && empty($_POST['surname'])){
                
                redirect_to("index");
                exit;
            }
            
        }
        
        
        
    }
    
    
  }  
    
    





?>