<?php
class Listing_phone_model extends MY_Model {
    
    function __construct(){
        parent::__construct();
        $this->table_name = "tbl_listing_phone";
        $this->table_title = "Listing Phone";
    }
    
    public function get_records($listing_id,$post_data=array(),$pagination = false,$page_no=1 ) {
        //Get Restaurant List
        $this->load->model("phone_code_model","phone_code");
        $record_sql = $this->db->select('lp.*,pc.phonecode as phone_code_name')
                ->from($this->table_name." lp")
                ->join($this->phone_code->table_name." pc","pc.id=lp.phone_code")
                ->where( array("lp.is_deleted"=>NOT_DELETED,"lp.listing_id"=>$listing_id) );
        
        if( isset($post_data["only_active"]) && $post_data["only_active"]==true ){
            $record_sql->where("lp.status",ACTIVE);
        }
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