<?php

/**
	* This PHP Script Contains the Pagination Class for paginating between pages
	*
	*/
class Pagination{
    
    public $per_page;
    public $current_page;
    public $total_count;
    
    /**
	* Class Constructor. Initialize class properties
	* @param integer $perPage No. of items per page
	* @param integer $currentPage the Current Page
	* @param integer $rowCount No. of rows in DB Table
	*/
    function __construct($per_page = 2, $current_page = 1, $total_count = 39 ){
        
        $this->per_page = $per_page;
        $this->current_page = $current_page;
        $this->total_count = $total_count;
        
    }
    
    /**
	* Calculates the total pages
	* @return integer 
	*/
    public function total_pages(){
        
        return ceil($this->total_count/$this->per_page);
        
    }

    /**
	* Calculates the offSet
	* @return integer 
	*/
    public function offset(){
        
        return ($this->current_page - 1) * $this->per_page;
           
    }
    
    /**
	* Calculates the prevPage value
	* @return integer 
	*/
    public function prev_page(){
        
        return $this->current_page - 1;
    }
    
    /**
	* Calculates the nextPage value
	* @return integer 
	*/
    public function next_page(){
        
        return $this->current_page + 1;
    }
    
    
    /**
	* Retrieves the hasPrev
	*/
    public function has_prev(){
        
        return $this->prev_page() >= 1 ? true : false;
    }
    
    /**
	* Retrieves the hasNext value
	* @return boolean
	*/
    public function has_next(){
        
        return $this->next_page() <= $this->total_pages() ? true : false;
    }
    
    
}






?>



