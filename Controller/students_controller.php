<?php

class students_controller{
    
    
    public $obj;
    public $pagination;
    
   public function __construct(){
      return $this->obj; 
   }
    
    public function get_view($view = null, $model = null, $id = null){
        global $database;
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
                
            if($found_user->type != 'Teacher'){
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
           }
          }  
         }   


            if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            
            $result = users::find_by_sql("SELECT type FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);}
        
            $student = Student::find_by_id($id);
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
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

            $classes = classes::find_all();
            $houses = houses::find_all();
            $parents = Parents::find_all();
            
            if(isset($_POST['students'])){

            if($_POST['students']['grad_year'] == ''){$_POST['students']['grad_year'] = 1;}
            
            if (isset($_POST['students']) && validate_fields($_POST['students'])){
                
            if(($_POST['students']['grad_year']) == 1){$_POST['students']['grad_year'] = null;}
            
              $_POST['students']['dob'] = mysql_date_insert($_POST['students']['dob']);
              
              if($_POST['students']['grad_year'] != null){
                
              $_POST['students']['grad_year'] = mysql_date_insert($_POST['students']['grad_year']);
              $_POST['students']['status'] = 'Inactive';
             
             }
             $student = Student::instantiate($_POST['students']);   
                
             $user = users::find_by_id($session->user_id);
             $student->update();
             
            log_action('Student Profile Updated', "Profile of $student->surname  $student->first_name updated by $user->username");
                $session->set_message("Successfully Updated Student Profile");
                 
             if (isset($_FILES['student']) && is_jpeg($_FILES['student']['type']) && is_valid_size($_FILES['student']['size'])){
            
             move_uploaded_file($_FILES['student']['tmp_name'], SITE_ROOT. 'phpsms/photos/students/'. $student->id .'.jpg');
                
            } 
                redirect_to("show?id=$student->id");
                
            }elseif(isset($_POST['students']) && !validate_fields($_POST['students'])){
                $session->set_message("Please fill all the fields!");
                redirect_to("edit?id=$id");
                
            }
            
        }
            $student = Student::find_by_id($id);
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            break;
            
            case 'class_students':
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
            

            if($found_user->type != 'Accountant'){
                
            if($found_user->type != 'Teacher'){
            
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
            
            $result = Student::find_by_sql("SELECT * FROM students WHERE class_id ='$id' AND status ='Active'");

            $total_count = count($result);
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = "SELECT * FROM students WHERE class_id ='$id' AND Status ='Active'". " LIMIT ". $per_page . " OFFSET ". $pagination->offset();
            
            $students = Student::find_by_sql($query);
            
            if(!empty($_POST['class'])){ 
                    $class_title = $_POST['class'];
                    
                $result = Student::find_by_sql("SELECT * FROM students WHERE class_id ='$class_title' AND status ='Active'");  
                    redirect_to("class_students?id=$class_title");
                  
                    
                 }
            $result = classes::find_by_sql("SELECT id, title FROM classes WHERE id ='$id'");

            $class = array_shift($result);
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            if($total_count == 1){
                
                echo "<div class ='echoClass'><p>Search found $total_count Student</p></div>";
            }elseif($total_count > 1){
            echo "<div class ='echoClass'><p>Search found $total_count Students</p></div>";
            }
            
            break;
            
            case 'house_members':
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
        

            $current_page = !empty($_GET['page']) ? (int)$_GET['page']: 1;

            $per_page = 2;
            
            $result = Student::find_by_sql("SELECT * FROM students WHERE house_id ='$id'");

            $total_count = count($result);
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = "SELECT * FROM students WHERE house_id ='$id'". " LIMIT ". $per_page . " OFFSET ". $pagination->offset();
            
            $students = Student::find_by_sql($query);
            
            
            $result = houses::find_by_sql("SELECT id, house_title FROM houses WHERE id ='$id'");
            $house = array_shift($result);
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            
            
            if($total_count == 1){
                
                echo "<div class ='echoHouse'><p>Search found $total_count Member</p></div>";
            }elseif($total_count > 1){
            echo "<div class ='echoHouse'><p>Search found $total_count Members</p></div>";
            }
            break;
            
            
            case 'new':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
            $classes = classes::find_all();
            $houses = houses::find_all();
           
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
            }
        
            
            if(isset($_POST['parents']) && validate_fields($_POST['parents'])){
                $parent = Parents::instantiate($_POST['parents']); 
                
                $parent_record = array_shift(Parents::find_by_sql("SELECT id FROM parents 
                                                                                  WHERE surname = '$parent->surname'
                                                                                  AND full_name = '$parent->full_name'" ));
                
                 
             if(empty($parent_record)){
                
              $parent->create();
              
             }else{
                
                $parent->id = $parent_record->id;
                
                $parent->update();                                                                 
                  
            }
            if (isset($_FILES['parent']) && is_jpeg($_FILES['parent']['type']) && is_valid_size($_FILES['parent']['size'])){
                
            move_uploaded_file($_FILES['parent']['tmp_name'], SITE_ROOT. 'phpsms/photos/parents/'. $parent->id .'.jpg');
                    
            }  
               
    
            }elseif(isset($_POST['parents']) && !validate_fields($_POST['parents'])){
                
                $session->set_message("Please fill all the fields!");
                header("Location: http://localhost/phpsms/parents/new");
                exit;
            }
            
            if(isset($_POST['students'])&& validate_fields($_POST['students'])){
                
            $_POST['students']['dob'] = mysql_date_insert($_POST['students']['dob']);
            $_POST['students']['admission_date'] = mysql_date_insert($_POST['students']['admission_date']);
            $student = Student::instantiate($_POST['students']); 
             
             $student_record = $database->fetch_array($database->query("SELECT id FROM students 
                                                                                  WHERE first_name = '$student->first_name' 
                                                                                  AND surname = '$student->surname' 
                
                                                                                  AND other_names = '$student->other_names'" ));
               
               if(empty($student_record)){
                
                $student->create();
                $user = users::find_by_id($session->user_id);
            log_action('New Registration Process', "Registration of $student->surname  $student->first_name performed by $user->username");
               }else{
                
                $student->id = $student_record['id'];
                
                $student->update();
                
                
               }
                 
                if (isset($_FILES['student']) && is_jpeg($_FILES['student']['type']) && is_valid_size($_FILES['student']['size'])){
            
                move_uploaded_file($_FILES['student']['tmp_name'], SITE_ROOT. 'phpsms/photos/students/'. $student->id .'.jpg');
                
             }  
                $session->set_message("Successfully Created New Student Profile!");
                redirect_to("show?id=$student->id");
                exit;
           }

            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            break;
            
            
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
            

            if($found_user->type != 'Accountant'){
                
            if($found_user->type != 'Teacher'){
            
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

            $total_count = Student::count();
            
            $status ='';
            
            if(!empty($_GET['status'])){
               
              $status = $_GET['status'];
                
              $student_count = Student::find_by_sql("SELECT * FROM students WHERE status ='$status'");  
               
              $total_count = count($student_count);  
                
            }
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = 'SELECT * FROM Students LIMIT '. $per_page. ' OFFSET ' . $pagination->offset(); 
            
            if($status != ''){
                
            $query = "SELECT * FROM Students WHERE status ='$status'". ' LIMIT '. $per_page. ' OFFSET ' . $pagination->offset();
                
            }
            
            $classes = classes::find_all();
            $students = Student::find_by_sql($query);
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS. $view. '.php');
            if($total_count == 1){
                
                echo "<div class ='echoStudent'><p>Found $total_count Student</p></div>";
            }elseif($total_count > 1){
            echo "<div class ='echoStudent'><p>Found $total_count Students</p></div>";
            }        
            break;
        
        }
     
    
    }

}


?>