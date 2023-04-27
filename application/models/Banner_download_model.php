<?php
class Banner_download_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_banner_download";
        $this->table_title = "Banner Download";
    }
    
    
}