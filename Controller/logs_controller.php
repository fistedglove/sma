<?php

class logs_controller{
    
    
    public function get_view($view, $model, $id = null){
        
        switch($view){
            
            case 'show':
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

          
            
            $user =(users::find_by_id($session->user_id));
            
            if(!empty($_GET['clear'])&& $_GET['clear'] =='true'){
              $log_file = SITE_ROOT.DS.APP_ROOT.DS.'logs/log.txt';
              $backup_name = strftime('%Y-%m-%d(%H-%M-%S)', time());
              $log_backup = SITE_ROOT.DS.APP_ROOT.DS.'logs/backuplogs/'. $backup_name.'.txt';
              copy($log_file, $log_backup);  
               
              file_put_contents($log_file, '');
              
              log_action('Logs Cleared', "$user->username Backup and cleared log file");
              
              redirect_to('show'); 
              
            }
            $dir = SITE_ROOT.DS.APP_ROOT.DS.'logs/backuplogs';
            
            $backups = scandir($dir);
            
            $contents = "";
            $log_file = SITE_ROOT.DS.APP_ROOT.DS.'logs/log.txt';
            if(file_exists($log_file) && is_readable($log_file)){
                
              if($handle = fopen($log_file, 'r')){
                
                while(!feof($handle)){
                    
                    $contents .= fgets($handle);
                 }
                 
              }else{"Could not open log file";}  
                
                
            }else{"File not found";}
            
            
            if(!empty($_POST['backup'])){
                
                $backup_file = $_POST['backup'];
                $log_file = SITE_ROOT.DS.APP_ROOT.DS.'logs/backuplogs/'.$backup_file;
                
                if(file_exists($log_file) && is_readable($log_file)){
                
              if($handle = fopen($log_file, 'r')){
                
                while(!feof($handle)){
                    
                    $contents .= fgets($handle);
                 }
                 
              }else{"Could not open log file";}  
                
                
            }else{"File not found";}
                
            }
            include_once(VIEW_PATH.'layout'.DS. 'Administrator'.DS.$model. DS. $view. '.php');
            break;
        
            }

        }
}



?>