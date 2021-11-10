<?php

class users_controller{
   
    public $obj;
   
   public function __construct(){
      return $this->obj; 
   }
    
    public function get_view($view = null, $model = null, $id = null){
        global $database;
        global $session;
        
        switch($view){
            
            case 'edit':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $found_user = users::find_by_id($user_id);
            
            }
            
            if($found_user->status == 'Disabled'){
                
            $session->set_message("User Account is Disabled. Please contact the System Administrator!");
            redirect_to_login();
            exit; 
                
            }
            
            if(isset($_POST['users']) && validate_fields($_POST['users'])){
                
                $old_password = sha1($_POST['users']['old_password']);
                $confirm_password = sha1($_POST['users']['confirm_password']);
                $new_passsword = sha1($_POST['users']['password']);
                $user_result = array_shift(users::find_by_sql("SELECT username, id FROM users WHERE username ='$found_user->username' AND password ='$old_password'" ));
                
                if(!empty($user_result) && ($new_passsword == $confirm_password)){
                    
                    $_POST['users']['password'] = sha1($_POST['users']['password']);
                    
                    $users = users::instantiate($_POST['users']);
                    $users->id = $user_result->id;
                    $users->status = 'Enabled';
                    $users->update();
                    log_action("Password Change", "$found_user->username has successfully changed password");
                    $session->set_message("Password change successful!");
                    redirect_to(WEBSITE.DS.APP_ROOT."/staff/show?id=$found_user->staff_id");
                    exit;
                    
                }else{
                    
                    $session->set_message("Passwords does not match; check caps lock and try again!");
                    redirect_to("edit");
                }
           }elseif (isset($_POST['users']) && !validate_fields($_POST['users'])){
                
                   $session->set_message("Please fill all the fields!");
                   redirect_to("edit");            
           }     
           
            include_once(VIEW_PATH.'layout'.DS. 'Administrator'.DS.$model. DS. $view. '.php');
            break;
            
            case 'new':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);
            }
            
            if($found_user->type != 'Administrator'){
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
        }
        
            
            if(isset($_POST['users']) && validate_fields($_POST['users'])){
                
                $_POST['users']['password'] = sha1($_POST['users']['password']);
                $users = users::instantiate($_POST['users']);
                
                
                $user_record = array_shift(users::find_by_sql("SELECT username, id FROM users WHERE username ='$users->username' AND staff_id ='$users->staff_id'" ));
                
                if(empty($user_record)){
                    
                $users->create();
                $user = users::find_by_id($session->user_id);
                log_action('New User Account', "New User Account $user->username Created by $username");
                $session->set_message("Successfully Created User Account for $users->username");
                
                redirect_to("index");
                exit;
                
                }else{
                    
                  $users->id = $user_record->id;
                  $users->update();
                  
                  $session->set_message("Successfully Updated User Account for $users->username");  
                  
                  redirect_to("index");
                  exit;
                }
                
                
            }elseif(isset($_POST['users']) && !validate_fields($_POST['users'])){
                
                $session->set_message("Please fill the fields!");
                redirect_to("new");
            }
            
            $staffs = staff::find_all();
            include_once(VIEW_PATH.'layout'.DS. 'Administrator'.DS.$model. DS. $view. '.php');
            break;
            
            case 'edit_user':
            global $database;
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);
            }
            
            if($found_user->type != 'Administrator'){
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
        }
        
        
            
            
            if(isset($_POST['users']) && validate_fields($_POST['users'])){
                
                $users = users::instantiate($_POST['users']);
                
                $database->query("UPDATE USERS SET username ='$users->username', 
                                                   type ='$users->type', 
                                                   staff_id ='$users->staff_id' 
                                                   WHERE id =$users->id");
                
                $session->set_message("Successfully Updated User Account for $users->username");
                
                redirect_to("index");
                
                
                
            }elseif(isset($_POST['users']) && !validate_fields($_POST['users'])){
                
                $id = $_POST['users']['id'];
                $session->set_message("Please fill the fields!");
                redirect_to("edit_user?id=$id");
            }
            
            $user_account = users::find_by_id($id);
            
            $staff_name = Staff::find_by_id($user_account->staff_id);
            $staffs = staff::find_all();
            include_once(VIEW_PATH.'layout'.DS. 'Administrator'.DS.$model. DS. $view. '.php');
            break;
            
            case 'logout':
            global $session;
            $session->logout();   
            $session->set_message("You have logged out successfully!");
            redirect_to("login");
            break;
            
            
            case 'login':
            global $session;
            
            if($session->is_logged_in()){redirect_to_home();}
            
            if(isset($_GET['install'])&& $_GET['install'] == 'true'){
                
                if(file_exists('c:/wamp/www/phpsms/install/install.php')){
                    
                     unlink('c:/wamp/www/phpsms/install/install.php');
                     rmdir('c:/wamp/www/phpsms/install');
                     redirect_to('login');
                     
                }
              
            }
            
            if(isset($_POST['users']) && validate_fields($_POST['users'])){
                
                $username  = $_POST['users']['username'];
                $password = sha1($_POST['users']['password']);
                
                $found_user = users::authenticate($username, $password);
                
                if($found_user){
                
                    if($found_user->status == 'Enabled'){
                    
                    $session->login($found_user);
                    log_action('Login', "$username login successful");
                    $session->set_message("Login Successful: You are welcome " . $found_user->username);
                    switch($found_user->type){
                    
                    case 'Administrator':
                    redirect_to_home();
                    exit;
                    break;
                    
                    case 'Hr':
                    redirect_to_home();
                    exit;
                    break;
                    
                    case 'Teacher':
                    redirect_to_home();
                    exit;
                    break;
                    
                    case 'Principal':
                    redirect_to_home();
                    exit;
                    break;
                  
                    case 'Staff':
                    redirect_to_home();
                    exit;
                    break;
                    
                    case 'Registrar':
                    redirect_to_home();
                    exit;
                    break;
                    
                    case 'Accountant':
                    redirect_to_home();
                    exit;
                    break;
                }    
                    
             }elseif($found_user->status == 'Disabled'){
                
                $session->set_message("User Account is Disabled. Please contact the System Administrator!");
                redirect_to("login");
                
              }
                    
                   
                }elseif(!$found_user){
                   
                    $session->set_message("Username/Password combination is not correct. Check Caps Lock and try again!");
                    redirect_to("login");
                }
                
            }elseif(isset($_POST['users']) && !validate_fields($_POST['users'])){
                   
                  $session->set_message("Username/Password combination is not correct. Check Caps Lock and try again!");    
                  redirect_to("login");
            }
            
            
          
     
            include_once(VIEW_PATH.'layout'.DS. 'Administrator'.DS.$model. DS. $view. '.php');         
            break;
     
            case 'index':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);
            }
            
            if($found_user->type != 'Administrator'){
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
        }
        
            $current_page = !empty($_GET['page']) ? (int)$_GET['page']: 1;

            $per_page = 4;

            $total_count = users::count();
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = 'SELECT * FROM users LIMIT '. $per_page. ' OFFSET ' . $pagination->offset(); 
            
            
            $users = users::find_by_sql($query);
            include_once(VIEW_PATH.'layout'.DS. 'Administrator'.DS.$model. DS. $view. '.php');
            break;
            
            case 'delete':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);
            }
            
            if($found_user->type != 'Administrator'){
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
            $user = users::find_by_id($id);
            if(!empty($user)){
                
                $user->delete();
                $session->set_message("$user->username's account has successfully been deleted!");
                log_action('User Account Deletion', "$user->username's account deleted successfully");
                redirect_to('index');
            }
            
            
            case 'enable':
            global $session;
            global $database;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);
            }
            
            if($found_user->type != 'Administrator'){
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
            $user = users::find_by_id($id);
            if(!empty($user)){
                
                $database->query("UPDATE users SET status ='Enabled' WHERE id =$id");
                log_action('User Account Activation', "$user->username's account enabled successfully");
                $session->set_message("$user->username's account has successfully been enabled!");
                redirect_to('index');
            }
            
            case 'disable':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            
            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);
            }
            
            if($found_user->type != 'Administrator'){
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
            $user = users::find_by_id($id);
            if(!empty($user)){
                
                $database->query("UPDATE users SET status ='Disabled' WHERE id =$id");
                log_action('User Account Deactivation', "$user->username's account disabled successfully");
                $session->set_message("$user->username's account has successfully been disabled!");
                redirect_to('index');
            }
            
            
       }
    
    
    }

}


?>