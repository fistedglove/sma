<?php 

/**
	* This PHP Class Handles routing services for the app
	*
	*/
class Dispatcher{
    
    public static $url;
    public static $params;
    public static $controller;
    public static $model;
    public static $view;
    public static $id = null;
    public static $con;
    

    /**
	* Route redirection for the app
	* 
	*/
    public static function dispatch()
    {
        self::$url = $_SERVER['REQUEST_URI'];
        
        self::$url = str_replace('/'. APP_ROOT. '/', '', self::$url);
        self::$url = str_replace('?'. $_SERVER['QUERY_STRING'], '', self::$url);
        self::$params = array();
        
        
        if(isset($_GET['id'])){
        self::$id = $_GET['id'];
        }
        self::$params = explode('/', self::$url);
        
        self::$controller = !empty(self::$params[0])? self::$params[0]: 'default';
        self::$model = !empty(self::$params[0])? self::$params[0]: 'default';
        self::$view = !empty(self::$params[1])? self::$params[1]: 'index' ;
        
        $class = self::$controller . '_controller';
      
        self::$con = new $class();
        self::$con->get_view(self::$view, self::$model, (self::$id));
   
        
    }
    
}


?>