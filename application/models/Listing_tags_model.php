<?php
class Listing_tags_model extends MY_Model {
    private $type=TAGS_TYPES_LISTING;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_table_tags';
        $this->table_title = 'Lisitng Tag';
        
    }

    public function get_records($listing_id,$post_data=array(),$pagination=true,$page_no=1) {
        $response = array();
        $this->load->model("tags_model","tags");
        $record_sql = $this->db->select("lt.*,t.name")
                            ->from($this->table_name." lt")
                            ->join($this->tags->table_name." t","t.id = lt.tag_id and  t.is_deleted=".NOT_DELETED)
                            ->where(["lt.is_deleted"=>NOT_DELETED,"lt.type"=>$this->type,"lt.table_id"=>$listing_id]);
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){}else{
            $record_sql->where("lt.status",ACTIVE);
        }
        if(  isset($post_data["status"]) && $post_data["status"]!="-1"  ) {
            $record_sql->where("lt.status",$post_data["status"]);
        }
        
        
        if(  isset($post_data["search"]) && !empty($post_data["search"]) ) {
            $record_sql->like("lt.name",$post_data["search"]);            
        }
        
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        $response['records'] = $record_sql->order_by("lt.id","asc")->get()->result_array();

        return $response;
    }
    
    
}