<?php 

class class_timetable_controller{
    
    
   public $obj;
    
   public function __construct(){
      return $this->obj; 
   }
    
    public function get_view($view = null, $model = null, $id = null){
        
        switch($view){
            
            case 'edit':
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
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
        }

            if(!empty($_POST)){
                
           if($_POST['mon']['subject'] =='Free'){$_POST['mon']['teacher'] = 'NULL';}
           if($_POST['tue']['subject'] =='Free'){$_POST['tue']['teacher'] = 'NULL';}
           if($_POST['wed']['subject'] =='Free'){$_POST['wed']['teacher'] = 'NULL';}
           if($_POST['thur']['subject'] =='Free'){$_POST['thur']['teacher'] = 'NULL';}
           if($_POST['fri']['subject'] =='Free'){$_POST['fri']['teacher'] = 'NULL';} 
           
           
            
           if(validate_fields($_POST['mon'])){
                
              $periods = $_POST['mon']['periods'];
              $class = $_POST['mon']['class'];
              $subject = $_POST['mon']['subject'];
              $teacher = $_POST['mon']['teacher'];
              
               
              $database->query("UPDATE mon_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher 
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
                
              
            
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("edit?id=$id&period=$periods");
                exit;
            }
            
            
            if(validate_fields($_POST['tue'])){
                
              $periods = $_POST['tue']['periods'];
              $class = $_POST['tue']['class'];
              $subject = $_POST['tue']['subject'];
              $teacher = $_POST['tue']['teacher'];
              
              $database->query("UPDATE tue_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher 
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
            
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("edit?id=$id&period=$periods");
                exit;
            }
            
            if(validate_fields($_POST['wed'])){
                
              $periods = $_POST['wed']['periods'];
              $class = $_POST['wed']['class'];
              $subject = $_POST['wed']['subject'];
              $teacher = $_POST['wed']['teacher'];
             
              $database->query("UPDATE wed_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher 
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
                
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("edit?id=$id&period=$periods");
                exit;
            }
            
            if(validate_fields($_POST['thur'])){
                
              $periods = $_POST['thur']['periods'];
              $class = $_POST['thur']['class'];
              $subject = $_POST['thur']['subject'];
              $teacher = $_POST['thur']['teacher'];
          
              $database->query("UPDATE thur_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("edit?id=$id&period=$periods");
                exit;
            }
            
            if(validate_fields($_POST['fri'])){
                
              $periods = $_POST['fri']['periods'];
              $class = $_POST['fri']['class'];
              $subject = $_POST['fri']['subject'];
              $teacher = $_POST['fri']['teacher'];
              
              
                
              $database->query("UPDATE fri_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
                
            
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("edit?id=$class&period=$periods");
                exit;
            }
            
            $class_log = classes::find_by_id($class);
            
            $user = users::find_by_id($session->user_id);
            log_action('Timetable Update', "Class $class_log->title timetable updated by $user->username");
            $session->set_message("Successfully updated Class Timetable");
            redirect_to(WEBSITE.DS.APP_ROOT."/class_timetable/index?id=$class");
            
        }
            
            
            /* Edit Inputs */
           $period = $_GET['period'];
           $edit_record = Class_timetable::get_timetable($id, $period); 
           
            
            
            
            $period_title = $edit_record[0]['period_title'];
            $result_set = $database->fetch_array($database->query("SELECT id FROM periods WHERE period_title ='$period_title'"));
            $period_id = $result_set['id'];
            
            $class_title = $edit_record[0]['title'];
            $result_set = $database->fetch_array($database->query("SELECT id FROM classes WHERE title ='$class_title'"));
            $class_id = $result_set['id'];
            
            /* Mondays Schedule */
            $mon_subj = $edit_record[0]['mon'];
            $result_set = $database->fetch_array($database->query("SELECT id FROM subjects WHERE subject_title ='$mon_subj'"));
            $mon_subj_id = $result_set['id'];
            
            $result_set = $database->fetch_array($database->query("SELECT teacher_id FROM mon_sched WHERE period_id ='$period_id' AND class_id ='$class_id'"));
            $mon_teacher_id = $result_set['teacher_id'];
            
            $result_set = $database->fetch_array($database->query("SELECT full_name FROM staff WHERE id ='$mon_teacher_id'"));
            $mon_teacher_name = $result_set['full_name'];
            
            /* Tuesdays Schedule */
            $tue_subj = $edit_record[0]['tue'];
            $result_set = $database->fetch_array($database->query("SELECT id FROM subjects WHERE subject_title ='$tue_subj'"));
            $tue_subj_id = $result_set['id'];
            
            $result_set = $database->fetch_array($database->query("SELECT teacher_id FROM tue_sched WHERE period_id ='$period_id' AND class_id ='$class_id'"));
            $tue_teacher_id = $result_set['teacher_id'];
            
            $result_set = $database->fetch_array($database->query("SELECT full_name FROM staff WHERE id ='$tue_teacher_id'"));
            $tue_teacher_name = $result_set['full_name'];
            
            /* Wednesdays Schedule */
            $wed_subj = $edit_record[0]['wed'];
            $result_set = $database->fetch_array($database->query("SELECT id FROM subjects WHERE subject_title ='$wed_subj'"));
            $wed_subj_id = $result_set['id'];
            
            $result_set = $database->fetch_array($database->query("SELECT teacher_id FROM wed_sched WHERE period_id ='$period_id' AND class_id ='$class_id'"));
            $wed_teacher_id = $result_set['teacher_id'];
            
            $result_set = $database->fetch_array($database->query("SELECT full_name FROM staff WHERE id ='$wed_teacher_id'"));
            $wed_teacher_name = $result_set['full_name'];
            
            /* Thursdays Schedule */
            $thur_subj = $edit_record[0]['thur'];
            $result_set = $database->fetch_array($database->query("SELECT id FROM subjects WHERE subject_title ='$thur_subj'"));
            $thur_subj_id = $result_set['id'];
            
            $result_set = $database->fetch_array($database->query("SELECT teacher_id FROM thur_sched WHERE period_id ='$period_id' AND class_id ='$class_id'"));
            $thur_teacher_id = $result_set['teacher_id'];
            
            $result_set = $database->fetch_array($database->query("SELECT full_name FROM staff WHERE id ='$thur_teacher_id'"));
            $thur_teacher_name = $result_set['full_name'];
            
            /* Fridays Schedule */
            $fri_subj = $edit_record[0]['fri'];
            $result_set = $database->fetch_array($database->query("SELECT id FROM subjects WHERE subject_title ='$fri_subj'"));
            $fri_subj_id = $result_set['id'];
            
            $result_set = $database->fetch_array($database->query("SELECT teacher_id FROM fri_sched WHERE period_id ='$period_id' AND class_id ='$class_id'"));
            $fri_teacher_id = $result_set['teacher_id'];
            
            $result_set = $database->fetch_array($database->query("SELECT full_name FROM staff WHERE id ='$fri_teacher_id'"));
            $fri_teacher_name = $result_set['full_name'];
            
            /* Select options */
            
            $result_set = $database->query("SELECT * FROM subjects");
            $subjects = array();
            while($row = $database->fetch_array($result_set)){ 
                
                $subjects[] = $row;
                
            }
            
            
            $teachers = Staff::find_by_sql("SELECT  id, full_name FROM staff WHERE post = 'Teacher' AND status = 'Active'");
            
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
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
            
            if($found_user->type != 'Principal'){
            
            if($found_user->type != 'Registrar'){
                
            $session->set_message("You don't have the permission to view that page!");
            redirect_to_home();
            }
        }
            if(!empty($_POST)){
            
            if($_POST['mon']['subject'] =='Free'){$_POST['mon']['teacher'] = 'NULL';}
            if($_POST['tue']['subject'] =='Free'){$_POST['tue']['teacher'] = 'NULL';}
            if($_POST['wed']['subject'] =='Free'){$_POST['wed']['teacher'] = 'NULL';}
            if($_POST['thur']['subject'] =='Free'){$_POST['thur']['teacher'] = 'NULL';}
            if($_POST['fri']['subject'] =='Free'){$_POST['fri']['teacher'] = 'NULL';}  
            
            $class = $_POST['mon']['class'];
            
            if(validate_fields($_POST['mon'])){
                
              $periods = $_POST['mon']['periods'];
              $class = $_POST['mon']['class'];
              $subject = $_POST['mon']['subject'];
              $teacher = $_POST['mon']['teacher'];
              
              $row = $database->fetch_array($database->query("SELECT * FROM mon_sched WHERE period_id = $periods 
                                            AND class_id = $class"));
                                            
                                            
              if (!empty($row)){
                
              $database->query("UPDATE mon_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher 
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
                
              }else{
              $database->query("INSERT INTO mon_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher "); 
                
                
            }
            
            
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("new?id=$class");
            }
            
            
            if(validate_fields($_POST['tue'])){
                
              $periods = $_POST['tue']['periods'];
              $class = $_POST['tue']['class'];
              $subject = $_POST['tue']['subject'];
              $teacher = $_POST['tue']['teacher'];
              
              $row = $database->fetch_array($database->query("SELECT * FROM tue_sched WHERE period_id = $periods 
                                            AND class_id = $class"));
                                            
                                            
              if (!empty($row)){
                
              $database->query("UPDATE tue_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher 
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
                
              }else{
              $database->query("INSERT INTO tue_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id ='$teacher'"); 
                
                
            }
            
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("new?id=$class");
            }
            
            if(validate_fields($_POST['wed'])){
                
              $periods = $_POST['wed']['periods'];
              $class = $_POST['wed']['class'];
              $subject = $_POST['wed']['subject'];
              $teacher = $_POST['wed']['teacher'];
              
              $row = $database->fetch_array($database->query("SELECT * FROM wed_sched WHERE period_id = $periods 
                                            AND class_id = $class"));
                                            
                                            
              if (!empty($row)){
              $database->query("UPDATE wed_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher 
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
                
              }else{
              $database->query("INSERT INTO wed_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher "); 
                
                
            }
            
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("new?id=$class");
            }
            
            if(validate_fields($_POST['thur'])){
                
              $periods = $_POST['thur']['periods'];
              $class = $_POST['thur']['class'];
              $subject = $_POST['thur']['subject'];
              $teacher = $_POST['thur']['teacher'];
              
              $row = $database->fetch_array($database->query("SELECT * FROM thur_sched WHERE period_id = $periods 
                                            AND class_id = $class"));
                                            
                                            
              if (!empty($row)){
              $database->query("UPDATE thur_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
                
              }else{
              $database->query("INSERT INTO thur_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher "); 
                
                
            }
            
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("new?id=$class");
            }
            
            if(validate_fields($_POST['fri'])){
                
              $periods = $_POST['fri']['periods'];
              $class = $_POST['fri']['class'];
              $subject = $_POST['fri']['subject'];
              $teacher = $_POST['fri']['teacher'];
              
              $row = $database->fetch_array($database->query("SELECT * FROM fri_sched WHERE period_id = $periods 
                                            AND class_id = $class"));
                                            
                                            
              if (!empty($row)){
                
              $database->query("UPDATE fri_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher
                                                          WHERE period_id ='$periods' AND class_id ='$class'");
                
              }else{
              $database->query("INSERT INTO fri_sched SET period_id = $periods,
                                                          class_id = $class,
                                                          subj_name = '$subject',
                                                          teacher_id = $teacher "); 
                
                
            }
            
            }else{
                
                $session->set_message("Please fill all the fields!");
                redirect_to("new?id=$class");
            }
            
            $class_log = classes::find_by_id($class);
            
            $user = users::find_by_id($session->user_id);
            log_action('Timetable Entry Creation', "$user->username created new timetable entry for $class_log->title");
           $session->set_message("Successfully Created Timetable Entry!"); 
           redirect_to("new?id=$class");
            
        }
        
        $result_set = $database->query("SELECT title, id FROM classes WHERE id ='$id'");

        $record = $database->fetch_array($result_set);

        $result_set = $database->query("SELECT * FROM periods");
        $periods = array();
        while($row = $database->fetch_array($result_set)){ 
    
                $periods[] = $row;
                
            }
            
            $result_set = $database->query("SELECT * FROM subjects");
            $subjects = array();
            while($row = $database->fetch_array($result_set)){ 
                
                $subjects[] = $row;
                
            }
            
            
            $teachers = Staff::find_by_sql("SELECT  id, full_name FROM staff WHERE post = 'Teacher' AND status = 'Active'");
            


            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
            
            case 'index':
            global $session;
            global $database;
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
            
            $records = Class_timetable::get_timetable($id);
            
            $result = classes::find_by_sql("SELECT title FROM classes WHERE id ='$id'");
            $class = array_shift($result);
            include_once(VIEW_PATH.'layout'.DS.$found_user->type.DS.$model. DS.$view.'.php');
            break;
            
        }
            
        
    }
      
    
}

?>