<?php
class Profile_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_users';
        $this->table_title = 'Profile';
    }
}