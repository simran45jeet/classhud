<?php
class Modules_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_modules';
    }

}