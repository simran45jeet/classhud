<?php
class Review_categories_rating_model extends MY_Model {
    private $page_type;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_review_categories_rating';
        $this->table_title = 'Review Category Rating';
    }

    public function get_records($review_id,$post_data,$pagination=true,$page_no=1) {
        $response = array();
        $this->load->model("review_categories_model","review_categories");
        $record_sql = $this->db->select("rcr.*,rc.name as category_name")
                            ->from($this->table_name." rcr")
                            ->join($this->review_categories->table_name." rc","rc.id = rcr.category_id")
                            ->where(["rcr.is_deleted"=>NOT_DELETED,"rcr.review_id"=>$review_id]);
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){}else{
            $record_sql->where("rcr.status",ACTIVE);
        }
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $record_sql->order_by("rc.sort_order","asc")->order_by("rc.id","asc")->get()->result_array();

        return $response;
    }
    
    public function get_record($page_id) {
        $response = array();
        $record_sql = $this->db->select("*")
                            ->from($this->table_name)
                            ->where(["is_deleted"=>NOT_DELETED,"page_type"=>$this->page_type,"id"=>$page_id]);
        $response['record'] = $record_sql->get()->row_array();
        return $response;
    }
    
}