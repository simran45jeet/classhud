<?php
class Banners_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_banners";
        $this->table_title = "Banner";
    }
    
    public function get_records($post_data=array(),$pagination = true,$page_no=1 ) {
        //Get Restaurant List
        $this->load->model("banners_category_model","banners_category");
        $record_sql = $this->db->select('b.*,bc.name as category_name')
                ->from($this->table_name." b")
                ->join($this->banners_category->table_name." bc","bc.id = b.banner_category")
                ->where( array("b.is_deleted"=>NOT_DELETED,"bc.is_deleted"=>NOT_DELETED,"bc.type"=>BANNER_CATEGORY_TYPE_LISTING) );
        if( !empty($post_data["date"]) ) {
            $record_sql->where("'{$post_data["date"]}' BETWEEN bc.start_date and bc.end_date",null,false);
        }
        
        if( isset($post_data["all_record"]) && $post_data["all_record"]==true ){}else{
            $record_sql->where("b.status",ACTIVE);
            $record_sql->where("bc.status",ACTIVE);
        }

        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $record_sql->order_by("bc.sort_order","asc")->order_by("b.id","desc")->get()->result_array();
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