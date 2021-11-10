<?php

class Tasks_controller{
    
    
    public function get_view($view = null, $model = null, $id = null){
        
        switch($view){
         
            case 'index':
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
            
            $dir = SITE_ROOT.DS.APP_ROOT.DS.'tasks/db_backups';
            
            $backups = scandir($dir);
            
            if(!empty($_POST['restore'])){
               
               $backup_file = $_POST['restore']; 
                
               $backup_path = $dir.'/'.$backup_file; 
               
               $command = 'C:\xampp\mysql\bin\mysql -h'.DB_SERVER.' -u'.DB_USER. ' -p'.DB_PASS. ' '. DB_NAME. ' < '.$backup_path; 
            
            
            system($command, $result);
            
            switch($result){
                
                case 0:  
                $session->set_message('Database backup was successfully restored!');
                log_action('DB Restore', 'Database Restore successful');
                redirect_to('index');
                break;
                
                case 1: 
                echo "<div class ='echoClass'><p>Error occurred while attempting to restore selected backup!</p></div>";
                redirect_to('index');
                break;  
            }
             
                
            }
            
            include_once(VIEW_PATH.'layout'.DS. 'Administrator'.DS.$model. DS. $view. '.php');
            break;
            
            case 'backup':
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
            
            $backup = DB_NAME.'('.strftime('%Y-%m-%d(%H-%M-%S)', time()).')'. '.sql';
            
            
            
            $command = 'C:\xampp\mysql\bin\mysqldump -h'.DB_SERVER.' -u'.DB_USER. ' -p'.DB_PASS. ' '. DB_NAME. ' >tasks/db_backups/'.$backup; 
            
            
            system($command, $result);
            
            switch($result){
                
                case 0:  
                $session->set_message('Database '.ucfirst(DB_NAME).' was successfully backed up!');
                log_action("DB Bckup", "Database Backup Successful!");
                redirect_to('index');
                break;
                
                case 1: 
                echo "<div class ='echoClass'><p>Error occurred while backing up the database.Check the back up path!</p></div>";
                redirect_to('index');
                break;
                
                case 2:
                echo "<div class ='echoClass'><p>Error occured while attempting to backup the database!</p></div>";
                redirect_to('index');
                break;
         }
            
            
            case 'results':
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
            
            $records =($database->query("SHOW TABLES LIKE '%results%'"));
            
            while($record = $database->fetch_array($records)){
                
                $database->query("TRUNCATE TABLE $record[0]");
                
            }
            
            $session->set_message("Successfully Clear out data from the Results table!");
            log_action('Result Clear Out', 'Results Data Cleared Out successfully!');
            
            redirect_to('index');
            
            
            case 'comments':
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
            
            $records =($database->query("SHOW TABLES LIKE '%comments%'"));
            
            while($record = $database->fetch_array($records)){
                
                $database->query("TRUNCATE TABLE $record[0]");
                
            }
            
            $session->set_message("Successfully Clear out data from the Comments table!");
            
            redirect_to('index');
            
            case 'payments':
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
             
            $database->query("TRUNCATE TABLE payments");
           
            $session->set_message("Successfully Clear out data from the Payments table!");
            log_action('Payments Data Out', 'Students Payments Data Cleared Out successfully!');
            redirect_to('index');
            
            
            case 'academic_year':
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
            
            if(!empty($_POST['academic_year'])){
                
                $year = trim(strip_tags($_POST['academic_year']));
                
                $file = SITE_ROOT.DS.APP_ROOT.DS.'config.php';
                
                $handler = fopen($file, 'c+');
                
                $content = 'defined("ACADEMIC_YEAR")? NULL: define("ACADEMIC_YEAR",'.'"'. $year.'"'.');';
                
                $raw = ';;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;';
                
                
              fseek($handler, 31);
              
              fwrite($handler, $raw);
              
              rewind($handler);
                
              fseek($handler, 31);
                
              fwrite($handler, $content);
                
              fclose($handler);
               
              $session->set_message("Academic Year Successfully Changed!");
               
              redirect_to('index');

             }elseif(empty($_POST['academic_year'])){
                
                redirect_to('index');
                
             }
             
                
            case 'db_pass':
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
            
            if(!empty($_POST['db_password'])){
                
                $pass = trim(strip_tags($_POST['db_password']));
                
                $file = SITE_ROOT.DS.APP_ROOT.DS.'config.php';
                
                $handler = fopen($file, 'c+');
                
                $content = 'defined("DB_PASS")? NULL : define("DB_PASS",'.'"'. $pass.'"'.');';
                
                $raw = ';;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;';
                
               fseek($handler, 117);
              
              fwrite($handler, $raw);
              
              rewind($handler);
              
              fseek($handler, 117);
              
              $database->query("SET PASSWORD FOR root@localhost = PASSWORD('$pass')");
                
               fwrite($handler, $content);
                
               fclose($handler);
               
               $session->set_message("Database Root Password Successfully Changed!");
               
               redirect_to('index');
               
            }elseif(empty($_POST['db_password'])){
                
                redirect_to('index');
                
            }
        }
        
        
        
        
        
        
    }
    
    
    
    
    
}




?>