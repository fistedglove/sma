<?php

class Payments_controller{
    
    
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
            
            $result = users::find_by_sql("SELECT type,status FROM users WHERE id =$user_id");}

            $found_user = array_shift($result);
            
            if($found_user->status == 'Disabled'){
            $session->logout();   
            $session->set_message("User Account is Disabled. Please contact the System Administrator!");
            redirect_to_login();
            exit; 
                
            }
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Accountant'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
        }
            $current_page = !empty($_GET['page']) ? (int)$_GET['page']: 1;

            $per_page = 1;
            
             $student_count = Payments::find_by_sql("SELECT * FROM payments WHERE student_id =$id");   
                
            $total_count = count($student_count);
            
            $pagination = new Pagination($per_page, $current_page, $total_count);
            
            $query = 'SELECT * FROM payments WHERE student_id ='.$id.' ORDER BY term ASC LIMIT '. $per_page. ' OFFSET ' . $pagination->offset(); 
            
            $payments = Payments::find_by_sql($query);
            
            if(!empty($payments)){
                
               $payment = $payments['0']; 
            }
            
            
            
            if(isset($payment)){

                $result = Student::find_by_sql("SELECT surname, id, first_name FROM students WHERE id=".$payment->student_id);
                
                 $std_name = array_shift($result);
            }
            
           
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
            case 'new':
            global $session;
            if(!$session->is_logged_in()){redirect_to_login();}
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
            
            if($found_user->type != 'Accountant'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
            if(isset($_POST['payments'])&& validate_fields($_POST['payments'])){
            
            $_POST['payments']['amount_paid'] = format_money($_POST['payments']['amount_paid']);
            
            $_POST['payments']['amount_due'] = format_money($_POST['payments']['amount_due']);    
             
            
            $_POST['payments']['date'] = mysql_date_insert($_POST['payments']['date']);
            $std_id = $_POST['payments']['student_id'];
            $payments = Payments::instantiate($_POST['payments']);
            $payments->create();
            $session->set_message("Successful Entry of Student Payments details!");
            redirect_to("show?id=$std_id");         
              
            }elseif(isset($_POST['payments']) && !validate_fields($_POST['payments'])){
                
               $session->set_message("Please fill all the fields!");
               redirect_to("new");
                
            }
            
            $classes = classes::find_all();
            if(!empty($_POST['class'])){ 
                    $class_title = $_POST['class'];
             
             $std_class = classes::find_by_id($class_title);
            
            $students = Student::find_by_sql("Select first_name, surname, id FROM students WHERE class_id =$class_title");
           
           }elseif(empty($_POST['class'])){
            
            $students = Student::find_all();
           
           }
           
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
        }
        
        
        
    }
    
    
    
    
    
}




?>