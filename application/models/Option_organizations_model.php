<?php
class Option_organizations_model extends MY_Model {
    protected $table_title;
    
    public function __construct(){
        parent::__construct();
        $this->table_name = 'tbl_option_organizations';
        $this->table_title = 'Option Organization';
        
    }
    
    public function get_records($option_id){
        $records = $this->db->select("*")
                            ->from($this->table_name)
                            ->where(array("option_id"=>$option_id,"is_deleted"=>NOT_DELETED))
                            ->get()->result_array();
        return array("records"=>$records);
    }
    
}