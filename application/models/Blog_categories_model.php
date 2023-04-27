<?php
class Blog_categories_model extends MY_Model {
    private $page_type;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_pages_categories';
        $this->table_title = 'Blog Category';
        $this->type = PAGE_CATEGORIES_TYPES_BLOG;
    }

    public function get_records($post_data,$pagination=true,$page_no=1) {
        $response = array();
        $record_sql = $this->db->select("*")
                            ->from($this->table_name)
                            ->where(["is_deleted"=>NOT_DELETED,"type"=>$this->type]);
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){}else{
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
        
        $response['records'] = $record_sql->order_by("sort_order","asc")->get()->result_array();

        return $response;
    }
    
    public function get_record($page_id) {
        $response = array();
        $record_sql = $this->db->select("*")
                            ->from($this->table_name)
                            ->where(["is_deleted"=>NOT_DELETED,"type"=>$this->type,"id"=>$page_id]);
        $response['record'] = $record_sql->get()->row_array();
        return $response;
    }
    
}