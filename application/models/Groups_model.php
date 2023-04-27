<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Groups_Model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_groups';
        $this->table_title= 'Group';
    }

    public function get_records( $post_data=array(),$pagination = false,$page_no=1 ) {
        //Get Restaurant List
        $record_sql = $this->db->select('*')
                ->from($this->table_name)
                ->where("is_deleted",NOT_DELETED);
        if( isset($post_data["is_staff"]) && $post_data["is_staff"]==IS_STAFF ){
            $record_sql->where("is_staff",IS_STAFF);
        }
        if( isset($post_data["only_active"]) && $post_data["only_active"]==true ){
            $record_sql->where("status",ACTIVE);
        }
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $record_sql->get()->result_array();
        return $response;
    }
    
    public function get_record($group_id) {
        //Get Restaurant List
        $record_sql = $this->db->select('*')
                ->from($this->table_name)
                ->where(array("is_deleted"=>NOT_DELETED,"id"=>$group_id));
        $response['record'] = $record_sql->get()->row_array();
        return $response;
    }

}
