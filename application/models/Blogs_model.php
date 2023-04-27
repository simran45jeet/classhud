<?php
class Blogs_model extends MY_Model {
    private $page_type;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_pages';
        $this->table_title = 'Blogs';
        $this->page_type = PAGE_TYPES_BLOG;
    }

    public function get_records($post_data,$pagination=true,$page_no=1) {
        $response = array();
        $this->load->model("blog_categories_model","blog_categories");
        $record_sql = $this->db->select("b.*,bc.name as category_name")
                            ->from($this->table_name." b")
                            ->join($this->blog_categories->table_name." bc","bc.id=b.category","left")
                            ->where(["b.is_deleted"=>NOT_DELETED,"b.page_type"=>$this->page_type]);
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){}else{
            $record_sql->where("b.status",ACTIVE);
        }
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $record_sql->order_by("b.id","desc")->get()->result_array();

        return $response;
    }
    
    public function get_record($page_id="",$slug="") {
        $response = array();
        $this->load->model("blog_categories_model","blog_categories");
        $record_sql = $this->db->select("b.*,bc.name as category_name")
                            ->from($this->table_name." b")
                            ->join($this->blog_categories->table_name." bc","bc.id=b.category","left")
                            ->where(["b.is_deleted"=>NOT_DELETED,"b.page_type"=>$this->page_type]);
        
        if( !empty($slug) ) {
            $record_sql->where("b.slug",$slug);
        }else{
            $record_sql->where("b.id",$page_id);
        }
        $response['record'] = $record_sql->get()->row_array();
        return $response;
    }
    
}