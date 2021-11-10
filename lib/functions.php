<?php

/**
	* redirect method Redirects to a specified location
	* @param string $location Location to redirect to relatively
	*/
function redirect_to($string = null){
    if($string!=null){
    header("Location:$string");
    exit;
    }
}

/**
	* Redirects to login page 
	*
	*/
function redirect_to_login(){
    redirect_to(WEBSITE.DS.APP_ROOT."/users/login");

}

/**
	* Redirects to home page 
	*
	*/
function redirect_to_home(){
    redirect_to(WEBSITE.DS.APP_ROOT);
}


/**
	* Format Date for Database insertion
	* @param string $date Date to Format
	* @param string Mysql Format
	* @return string
	*/
function mysql_date_insert($date =""){

    return strftime("%Y-%m-%d", strtotime($date));
}

/**
	* date_display method Format Date and Time for Display
	* @param string $date Date to Format
	* @return string
	*/
function displayed_date($date = ""){
    
    return strftime("%B %d, %Y", strtotime($date));
}


/**
	* Check if uploaded photo is valid format 
	* @param mixed $photo Photo to validate
	* @return boolean
	*/

function is_jpeg($photo){
    
    if(($photo == 'image/jpeg') || $photo == 'image/pjpeg' ){
        
        return true;
    }else{
        
        return false;
    }
}

/**
	* Check if uploaded photo is valid format 
	* @param mixed $photo Photo to validate
    * @param string $max_size size to check againt
	* @return boolean
	*/

function is_valid_size($photo, $max_size = 1048576){
    
    if($photo < $max_size){
        
        return true;
    }
    
    else{
        
        return false;
    }
}

/**
	* Checks against empty arrays
	* @param array $params arrays to validate
	* @return array $result validated arrays
	*/

function validate_fields($params){
        
        $result = false;
    
    foreach($params as $value){
        
        if($value != ''){
            $result = true;
            
        }else{
            $result = false;
            
            return $result;
        }
        
    }
    return $result;
    
    
 }

 /**
	* flash_message method Display saved SESSION messages
	* @param string $msg Message to display
	* @return string
	*/
function flash_message($msg = ""){
    
    if(!empty($msg)){
      return "<div class='message timetableMessage'><p>$msg</p></div>";  
        
    }else{
        
        return "";
    }
    
}

/**
	* flash_warning method Display saved SESSION warning message
	* @param string $msg Warning Message to display
	* @return string
	*/
function flash_warning($msg = ""){
    
    if(!empty($msg)){
      return "<div class='warning'><p>$msg</p></div>";  
        
    }else{
        
        return "";
    }
    
}

/**
	* Writes logs of admistrative actions
	* @param string $action admin action to be logged
	* @param string $msg messages to be logged
	*/

function log_action($action = "", $msg = ""){
    
    $log_file = SITE_ROOT.APP_ROOT.DS.'logs/log.txt';
    $timestamp = strftime("%Y/%m/%d %I:%M:%S %p", time());
    $content = "<tr><td>$action</td><td>$msg</td><td>$timestamp</td></tr>\r\n";
                
    if($handle = fopen($log_file, 'a')){
        
        fwrite($handle, $content);
        fclose($handle);  
    }else{
        
        "Count not open log file";
    }
  
}

/**
	* Formats passed string as Money value
	* @param string $string 
	* @return string
	*/
function format_money($string){
    
     $search = array('#', 'NGN', ',', ' ', '$', 'Naira', ';', ':', '?');
     
     return number_format(str_replace($search, '',$string), 2,'.', '');   
   
}


?>