<?php
class Listing_social_media_model extends MY_Model {
    
    function __construct(){
        parent::__construct();
        $this->table_name = "tbl_listing_social_media";
        $this->table_title = "Listing Social Media";
    }
    
    public function get_records($listing_id,$post_data=array(),$pagination = false,$page_no=1 ) {
        //Get Restaurant List
        $this->load->model("social_media_model","social_media");
        $record_sql = $this->db->select('lsm.*,sm.display_name,sm.icon_class')
                ->from($this->table_name." lsm")
                ->join($this->social_media->table_name." sm","sm.id = lsm.social_media_id")
                ->where( array("lsm.is_deleted"=>NOT_DELETED,"lsm.listing_id"=>$listing_id) );
        
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){
        }else{ $record_sql->where("lsm.status",ACTIVE); }
        $record_sql->where("lsm.status",ACTIVE);

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