<?php 

class Class_timetable extends DatabaseObject{
    
    public static function get_timetable($id = null, $period = null){
        
        global $database;
        
        $query = "SELECT period_title, periods.start_time, periods.end_time, classes.title, mon_sched.subj_name AS mon, tue_sched.subj_name AS tue, wed_sched.subj_name AS wed, thur_sched.subj_name AS thur, fri_sched.subj_name AS fri
                    FROM classes, periods, mon_sched, tue_sched, wed_sched, thur_sched, fri_sched
                    WHERE mon_sched.period_id = periods.id
                    AND tue_sched.period_id = periods.id
                    AND wed_sched.period_id = periods.id
                    AND thur_sched.period_id = periods.id
                    AND fri_sched.period_id = periods.id
                    AND  mon_sched.class_id = classes.id
                    AND tue_sched.class_id = classes.id
                    AND wed_sched.class_id = classes.id
                    AND thur_sched.class_id = classes.id
                    AND fri_sched.class_id = classes.id ";
                  
        if($id != null){
        
         $query .= " AND classes.id =$id";
            
        }
        if($period != null){
        
         $query .= " AND periods.id =$period";
            
        }
        
        $result_array = array();
        
        $result = $database->query($query);
        while($row = $database->fetch_array($result)){
            
            $result_array[] = $row;
        }
        
        return $result_array;
        
        
    }
  
 }


?>