<?php
class Social_media_model extends MY_Model {
    
    function __construct(){
        parent::__construct();
        $this->table_name = "tbl_social_media";
        $this->table_title = "Social Media";
    }
    
    public function get_records($post_data=array(),$pagination = false,$page_no=1 ) {
        //Get Restaurant List
        $record_sql = $this->db->select('*')
                ->from($this->table_name)
                ->where( array("is_deleted"=>NOT_DELETED) );
        
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
        
        $response['records'] = $record_sql->order_by("sort_order","ASC")->order_by("id","desc")->get()->result_array();
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