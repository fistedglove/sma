<?php 

class Teacher_timetable extends DatabaseObject{
    
    
    public static function mon_sched($id = null){
        global $database;
        
        $query = "SELECT period_title, periods.start_time, periods.end_time, classes.title
                  FROM classes, periods, mon_sched
                  WHERE mon_sched.class_id = classes.id
                  AND mon_sched.period_id = periods.id ";
        
        if($id != null){
        
         $query .= " AND mon_sched.teacher_id =$id";
            
        }
       $query.= " ORDER BY periods.id ASC";
        
        $result_array = array();
        $result = $database->query($query);
        while($row = $database->fetch_array($result)){
            
            $result_array[] = $row;
        }
        
        return $result_array;
        
        
    }
  
    public static function tue_sched($id = null){
        
        global $database;
        
        $query = "SELECT period_title, periods.start_time, periods.end_time, classes.title
                  FROM classes, periods, tue_sched
                  WHERE tue_sched.class_id = classes.id
                  AND tue_sched.period_id = periods.id ";
        
        if($id != null){
        
         $query .= " AND tue_sched.teacher_id =$id";
            
        }
         $query.= " ORDER BY periods.id ASC";
            
        $result_array = array();
        $result = $database->query($query);
        while($row = $database->fetch_array($result)){
            
            $result_array[] = $row;
        }
        
        return $result_array;
        
        
    }
    
    public static function wed_sched($id = null){
        
        global $database;
        
        $query = "SELECT period_title, periods.start_time, periods.end_time, classes.title
                  FROM classes, periods, wed_sched
                  WHERE wed_sched.class_id = classes.id
                  AND wed_sched.period_id = periods.id ";
        if($id != null){
        
         $query .= " AND wed_sched.teacher_id =$id";
            
        }
        $query.= " ORDER BY periods.id ASC";
        
        $result_array = array();
        $result = $database->query($query);
        while($row = $database->fetch_array($result)){
            
            $result_array[] = $row;
        }
        
        return $result_array;
        
        
    }
    
    public static function thur_sched($id = null){
        global $database;
        
        $query = "SELECT period_title, periods.start_time, periods.end_time, classes.title
                  FROM classes, periods, thur_sched
                  WHERE thur_sched.class_id = classes.id
                  AND thur_sched.period_id = periods.id ";
        if($id != null){
        
         $query .= " AND thur_sched.teacher_id =$id";
            
        }
        $query.= " ORDER BY periods.id ASC";
        
        $result_array = array();
        $result = $database->query($query);
        while($row = $database->fetch_array($result)){
            
            $result_array[] = $row;
        }
        
        return $result_array;
        
        
        
    }
    
    public static function fri_sched($id = null){
        
        global $database;
        
        $query = "SELECT period_title, periods.start_time, periods.end_time, classes.title
                  FROM classes, periods,fri_sched
                  WHERE fri_sched.class_id = classes.id
                  AND fri_sched.period_id = periods.id ";
        if($id != null){
        
         $query .= " AND fri_sched.teacher_id =$id";
            
        }
        $query.= " ORDER BY periods.id ASC";
        $result_array = array();
        
        $result = $database->query($query);
        while($row = $database->fetch_array($result)){
            
            $result_array[] = $row;
        }
        
        return $result_array;
        
        
    }
  
 }

?>
