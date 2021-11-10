
<?php 

global $session;

include_once ($_SERVER['DOCUMENT_ROOT']. '/phpsms/config.php');

spl_autoload_register(NULL, TRUE);
spl_autoload_extensions('.php');
spl_autoload_register(array('Autoloader', 'load'));


class ClassNotFoundException extends Exception{}

/**
	* This PHP Class Loads up classes by defining paths to classes definition
	*
	*/

class Autoloader{
    
    
    public static function load($class){
        if(class_exists($class, false)){
            return;
        }
        
        $paths = array(
                    MODEL_PATH. $class. '.php',
                    CONTROLLER_PATH. $class. '.php',
                    VIEW_PATH. $class. '.php',
                    SITE_ROOT.DS.APP_ROOT.DS. 'lib' . DS. $class. '.php',
                    SITE_ROOT.DS.APP_ROOT.DS. ' application'. DS. $class. '.php',
                    $class. '.php');
                    
        foreach($paths as $file){        
        
        if(file_exists($file)){
            
            require_once($file);
            return true;
           }  
        
    }
        
    
        if(!class_exists($class, false)){
            
           
            throw new ClassNotFoundException('Invalid Address. Please Check and Try Again!');
               
        }
        
        
    }
    
}

        try{
            Dispatcher::dispatch();
            
        }catch(ClassNotFoundException $e){
            echo $e->getMessage();
            exit();
        }catch(Exception $e){
            echo $e->getMessage();
            exit();
        }
        
        
        
        
        


?>
