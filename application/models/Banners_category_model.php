<?php
class Banners_category_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_banner_categories";
        $this->table_title = "Banner Category";
    }
    
    public function get_records($post_data=array(),$pagination = true,$page_no=1 ) {
        //Get Restaurant List
        $record_sql = $this->db->select('*')
                ->from($this->table_name)
                ->where( array("is_deleted"=>NOT_DELETED,"type"=>BANNER_CATEGORY_TYPE_LISTING) );
        
        if( isset($post_data["all_record"]) && $post_data["all_record"]==true ){}else{
            $record_sql->where("status",ACTIVE);
        }
        if( !empty($post_data["search"]) ) {
            $record_sql->like("name",$post_data["search"]);
        }
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $record_sql->order_by("sort_order","asc")->order_by("id","desc")->get()->result_array();
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