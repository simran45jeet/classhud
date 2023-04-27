<?php
class Listing_claim_request_model extends MY_Model {
    
    function __construct(){
        parent::__construct();
        $this->table_name = "tbl_listing_claim_request";
        $this->table_title = "Listing Claim Request";
    }
    
    public function get_records($post_data=array(),$pagination = true,$page_no=1 ) {
        //Get Restaurant List
   
        $this->load->model("listing_model","listing");
        $this->load->model("listing_types_model","listing_types");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("city_model","city");
        
        $record_sql = $this->db->select("lcr.*,l.name as listing_name,lt.name as listing_type_name,pc.phonecode as phone_code_name,c.name as city_name,l.slug")
                ->from($this->table_name." lcr")
                ->join($this->listing->table_name." l","l.id=lcr.listing_id and l.is_deleted=".NOT_DELETED,"left")
                ->join($this->listing_types->table_name." lt","lt.id = l.listing_type","left")
                ->join($this->phone_code->table_name." pc","pc.id = lcr.phone_code","left")
                ->join($this->city->table_name." c","c.id = l.city","left")
                ->where( array("lcr.is_deleted"=>NOT_DELETED) );
        
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){}else{
            $record_sql->where("lcr.status",ACTIVE);
        }
        if( !empty($post_data["request_status"]) ){
            $record_sql->where("lcr.request_status",$post_data["request_status"]);
        }
        
        
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        
        $response["records"] = $record_sql->order_by("lcr.id","desc")->get()->result_array();
        return $response;
    }
    
    
    
    public function get_record($listing_id) {
        $this->load->model("listing_model","listing");
        $this->load->model("listing_types_model","listing_types");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("city_model","city");
        $record_sql = $this->db->select("lcr.*,l.name as listing_name,lt.name as listing_type_name,pc.phonecode as phone_code_name,c.name as city_name,l.slug")
                ->from($this->table_name." lcr")
                ->join($this->listing->table_name." l","l.id=lcr.listing_id and l.is_deleted=".NOT_DELETED,"left")
                ->join($this->listing_types->table_name." lt","lt.id = l.listing_type","left")
                ->join($this->phone_code->table_name." pc","pc.id = lcr.phone_code","left")
                ->join($this->city->table_name." c","c.id = l.city","left")
                ->where(array("lcr.is_deleted"=>NOT_DELETED,"lcr.id"=>$listing_id));
        $response['record'] = $record_sql->get()->row_array();
        return $response;
    }
    
    public function get_user_listing_record($listing_id,$user_id) {
        $record_sql = $this->db->select("*")
                ->from($this->table_name)
                ->where(array("is_deleted"=>NOT_DELETED,"user_id"=>$user_id,"listing_id"=>$listing_id,"status"=>ACTIVE))->order_by("id","desc");
        $response['record'] = $record_sql->get()->row_array();
        return $response;
    }
    
    public function update_claim_request_requested($listing_id,$user_id){
        $update_data  = array("request_status"=>LISTING_CLAIM_REQUEST_REQUESTED);
        return $this->update($update_data,array("listing_id"=>$listing_id,"user_id"=>$user_id,"request_status"=>LISTING_CLAIM_REQUEST_PENDING));
    }
    
    public function reject_other_request($listing_id,$record_id){
        $update_data  = array("request_status"=>LISTING_CLAIM_REQUEST_REJECT);
        return $this->update($update_data,array("listing_id"=>$listing_id,"id!="=>$record_id));
    }

    public function change_status($record_id,$status){
        $update_data  = array("request_status"=>$status);
        return $this->update($update_data,$record_id);
    }
}