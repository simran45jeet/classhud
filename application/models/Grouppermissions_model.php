<?php

Class Grouppermissions_Model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table_name = "tbl_group_permissions";
        $this->table_title = "Group Permissions";
    }

    public function get_records($id) {
        $q = $this->db->select("*")
                ->from($this->table_name)
                ->where("group_id = '{$id}'");
        $tmp = $q->get()->result_array();

        $data['records'] = $tmp;
        return $data;
    }

}
