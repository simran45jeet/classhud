<?php
class Options_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_options';
        $this->table_title = 'Option';
    }

    function get_records($post_data,$pagination=true,$page_no=1) {
        $response = array();
        $records_sql = $this->db->select("*")
                            ->from($this->table_name)
                            ->where("is_deleted",NOT_DELETED)
                            ->order_by("sort_order");
        if( isset($post_data['only_active']) && $post_data['only_active']===true ){
            $records_sql->where("status",ACTIVE);
        }
        if( $pagination===true ) {
            $record_count_sql = clone $records_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $records_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $records_sql->order_by("sort_order","asc")->order_by("id","desc")->get()->result_array();

        return $response;
    }

    public function get_record($id){
        $record = $this->db->select("*")
                            ->from($this->table_name)
                            ->where(array("is_deleted"=>NOT_DELETED,"id"=>$id))
                            ->get()->row_array();
        return array("record"=>$record);
    }
}