<?php
class Phone_code_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_phonecode';
        $this->table_tile = 'Phone Code';
    }


    function get_records($post_data,$pagination=true,$page_no=1) {

        $response = array();
        $record_sql = $this->db->select("*")
                            ->from($this->table_name)
                            ->where("is_deleted",NOT_DELETED);
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){
        }else{ $record_sql->where("status",ACTIVE); }
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $record_sql->order_by("id","desc")->get()->result_array();

        return $response;
    }
    
    
    function get_record($id) {
        $response = array();
        $record_sql = $this->db->select("*")
                            ->from($this->table_name)
                            ->where(array("is_deleted"=>NOT_DELETED,"id"=>$id));
        
        
        $response['record'] = $record_sql->get()->row_array();

        return $response;
    }
}