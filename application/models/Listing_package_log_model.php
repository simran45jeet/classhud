<?php
class Listing_package_log_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_listing_package_log";
        $this->table_title = "Listing Package Log";
    }
    
}